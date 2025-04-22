@extends('layouts.master')

@section('title', 'Board Search')

@section('content')

<div class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <!-- Left Side: Text Content -->
            <div class="col-md-6 text-content">
                <h1>
                    <span class="highlight">Building</span> Careers, <br>
                    <span class="highlight">Digitizing</span> Campuses, <br>
                    <span class="highlight">Revolutionizing</span> Recruitments
                </h1>
                <p class="subtitle">
                    The fastest-growing career development platform that brings together academia, 
                    companies, students, and alumni in a single place to collaborate and grow.
                </p>
                <div class="buttons">
                    <a href="{{ url('/jobseeker/dashboard') }}" class="btn btn-success">Search your dream job  →</a>
                    <a href="{{ url('/employer/dashboard') }}" class="btn btn-dark">Hire a talent →</a>
                </div>
            </div>

            <!-- Right Side: Image -->
            <div class="col-md-6 text-center">
                <img src="{{ asset('images/pic1.jpg') }}" alt="Career Development" class="hero-image">
            </div>
        </div>
    </div>
</div>

<div class="text-center py-5 bg-light">
    <h1 class="fw-bold">Welcome to Board Search</h1>
    <p class="lead">Your trusted platform to connect job seekers with top employers.</p>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <p>
                Whether you’re looking for your dream job or seeking the best talent for your company, 
                we provide a seamless and efficient way to make the right connections. Explore a wide range 
                of job opportunities, career insights, and hiring solutions tailored to your needs.
            </p>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card shadow-sm p-3">
                <h5 class="fw-bold">Explore Job Listings</h5>
                <p>Browse through thousands of job openings across different industries and locations.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm p-3">
                <h5 class="fw-bold">Career Resources</h5>
                <p>Get expert career advice, resume tips, and interview guidance to boost your job search.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm p-3">
                <h5 class="fw-bold">Recruitment Solutions</h5>
                <p>Employers can access smart hiring solutions to find and attract top talent effortlessly.</p>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <img src="job-search-illustration.png" alt="Job Search Illustration" class="img-fluid" width="300">
    </div>
</div>

@endsection
