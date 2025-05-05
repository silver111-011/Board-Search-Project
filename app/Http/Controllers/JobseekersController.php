<?php

namespace App\Http\Controllers;

use App\Models\ApplicantJob;
use App\Models\Category;
use App\Models\JobseekerCategory;
use App\Models\JobseekerMoreDetail;
use App\Models\Occupation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobseekersController extends Controller
{
    //

    public function dashboard(){
        $additionInfo = JobseekerMoreDetail::where('jobseeker_id',Auth::id())->count();
        $jobseeker = Auth::user(); // assuming jobseekers are authenticated users

        // Get category IDs for the logged-in jobseeker
       $categoryIds = JobseekerCategory::where('jobseeker_id',$jobseeker->id)->get('category_id');
    
        // Find jobs that match those categories
        $recommendedJobs = Occupation::with('jobAddress')->whereHas('jobCategories', function ($query) use ($categoryIds) {
            $query->whereIn('job_categories.category_id', $categoryIds);
        })->paginate(5);

        $myapplication = ApplicantJob::with('occupation')->where('applicant_id',Auth::id())->orderBy('created_at','asc')->paginate(10);
        $totalApplications = ApplicantJob::with('occupation')->where('applicant_id',Auth::id())->count();
        $acceptedApplications = ApplicantJob::with('occupation')->where([['applicant_id',Auth::id()],['status',1]])->count();
        $pendingApplications = ApplicantJob::with('occupation')->where([['applicant_id',Auth::id()],['status',0]])->count();
        
        return view('jobseeker.dashboard',compact('additionInfo','recommendedJobs','myapplication','totalApplications','acceptedApplications','pendingApplications'));
    }

    public function jobdescription(){
     
        return view('jobseeker.description');
    }

    public function additions(){
        $jobseeker = JobseekerMoreDetail::with('jobseeker')->where('jobseeker_id',Auth::id())->first();
        $categories = Category::all();
        return view('jobseeker.additional',compact('jobseeker','categories'));
    }

    public function additionspost(){
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
            $additions ->save();
            if (!empty($request->categories)) {
                foreach ($request->categories as $categoryId) {
                    $categoryData = Category::findOrFail($categoryId);
                    if (JobseekerCategory::where([['category_id', $categoryData->id], ['jobseeker_id',Auth::id()]])->exists()) {
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
}
