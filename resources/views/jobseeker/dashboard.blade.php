@extends('layouts.master')

@section('title', 'Job Seeker Dashboard')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fw-bold">Technical Support Enginner</h2>
        <a href="{{ url('/jobseeker/apply-job') }}" class="btn btn-success">+ Apply for a Job</a>
    </div>

    <p class="text-muted">Find and apply for jobs that match your skills.</p>

    <!-- Job Recommendations Section -->
    <div class="card mt-4 shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Recommended Jobs</h5>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Job Title</th>
                        <th>Company</th>
                        <th>Location</th>
                        <th>Posted</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Frontend Developer</td>
                        <td>Tech Innovators Ltd</td>
                        <td>Dar es Salaam</td>
                        <td>2 days ago</td>
                        <td>
                        <a href="{{ route('job.description') }}" class="btn btn-sm btn-outline-primary">View</a>

                            <a href="#" class="btn btn-sm btn-outline-success">Apply</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Marketing Specialist</td>
                        <td>XYZ Corporation</td>
                        <td>Arusha</td>
                        <td>5 days ago</td>
                        <td>
                        <a href="{{ route('job.description') }}" class="btn btn-sm btn-outline-primary">View</a>

                            <a href="#" class="btn btn-sm btn-outline-success">Apply</a>
                        </td>
                    </tr>
                    <!-- More job listings -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Application Status Section -->
    <div class="card mt-4 shadow-sm">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Your Applications</h5>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Job Title</th>
                        <th>Company</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Backend Developer</td>
                        <td>ABC Tech</td>
                        <td><span class="badge bg-warning">Under Review</span></td>
                        <td>
                        <a href="{{ route('job.description') }}" class="btn btn-sm btn-outline-primary">View</a>

                            <a href="#" class="btn btn-sm btn-outline-danger">Withdraw</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Sales Executive</td>
                        <td>Retail Hub</td>
                        <td><span class="badge bg-success">Accepted</span></td>
                        <td>
                        <a href="{{ route('job.description') }}" class="btn btn-sm btn-outline-primary">View</a>

                        </td>
                    </tr>
                    <!-- More applications -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Quick Stats Section -->
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card shadow-sm p-3">
                <h5 class="fw-bold">Total Applications</h5>
                <p class="fs-4 text-primary fw-bold">15</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm p-3">
                <h5 class="fw-bold">Jobs Applied</h5>
                <p class="fs-4 text-success fw-bold">8</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm p-3">
                <h5 class="fw-bold">Pending Applications</h5>
                <p class="fs-4 text-danger fw-bold">3</p>
            </div>
        </div>
    </div>
</div>
@endsection
