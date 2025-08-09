@extends('layouts.master')

@section('title', 'Board Search')

@section('content')
<div class="row align-items-center">
    <!-- Left Side: Text Content -->
    <div class="col-md-6 order-2 order-md-1 text-content text-center text-md-start">
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
            <a href="{{ route('view.jobs') }}" class="btn btn-success">Search your dream job  →</a>
            <a href="{{ route('login') }}" class="btn btn-dark">Hire a talent →</a>
        </div>
    </div>

    <!-- Right Side: Image -->
    <div class="col-md-6 order-1 order-md-2 text-center">
        <img src="{{ asset('images/pic1.jpg') }}" alt="Career Development" class="hero-image img-fluid">
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
            <div class="card shadow-sm p-3" style="background-color:rgb(12, 47, 250);">
                <h5 class="fw-bold" style="color: #ffd700;">Explore Job Listings</h5>
                <p style="color: white;">Browse through thousands of job openings across different industries and locations.</p>
            </div>
        </div>
        <div class="col-md-4">
        <div class="card shadow-sm p-3" style="background-color: rgb(12, 47, 250);">

                <h5 class="fw-bold" style="color:#ffd700;">Career Resources</h5>
                <p style="color:white;">Get expert career advice, resume tips, and interview guidance to boost your job search.</p>
            </div>
        </div>
        <div class="col-md-4">
        <div class="card shadow-sm p-3" style="background-color: rgb(12, 47, 250);">

                <h5 class="fw-bold" style="color:#ffd700;">Recruitment Solutions</h5>
                <p style="color:white;">Employers can access smart hiring solutions to find and attract top talent effortlessly.</p>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <img src="{{ asset('images/job.png') }}" alt="Job Search Illustration" class="img-fluid" width="300">
    </div>
</div>

<div class="container">

<!-- Section: Recent Job Seekers -->
<div class="mb-5">
    <h3 class="fw-bold mb-4">Recent Job Seekers</h3>
    <div class="row">
        @for ($i = 1; $i <= 3; $i++)
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm" style="background-color:rgb(12,47,250); color:#ffd700;">
                    <div class="card-body shadow-sm" style="box-shadow: 0 4px 6px rgb(12, 47, 250);">
                        <h5 class="card-title" style="color:#ffd700;">Job Seeker {{ $i }}</h5>
                        <p class="card-text" style="color:white;">Email: seeker{{ $i }}@example.com</p>
                        <p class="card-text" style="color:white;">Specialty: Web Developer</p>
                    </div>
                </div>
            </div>
        @endfor
    </div>
</div>

<!-- Section: Latest Jobs -->
<div>
    <h3 class="fw-bold mb-4">Latest Jobs</h3>
    <div class="row">
        @for ($j = 1; $j <= 3; $j++)
            <div class="col-md-4 mb-3">
                <div class="card border-warning shadow-sm" style="border-color: #ffd700 !important;">
                    <div class="card-body">
                        <h5 class="card-title">Job Title {{ $j }}</h5>
                        <p class="card-text">Company: Company {{ $j }}</p>
                        <p class="card-text">Location: Dar es Salaam</p>
                        <a href="#" class="btn btn-warning btn-sm" style="background-color: #ffd700; border-color: #ffd700;">View Details</a>
                    </div>
                </div>
            </div>
        @endfor
    </div>
</div>

</div>

<section class="py-5 text-center bg-light">
    <div class="container">
        <h2 class="fw-bold text-dark mb-3">
            Want to <span class="text-primary border-bottom border-3 border-info pb-1">Post Jobs</span> on Board Search?
        </h2>
        <p class="text-muted mb-4 fs-5">Hire top talent in Tanzania today!</p>

        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="{{ url('/employer/login') }}" class="btn btn-outline-primary fw-bold px-4 py-2">
                Employer Login
            </a>
            <a href="{{ url('/post-job') }}" class="btn btn-primary fw-bold px-4 py-2">
                Post a Job
            </a>
        </div>

        <div class="mt-4 text-muted small">
            👉 The Signup URL for our job management system varies by company.<br>
            Can't find your signup URL? Please 
            <a href="{{ url('/contact') }}" class="text-decoration-none text-primary">email us <i class="fa fa-paper-plane"></i></a>
        </div>
    </div>
</section>


<!-- Section: Top Companies Hiring -->
<div class="mt-5">
    <h3 class="fw-bold mb-4">Top Companies Hiring</h3>
    <div class="row">
        <!-- CRDB Bank -->
        <div class="col-md-3 mb-3">
            <div class="card text-center shadow-sm border-0">
                <div class="card-body">
                    <img src="{{ asset('images/crdb.png') }}" alt="CRDB Logo" class="mb-3" width="60">
                    <h6 class="card-title fw-bold">CRDB Bank</h6>
                    <p class="text-muted small">Hiring now</p>
                </div>
            </div>
        </div>

        <!-- NMB Bank -->
        <div class="col-md-3 mb-3">
            <div class="card text-center shadow-sm border-0">
                <div class="card-body">
                    <img src="{{ asset('images/nmb.png') }}" alt="NMB Logo" class="mb-3" width="60">
                    <h6 class="card-title fw-bold">NMB Bank</h6>
                    <p class="text-muted small">Now recruiting</p>
                </div>
            </div>
        </div>

        <!-- Stanbic Bank -->
        <div class="col-md-3 mb-3">
            <div class="card text-center shadow-sm border-0">
                <div class="card-body">
                    <img src="{{ asset('images/stanbic.png') }}" alt="BOA Logo" class="mb-3" width="60">
                    <h6 class="card-title fw-bold">Stanbic Bank</h6>
                    <p class="text-muted small">Job openings available</p>
                </div>
            </div>
        </div>

        <!-- Hana -->
        <div class="col-md-3 mb-3">
            <div class="card text-center shadow-sm border-0">
                <div class="card-body">
                    <img src="{{ asset('images/hana.png') }}" alt="Computer Center Logo" class="mb-3" width="60">
                    <h6 class="card-title fw-bold">Computer Center</h6>
                    <p class="text-muted small">Looking for IT experts</p>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
