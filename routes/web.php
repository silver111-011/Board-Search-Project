<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeersController;
use App\Http\Controllers\JobseekersController;

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
Route::get('applicant/details/{applicantid}/{jobid}',[EmployeersController::class,'applicantDetails'])->name('employer.applicantDetails');
Route::get('recruit/disqualify/{applicantid}/{jobid}/{action}',[EmployeersController::class,'recruitDisqualify'])->name('employer.recruitDisqualify');
Route::post('employee/applicant/search/{id}',[EmployeersController::class,'jobApplicantsearch'])->name('employer.jobApplicantsearch');
Route::post('employer/all/job/search',[EmployeersController::class,'allJobsearch'])->name('employer.jobssearch');
Route::get('employer/job/detail/{id}',[EmployeersController::class,'jobDetail'])->name('employer.jobDetail');
Route::post('employer/applicant/search',[EmployeersController::class,'employerAplicantsearch'])->name('employer.Aplicantsearch');
Route::get('/employer/job/{job}/accepted-applicants-pdf', [EmployeersController::class, 'downloadAcceptedApplicantsPDF'])->name('employer.downloadAcceptedApplicantsPDF');
Route::get('employer/logout',[EmployeersController::class,'logout'])->name('employer.logout');
});   

//routes for admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');
    Route::get('admin/employers/view',[AdminController::class,'employersView'])->name('admin.employersview');
    Route::get('admin/block/unblock/{id}/{status}',[AdminController::class,'blockUnblock'])->name('admin.blockUnblock');
    Route::get('employer/charges/{id}',[AdminController::class,'employerchargesForm'])->name('admin.employerchargesForm');
    Route::post('employer/charges/post/form/{id}',[AdminController::class,'employerchargesFormPost'])->name('admin.employerchargesFormPost');
    Route::post('employer/charges/edit/form/{id}',[AdminController::class,'employerchargesFormEdit'])->name('admin.employerchargesFormEdit');
    Route::get('admin/job/sekeers',[AdminController::class,'jobSeekersView'])->name('admin.jobSeekersView');
    Route::get('admin/job/control',[AdminController::class,'jobsView'])->name('admin.jobcontrol');
    Route::get('admin/job/deatils/{id}',[AdminController::class,'jobsDetails'])->name('admin.jobDetail');
    Route::get('admin/job/delete/{id}',[AdminController::class,'jobDelete'])->name('admin.jobDelete');
    Route::post('employer/search',[AdminController::class,'employersearch'])->name('admin.employersearch');
    Route::post('jobseekers/search',[AdminController::class,'jobSeekersearch'])->name('admin.jobSeekersearch');
    Route::post('jobs/search',[AdminController::class,'jobsearch'])->name('admin.jobsearch');
    Route::get('admin/job/detail/{id}',[AdminController::class,'jobdetailAdmin'])->name('admin.jobdetailAdmin');
    Route::post('delete/job/admin/{jobId}',[AdminController::class,'deleteJob'])->name('admin.deleteJob');
    Route::get('verify/job/admin/{jobId}',[AdminController::class,'verifyjob'])->name('admin.verifyjob');
    Route::post('unverified/jobs/search',[AdminController::class,'jobcontrolsearch'])->name('admin.jobcontrolsearch');
    Route::get('view/categories',[AdminController::class,'categoriesView'])->name('admin.categoriesView');
    Route::get('admin/view/categories/form/{id?}',[AdminController::class,'categoriesFormView'])->name('admin.categoriesformView');
    Route::post('view/categories/form/post/{id?}',[AdminController::class,'categoriesFormPost'])->name('admin.categoriesFormPost');
    Route::post('category/delete/{id?}',[AdminController::class,'deleteJobCategory'])->name('admin.deleteJobCategory');
    Route::post('category/search/{id?}',[AdminController::class,'categorysearch'])->name('admin.categorysearch');
    Route::get('admin/logout',[AdminController::class,'logout'])->name('admin.logout');
  
}); 

Route::middleware(['auth', 'role:jobseeker'])->group(function () {
    Route::get('job/seeker/dashboard',[JobseekersController::class,'dashboard'])->name('jobseeker.dashboard');
    Route::get('job/description/{id}',[JobseekersController::class,'jobdescription'])->name('jobseeker.jobdescription');
    Route::get('job/seeker/additions',[JobseekersController::class,'additions'])->name('jobseeker.additions');
    Route::post('job/seeker/additions/post',[JobseekersController::class,'additionspost'])->name('jobseeker.additionspost');
    Route::get('application/form/{jobid}',[JobseekersController::class,'applicationForm'])->name('jobseeker.applicationForm');
    Route::get('application/form/{jobid}',[JobseekersController::class,'applicationForm'])->name('jobseeker.applicationForm');
    Route::post('application/form/post/{jobid}',[JobseekersController::class,'applicationFormPost'])->name('jobseeker.applicationFormPost');
    Route::post('application/withdraw/{jobid}',[JobseekersController::class,'applicationWithdraw'])->name('jobseeker.applicationWithdraw');
    Route::get('all/jobs',[JobseekersController::class,'allJobs'])->name('jobseeker.allJobs');
    Route::get('all/recommanded/jobs',[JobseekersController::class,'allRecommandedJobs'])->name('allRecommandedJobs');
    Route::get('edit/profile',[JobseekersController::class,'editprofile'])->name('jobseeker.editprofile');
    Route::post('edit/profile/post',[JobseekersController::class,'editprofilepost'])->name('jobseeker.editprofilepost');
    Route::get('all/applicantions',[JobseekersController::class,'allapplications'])->name('jobseeker.allapplicantions');
    Route::get('jobview/forall/application/{id}',[JobseekersController::class,'jobviewforallapplication'])->name('jobviewforallapplication');
    Route::post('recommended/job/search',[JobseekersController::class,'recommendedJobSearch'])->name('jobseeker.recommendedJobSearch');
    Route::post('all/job/search',[JobseekersController::class,'allJobsSearch'])->name('jobseeker.allJobsSearch');
    Route::post('all/job/search',[JobseekersController::class,'allApplicationsSearch'])->name('jobseeker.allApplicationsSearch');
    Route::get('jobseeker/logout',[JobseekersController::class,'logout'])->name('jobseeker.logout');
   
    

}); 




