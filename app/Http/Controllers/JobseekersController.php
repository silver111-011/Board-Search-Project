<?php

namespace App\Http\Controllers;

use App\Models\ApplicantJob;
use App\Models\Category;
use App\Models\JobseekerCategory;
use App\Models\JobseekerMoreDetail;
use App\Models\Occupation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JobseekersController extends Controller
{
    //

    public function dashboard()
    {
        $additionInfo = JobseekerMoreDetail::where('jobseeker_id', Auth::id())->count();
        $jobseeker = Auth::user(); // assuming jobseekers are authenticated users

        // Get category IDs for the logged-in jobseeker
        $categoryIds = JobseekerCategory::where('jobseeker_id', $jobseeker->id)->get('category_id');

        // Find jobs that match those categories
        $recommendedJobs = Occupation::with('jobAddress')->where('is_closed', 0)->whereHas('jobCategories', function ($query) use ($categoryIds) {
            $query->whereIn('job_categories.category_id', $categoryIds);
        })->paginate(5);

        $myapplication = ApplicantJob::with('occupation')->where('applicant_id', Auth::id())->orderBy('created_at', 'asc')->paginate(4);
        $totalApplications = ApplicantJob::with('occupation')->where('applicant_id', Auth::id())->count();
        $acceptedApplications = ApplicantJob::with('occupation')->where([['applicant_id', Auth::id()], ['status', 1]])->count();
        $pendingApplications = ApplicantJob::with('occupation')->where([['applicant_id', Auth::id()], ['status', 0]])->count();

        return view('jobseeker.dashboard', compact('additionInfo', 'recommendedJobs', 'myapplication', 'totalApplications', 'acceptedApplications', 'pendingApplications'));
    }

    public function jobdescription($id)
    {
        $job = Occupation::with('jobAddress')->find($id);
        $exists = ApplicantJob::where([['job_id', $id], ['applicant_id', Auth::id()]])->exists();
        if ($exists) {
            $has_applied = 1;
        } else {
            $has_applied = 0;
        }

        return view('jobseeker.description', compact('job', 'has_applied'));
    }

    public function additions()
    {
        $jobseeker = JobseekerMoreDetail::with('jobseeker')->where('jobseeker_id', Auth::id())->first();
        $categories = Category::all();
        return view('jobseeker.additional', compact('jobseeker', 'categories'));
    }

    public function additionspost()
    {
        $request = request();
        // Ensure the phone number contains only digits
        if (!ctype_digit($request->phone)) {
            return back()->with('fail', 'Phone number must contain only numbers.');
        }

        $additions = new JobseekerMoreDetail();

        $additions->phone = $request->phone;
        $additions->jobseeker_id = Auth::id();
        $additions->country = ucfirst($request->country);
        $additions->region = ucfirst($request->region);
        $additions->district = ucfirst($request->district);
        $additions->street = ucfirst($request->street);
        $additions->save();
        if (!empty($request->categories)) {
            foreach ($request->categories as $categoryId) {
                $categoryData = Category::findOrFail($categoryId);
                if (JobseekerCategory::where([['category_id', $categoryData->id], ['jobseeker_id', Auth::id()]])->exists()) {
                    continue;
                }
                JobseekerCategory::create([
                    'jobseeker_id' => Auth::id(),
                    'category_id' => $categoryData->id,
                ]);
            }
        }

        return redirect()->route('jobseeker.dashboard');
    }

    public function applicationForm($id)
    {
        $job = Occupation::find($id);
        $jobseeker = User::with('employeeMoreDetails')->where('id', Auth::id())->first();
        return view('jobseeker.applicationpage', compact('job', 'jobseeker'));
    }

    public function applicationFormPost($id)
    {
        //check if the post exists
        $request = request();
        $job = Occupation::find($id);
        if ($job->is_closed == 0) {
            $exists = ApplicantJob::where([['job_id', $id], ['applicant_id', Auth::id()]])->exists();
            if ($exists) {
                //the applicant is trying to edit
                //check job status
                if ($request->hasFile('jobdocument')) {
                    //edit the file

                    $file = $request->file('jobdocument');
                    // Check if it's a PDF
                    if ($file->getClientOriginalExtension() !== 'pdf') {
                        return back()->with('fail', 'Only PDF files are allowed.');
                    }
                    $jobApplicant = ApplicantJob::where([['job_id', $id], ['applicant_id', Auth::id()]])->first();
                    //  delete old file if it exists
                    if ($jobApplicant->attachments) {
                        Storage::delete($jobApplicant->attachments);
                    }
                    // Store the new file
                    $jobdocumentpath = $file->store('Job-documents');

                    // Update job document path in database (if needed)
                    $jobApplicant->attachments = $jobdocumentpath;
                    $jobApplicant->save();
                    return back()->with('success', 'Attachments edited successfully');
                }
            }


            $jobApplicant = new ApplicantJob();

            if ($request->hasFile('jobdocument')) {
                $file = $request->file('jobdocument');

                // Check MIME type or extension
                if ($file->getClientOriginalExtension() !== 'pdf') {
                    return back()->with('fail', 'Only PDF files are allowed.');
                }
                // Store the PDF
                $jobdocumentpath = $file->store('Job-documents');
            }

            $jobApplicant->job_id = $id;
            $jobApplicant->applicant_id = Auth::id();
            $jobApplicant->attachments = $jobdocumentpath;
            $jobApplicant->status = 0;
            $jobApplicant->save();
            return redirect()->route('jobseeker.dashboard');
        } else {
            return back()->with('fail', 'Application for this job is closed');
        }
    }

    public function applicationWithdraw($id)
    {
        //check if pplication status is zero and for job and for applicant
        $job = Occupation::find($id);
        $jobapplicant = ApplicantJob::where([['job_id', $id], ['applicant_id', Auth::id()]])->first();
        if ($job->is_closed == 1 || $jobapplicant->status == 1) {
            return back()->with('fail', 'You can not withdraw this applicantion since it is either clossed or your accepted');
        }

        if ($jobapplicant->attachments) {
            Storage::delete($jobapplicant->attachments);
        }

        $jobapplicant->delete();
        return back()->with('success', 'Application withdrawed successfuly');
    }

    public function allJobs()
    {
        $unappliedJobs = Occupation::with('jobAddress')->where('is_closed', false)
            ->whereNotIn('id', function ($query) {
                $query->select('job_id')
                    ->from('applicatnt_jobs')
                    ->where('applicant_id', Auth::id());
            })
            ->paginate(10);

        return view('jobseeker.jobsviewpage', compact('unappliedJobs'));
    }

    public function  allRecommandedJobs()
    {
        $jobseeker = Auth::user(); // assuming jobseekers are authenticated users

        // Get category IDs for the logged-in jobseeker
        $categoryIds = JobseekerCategory::where('jobseeker_id', $jobseeker->id)->get('category_id');

        // Find jobs that match those categories
        $recommendedJobs = Occupation::with('jobAddress')->where('is_closed', 0)->whereHas('jobCategories', function ($query) use ($categoryIds) {
            $query->whereIn('job_categories.category_id', $categoryIds);
        })->paginate(10);

        return view('jobseeker.allrecomandedjobs', compact('recommendedJobs'));
    }

    public function editprofile()
    {
        $jobseeker = User::with('employeeMoreDetails')->where('id', Auth::id())->first();
        $categories = Category::all();
        return view('jobseeker.editprofile', compact('jobseeker', 'categories'));
    }

    public function editprofilepost()
    {

        $request = request();
        $jobseeker = User::find(Auth::id());
        $dobCarbon = Carbon::parse($request->dob);
        // Get age
        $age = $dobCarbon->age;

        // Ensure the phone number contains only digits
        if (!ctype_digit($request->phone)) {
            return back()->with('fail', 'Phone number must contain only numbers.');
        }
        $jobseeker->email = $request->email;
        $jobseeker->name = $request->name;
        $jobseeker->save();
        if (JobseekerMoreDetail::where('jobseeker_id', Auth::id())->exists()) {
            //edit 
            $additions = JobseekerMoreDetail::where('jobseeker_id', Auth::id())->first();
            if($age == 0){
                $additions->age =   $additions->age;
            }else{
                $additions->age =   $age;
            }
        } else {
            $additions = new JobseekerMoreDetail();
            $additions->gender = $request->gender;
            $additions->is_married = $request->marital;
            $additions->age = $age;
        }


        $additions->phone = $request->phone;
        $additions->jobseeker_id = Auth::id();
        $additions->country = ucfirst($request->country);
        $additions->region = ucfirst($request->region);
        $additions->district = ucfirst($request->district);
        $additions->street = ucfirst($request->street);
        $additions->save();
        if (!empty($request->categories)) {
            foreach ($request->categories as $categoryId) {
                $categoryData = Category::findOrFail($categoryId);
                if (JobseekerCategory::where([['category_id', $categoryData->id], ['jobseeker_id', Auth::id()]])->exists()) {
                    continue;
                }
                JobseekerCategory::create([
                    'jobseeker_id' => Auth::id(),
                    'category_id' => $categoryData->id,
                ]);
            }
        }

        return redirect()->route('jobseeker.dashboard');
    }

    public function allapplications()
    {
        $myapplication = ApplicantJob::with('occupation')->where('applicant_id', Auth::id())->orderBy('created_at', 'asc')->paginate(10);
        return view('jobseeker.allapplications', compact('myapplication'));
    }

    public function jobviewforallapplication($id)
    {
        $job = Occupation::with('jobAddress')->find($id);
        $exists = ApplicantJob::where([['job_id', $id], ['applicant_id', Auth::id()]])->exists();
        if ($exists) {
            $has_applied = 1;
        } else {
            $has_applied = 0;
        }

        return view('jobseeker.jobviewforallapplications', compact('job', 'has_applied'));
    }

    public function recommendedJobSearch()
    {

        $request = request();
        $searchInput = $request->searchinput;
        $jobseeker = Auth::user(); // assuming jobseekers are authenticated users

        // Get category IDs for the logged-in jobseeker
        $categoryIds = JobseekerCategory::where('jobseeker_id', $jobseeker->id)->get('category_id');

        // Find jobs that match those categories
        $recommendedJobs = Occupation::with('jobAddress')->where('is_closed', 0)->where('title', 'LIKE', '%' . $searchInput . '%')->whereHas('jobCategories', function ($query) use ($categoryIds) {
            $query->whereIn('job_categories.category_id', $categoryIds);
        })->paginate(10);

        return view('jobseeker.allrecomandedjobs', compact('recommendedJobs'));
    }

    public function allJobsSearch()
    {   
        $request = request();
        $searchTerm = $request->input('searchinput'); // from text input

        // Check if category with that name exists
        $category = Category::where('name', 'LIKE', "%{$searchTerm}%")->first();
    
        $unappliedJobs = Occupation::with('jobAddress')
            ->where('is_closed', false)
            ->whereNotIn('id', function ($query) {
                $query->select('job_id')
                    ->from('applicatnt_jobs')
                    ->where('applicant_id', Auth::id());
            });
    
        // If category exists, filter by category
        if ($category) {
            $unappliedJobs = $unappliedJobs->whereHas('categories', function ($query) use ($category) {
                $query->where('id', $category->id);
            });
        } else {
            // Otherwise, filter by job title match
            $unappliedJobs = $unappliedJobs->where('title', 'LIKE', "%{$searchTerm}%");
        }
    
        $unappliedJobs = $unappliedJobs->paginate(10);
    

        return view('jobseeker.jobsviewpage', compact('unappliedJobs'));
    }

    public function allApplicationsSearch(){
     
        $request = request();
        $searchTerm = $request->input('searchinput');
        
        $myapplication = ApplicantJob::with('occupation')
            ->where('applicant_id', Auth::id())
            ->when($searchTerm, function ($query) use ($searchTerm) {
                $query->whereHas('occupation', function ($q) use ($searchTerm) {
                    $q->where('title', 'LIKE', '%' . $searchTerm . '%');
                });
            })
            ->orderBy('created_at', 'asc')
            ->paginate(10);
        
        return view('jobseeker.allapplications', compact('myapplication'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
