<?php

namespace App\Http\Controllers;

use App\Models\Occupation;
use App\Models\User;
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
}
