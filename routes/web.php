<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
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
Route::view('/employer/dashboard', 'employer.dashboard');
Route::view('/employer/post-job', 'employer.post_job');
Route::view('/jobseeker/dashboard', 'jobseeker.dashboard');
Route::view('/jobseeker/apply-job', 'jobseeker.apply_job');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::view('/login', 'auth.login');
Route::view('/register', 'auth.register');
Route::get('/job/description', function () {
    return view('jobseeker.description');
})->name('job.description');
Route::view('/admin/dashboard','admin.dashboard');
Route::view('/admin/joblist','admin.joblist');
Route::view('/admin/jobseekerlist','admin.jobseekerlist');
Route::view('/admin/employerlist','admin.employerlist');
Route::view('/admin/jobseekerprofile','admin.jobseekerprofile');
Route::view('/admin/employerprofile','admin.employerprofile');
