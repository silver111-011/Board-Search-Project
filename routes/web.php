<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::view('/', 'index');
Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');
Route::post('register',[AuthController::class, 'register'])->name('post.register');
Route::post('login',[AuthController::class, 'login'])->name('post.login');

// Routes for employer
Route::middleware(['auth', 'role:employer'])->group(function () {
Route::get('employeer/dashboard',[EmployeersController::class,'dashboard'])->name('employer.dashboard');
Route::get('employeer/jobs/form/{id?}',[EmployeersController::class,'jobsform'])->name('employer.jobsform');
Route::post('employeer/jobs/form/submit',[EmployeersController::class,'submitjobsform'])->name('employer.submitjobsform');
Route::post('employeer/jobs/form/edit/{id}',[EmployeersController::class,'editjobsform'])->name('employer.editjobsform');
Route::get('job/applicants/{jobId}',[EmployeersController::class,'jobApplicants'])->name('employer.jobApplicants');
Route::get('close/open/jon/{jobId}/{status}',[EmployeersController::class,'closeOpenJob'])->name('employer.closeOpenJob');
Route::post('delete/job/{jobId}',[EmployeersController::class,'deleteJob'])->name('employer.deleteJob');
Route::get('employer/applicant',[EmployeersController::class,'employerAplicants'])->name('employer.employerAplicants');
Route::get('employer/all/jobs',[EmployeersController::class,'allJobs'])->name('employer.allJobs');
Route::get('employer/logout',[EmployeersController::class,'logout'])->name('employer.logout');
});   



