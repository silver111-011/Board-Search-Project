<?php

namespace App\Http\Controllers;

use App\Models\ApplicantJob;
use App\Models\Category;
use App\Models\JobCategory;
use App\Models\JobLocation;
use App\Models\Occupation;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Job;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Barryvdh\DomPDF\Facade\Pdf;



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
        $applicants = ApplicantJob::with('applicant.employeeMoreDetails')->where('job_id', $jobId)->paginate(10);
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
        //if job has applicant
        $exist = ApplicantJob::where('job_id',$jobid)->exists();
        if($exist){
            return back()->with('fail','This job has applicants');
        }
        $job = Occupation::find($jobid);
        $job->delete();
        return redirect()->route('employer.dashboard');
    }

    public function employerAplicants(){
        $applicants = ApplicantJob::with(['applicant.employeeMoreDetails', 'occupation'])
        ->join('jobs', 'applicatnt_jobs.job_id', '=', 'jobs.id')
        ->where('jobs.employer_id', Auth::id())
        ->orderBy('jobs.title', 'asc')
        ->select('applicatnt_jobs.*') // important: select only main table columns to avoid conflicts
        ->paginate(10);
    

        return view('employer.applicantsView', compact('applicants'));
    }

    public function allJobs(){
        $occupations = Occupation::where('employer_id', Auth::id())->paginate(10);
        return view('employer.jobpostsView',compact('occupations'));
    }

    public function applicantDetails($applicantid, $jobid){
        $jobseeker = User::with('employeeMoreDetails')->find($applicantid);
        $job = Occupation::find($jobid);
        return view('employer.applicantdetailview',compact('jobseeker','job'));
    }
     

    public function recruitDisqualify($applicantid,$jobid,$action){
        $jobapplicant = ApplicantJob::where([['job_id',$jobid],['applicant_id',$applicantid]])->first();
        if($action == 0){
           $jobapplicant->status = 3;
           $jobapplicant->save();
           return redirect()->route('employer.jobApplicants',$jobid);
        }else{
            $jobapplicant->status = 1;
            $jobapplicant->save();
            return redirect()->route('employer.jobApplicants',$jobid);
        }

    }

    public function jobApplicantsearch($jobId)
    {
        $search = request('searchinput'); // or however you're getting the search input

        $applicants = ApplicantJob::with('applicant.employeeMoreDetails')
            ->where('job_id', $jobId)
            ->whereHas('applicant', function ($query) use ($search) {
                if ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                }
            })
            ->paginate(10);
        
        $job = Occupation::findOrFail($jobId);
        return view('employer.jobapplicantsview', compact('applicants', 'job'));
    }

    public function allJobsearch(){
        $request = request();
        $search = request('searchinput'); // or however you're getting the search input
        $occupations = Occupation::where('employer_id', Auth::id())->where('title', 'like', '%' . $search . '%')->paginate(10);
        return view('employer.jobpostsView',compact('occupations'));
    }

    public function jobDetail($id){
        $job = Occupation::with('jobAddress')->find($id);
        return view('employer.jobDetail',  compact('job'));

    }

    public function employerAplicantsearch(){
        $search = request('searchinput');
        $applicants = ApplicantJob::with(['applicant.employeeMoreDetails', 'occupation'])
        ->join('jobs', 'applicatnt_jobs.job_id', '=', 'jobs.id')
        ->where('jobs.employer_id', Auth::id())
        ->join('users', 'applicatnt_jobs.applicant_id', '=', 'users.id')
        ->where('users.name', 'like', '%' . $search . '%')
        ->orderBy('jobs.title', 'asc')
        ->select('applicatnt_jobs.*') // important: select only main table columns to avoid conflicts
        ->paginate(10);
    

        return view('employer.applicantsView', compact('applicants'));
    }


public function downloadAcceptedApplicantsPDF($jobId)
{
    $job = Occupation::findOrFail($jobId);

    $acceptedApplicants = ApplicantJob::where('job_id', $jobId)
        ->where('status', 1)
        ->with(['applicant','applicant.employeeMoreDetails'])
        ->get();

    $pdf = PDF::loadView('pdf.accepted_applicants', [
        'job' => $job,
        'acceptedApplicants' => $acceptedApplicants
    ]);

    return $pdf->download('Accepted_Applicants_For_'.$job->title.'.pdf');
}


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
