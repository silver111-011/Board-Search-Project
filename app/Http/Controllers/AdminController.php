<?php

namespace App\Http\Controllers;

use App\Models\EmployerCharge;
use App\Models\Occupation;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    public function dashboard()
    {
        $totalEmployers = User::where('role', 'employer')->count();
        $totalJobSeeker = User::where('role', 'jobseeker')->count();
        $totalJobs = Occupation::count();
        return view('admin.admin_home', compact('totalEmployers', 'totalJobSeeker', 'totalJobs'));
    }

    public function employersView()
    {
        $employers = User::with('charges')->where('role', 'employer')->paginate(10);
        return view('admin.viewEmployers', compact('employers'));
    }

    public function blockUnblock($id, $status)
    {
        $employer = User::find($id);
        if ($status == 0) {
            $employer->is_blocked = 0;
            $employer->save();
            return back()->with('success', 'unblocked Successfully');
        } else {
            $employer->is_blocked = 1;
            $employer->save();
            return back()->with('success', 'blocked Successfully');
        }
    }

    public function employerchargesForm($id)
    {

        $employer = User::with('charges')->find($id);
        return view('admin.assignFee', compact('employer'));
    }

    public function employerchargesFormPost($id)
    {
        $request = request();
        $employerCharges = new EmployerCharge();
        $employerCharges->employer_id = $id;
        $employerCharges->amount = $request->charges;
        $employerCharges->save();
        return redirect()->route('admin.employersview');
    }

    public function employerchargesFormEdit($id)
    {
        $request = request();
        $employercharges = EmployerCharge::where('employer_id', $id)->first();
        $employercharges->amount = $request->charges;
        $employercharges->save();
        return redirect()->route('admin.employersview');
    }
    public function jobSeekersView()
    {
        $jobSeekers = User::where('role', 'jobseeker')->paginate(10);
        return view('admin.jobseekers', compact('jobSeekers'));
    }

    public function jobsView()
    {
        $jobs = Occupation::with('employer')->where('is_verified', 0)->paginate(10);
        return view('admin.jobControlView', compact('jobs'));
    }

    public function jobsDetails($id)
    {
        $jobs = Occupation::with(['employer', 'jobAddress', 'jobCategories.category'])->where('id', $id)->get();
        return view('admin.jobDetails', compact('jobs'));
    }

    public function jobDelete($id)
    {
        $job = Occupation::find($id);
        $job->delete();
        return redirect()->route('admin.jobcontrol')->with('success', 'deletion successfull');
    }
    public function employersearch()
    {
        $search = request('searchinput');
        $employers = User::with('charges')->where('role', 'employer')->where('name', 'like', '%' . $search . '%')->paginate(10);
        return view('admin.viewEmployers', compact('employers'));
    }

    public function jobSeekersearch()
    {     
        $search = request('searchinput');
        $jobSeekers = User::where('role', 'jobseeker')->where('name', 'like', '%' . $search . '%')->paginate(10);
        return view('admin.jobseekers', compact('jobSeekers'));
    }

    public function jobsearch()
    {       
        $search = request('searchinput');
        $jobs = Occupation::with('employer')->where('is_verified', 0)->where('title', 'like', '%' . $search . '%')->paginate(10);
        return view('admin.jobControlView', compact('jobs'));
    }

    public function jobdetailAdmin($id)
    {
        $job = Occupation::with(['jobAddress','jobCategories','employer'])->find($id);
        return view('admin.jobdetail', compact('job'));
    }

    public function deleteJob($jobid)
    {
        //if job has applicant
        $job = Occupation::find($jobid);
        $job->delete();
        return redirect()->route('admin.jobcontrol');
    }

    public function verifyjob($jobid){
        $job = Occupation::find($jobid);
        $job->is_verified = 1;
        $job->save();
        return redirect()->route('admin.jobcontrol');
    }

    public function jobcontrolsearch()
    {
        $search = request('searchinput');
        $jobs = Occupation::with('employer')->where('is_verified', 0)->where('title', 'like', '%' . $search . '%')->paginate(10);
        return view('admin.jobControlView', compact('jobs'));
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
