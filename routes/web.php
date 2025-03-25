<?php

use Illuminate\Support\Facades\Route;

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
Route::view('/login', 'auth.login');
Route::view('/register', 'auth.register');