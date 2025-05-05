<?php

namespace App\Http\Controllers;

use App\Models\EmployerCharge;
use App\Models\Occupation;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function dashboard(){
        $totalEmployers = User::where('role','employer')->count();
        $totalJobSeeker = User::where('role','jobseeker')->count();
        $totalJobs = Occupation::count();
        return view('admin.admin_home', compact('totalEmployers','totalJobSeeker','totalJobs'));
    }

    public function employersView(){
        $employers = User::with('charges')->where('role','employer')->paginate(10);
        return view('admin.viewEmployers', compact('employers'));
    }

    public function blockUnblock($id, $status){
        $employer = User::find($id);
        if($status == 0){
           $employer->is_blocked = 0;
           $employer->save();
           return back()->with('success','unblocked Successfully');

        }else{
            $employer->is_blocked = 1;
            $employer->save();
            return back()->with('success','blocked Successfully');

        }
    }

    public function employerchargesForm($id){
        $employer = User::with('charges')->where('role','employer')->first();
        return view('admin.assignFee',compact('employer'));
    }

    public function employerchargesFormPost($id){
        $request = request();
        $employerCharges = new EmployerCharge();
        $employerCharges->employer_id = $id;
        $employerCharges->amount = $request->charges;
        $employerCharges->save();
        return redirect()->route('admin.employersview');
     }

     public function employerchargesFormEdit($id){
        $request = request();
        $employercharges = EmployerCharge::where('employer_id',$id)->first();
        $employercharges->amount = $request->charges;
        $employercharges->save();
        return redirect()->route('admin.employersview');
     }
     public function jobSeekersView(){
        $jobSeekers = User::where('role','jobseeker')->paginate(10);
        return view('admin.jobseekers',compact('jobSeekers'));

     }

     public function jobsView(){
        $jobs = Occupation::with('employer')->where('is_verified',0)->paginate(10);
        return view('admin.jobControlView',compact('jobs'));
     }

     public function jobsDetails($id){
        $jobs = Occupation::with(['employer','jobAddress','jobCategories.category'])->where('id',$id)->get();
        return view('admin.jobDetails', compact('jobs'));

     }

     public function jobDelete($id){
        $job = Occupation::find($id);
        $job->delete();
        return redirect()->route('admin.jobcontrol')->with('success','deletion successfull');
     }
}
