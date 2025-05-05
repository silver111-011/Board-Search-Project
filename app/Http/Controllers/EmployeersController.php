<?php

namespace App\Http\Controllers;

use App\Models\ApplicantJob;
use App\Models\Category;
use App\Models\JobCategory;
use App\Models\JobLocation;
use App\Models\Occupation;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EmployeersController extends Controller
{
    //
    public function dashboard()
    {

        $recentJobs = Occupation::where('employer_id', Auth::id())->latest()->take(6)->get();
         $totalApplicants = DB::table('applicatnt_jobs')
            ->join('jobs', 'applicatnt_jobs.job_id', '=', 'jobs.id')
            ->where('jobs.employer_id', Auth::id())
            ->count();

        $activeJobs = Occupation::where([['is_closed',0],['employer_id',Auth::id()]])->count();
        $closedJobs = Occupation::where([['is_closed',1],['employer_id',Auth::id()]])->count();


        return  view('employer.dashboard', compact('recentJobs','totalApplicants','activeJobs','closedJobs'));
    }

    public function jobsform($jobId = null)
    {
        $categories = Category::all();
        if ($jobId == null) {
            $job = new Occupation();
        } else {
            $job = Occupation::with('jobAddress')->findOrFail($jobId);
        }
        return view('employer.jobpostform', compact('categories', 'job'));
    }
    public function submitjobsform()
    {
        $request = request();
        //check if the job for the user existists
        if (Occupation::where([['title', $request->title], ['employer_id', Auth::id()]])->exists()) {
            return back()->with('fail', 'You have arleady posted the job with this name');
        }

        $addressParts = explode(',', $request->address);

        if (count($addressParts) !== 4) {
            return back()->with('fail', 'Address must follow the format: country,city,district,street');
        }

        // Assign to variables if needed
        [$country, $city, $district, $street] = $addressParts;
         //Update video if uploaded
         if ($request->hasFile('jobdocument')) {
            $file = $request->file('jobdocument');
        
            // Check MIME type or extension
            if ($file->getClientOriginalExtension() !== 'pdf') {
                return back()->with('fail', 'Only PDF files are allowed.');
            }
            // Optionally delete old file here...
            // Store the PDF
           $jobdocumentpath = $file->store('Job-documents');
        }
        
        $occupation = Occupation::create([
            'title' => ucfirst($request->title),
            'description' => $request->description,
            'salary' => $request->salary,
            'is_closed' => 0,
            'is_verified' => 0,
            'pdf_path' => $jobdocumentpath,
            'employer_id' => Auth::id()
        ]);



        foreach ($request->categories as $categoryId) {
            $categoryData = Category::findOrFail($categoryId);

            JobCategory::create([
                'job_id' => $occupation->id,
                'category_id' => $categoryData->id,
            ]);
        }


        JobLocation::create([
            'country' => ucfirst($country),
            'city' => ucfirst($city),
            'district' => ucfirst($district),
            'street' => ucfirst($street),
            'is_closed' => 0,
            'job_id' => $occupation->id, // add this if JobLocation is related to a job
        ]);


        return redirect()->route('employer.dashboard');
    }

    public function editjobsform($jobId)
    {
        $request = request();
        $occupation = Occupation::findOrFail($jobId);
        $addressParts = explode(',', $request->address);

        if (count($addressParts) !== 4) {
            return back()->with('fail', 'Address must follow the format: country,city,district,street');
        }
       
        if ($request->hasFile('jobdocument')) {
        
            $file = $request->file('jobdocument');
            // Check if it's a PDF
            if ($file->getClientOriginalExtension() !== 'pdf') {
                return back()->with('fail', 'Only PDF files are allowed.');
            }
            //  delete old file if it exists
            if ($occupation->pdf_path) {
                Storage::delete($occupation->pdf_path);
            }
            // Store the new file
            $jobdocumentpath = $file->store('Job-documents');
        
            // Update job document path in database (if needed)
            $occupation->pdf_path = $jobdocumentpath;
           
        }
        

        // Assign to variables if needed
        [$country, $city, $district, $street] = $addressParts;

        $occupation->title = $request->title;
        $occupation->description = $request->description;
        $occupation->salary = $request->salary;

        if ($occupation->save()) {
            if (!empty($request->categories)) {
                foreach ($request->categories as $categoryId) {
                    $categoryData = Category::findOrFail($categoryId);
                    if (JobCategory::where([['category_id', $categoryData->id], ['job_id', $jobId]])->exists()) {
                        continue;
                    }
                    JobCategory::create([
                        'job_id' => $jobId,
                        'category_id' => $categoryData->id,
                    ]);
                }
            }

            $jobLocation = JobLocation::where('job_id', $jobId)->first();
            $jobLocation->country = $country;
            $jobLocation->city = $city;
            $jobLocation->district = $district;
            $jobLocation->street = $street;
            $jobLocation->save();

            return redirect()->route('employer.dashboard');
        } else {
            return back()->with('fail', 'Error Occured, please try again');
        }
    }

    public function jobApplicants($jobId)
    {
        $applicants = ApplicantJob::with('applicant')->where('job_id', $jobId)->paginate(10);
        $job = Occupation::findOrFail($jobId);
        return view('employer.jobapplicantsview', compact('applicants', 'job'));
    }

    public function closeOpenJob($jobId, $status)
    {
        $job = Occupation::find($jobId);
        if ($status == 1) {
            $job->is_closed = 1;
            $job->save();
            return redirect()->route('employer.dashboard');
        } else {
            $job->is_closed = 0;
            $job->save();
            return redirect()->route('employer.dashboard');
        }
    }

    public function deleteJob($jobid)
    {
        $job = Occupation::find($jobid);
        $job->delete();
        return redirect()->route('employer.dashboard');
    }

    public function employerAplicants(){
        $applicants = ApplicantJob::with(['applicant', 'occupation'])
        ->whereHas('occupation', function ($query) {
            $query->where('employer_id', Auth::id());
        })
        ->orderBy('occupation.title', 'asc')
        ->paginate(10);

        return view('employer.applicantsView', compact('applicants'));
    }

    public function allJobs(){
        $occupations = Occupation::where('employer_id', Auth::id())->paginate(10);
        return view('employer.jobpostsView',compact('occupations'));
    }
     
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
