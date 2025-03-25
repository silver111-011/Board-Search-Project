@extends('layouts.master')

@section('title', 'Employer Dashboard')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fw-bold">Employer Dashboard</h2>
        <a href="{{ url('/employer/post-job') }}" class="btn btn-primary">+ Post a Job</a>
    </div>

    <p class="text-muted">Manage your job postings and track applicants easily.</p>

    <!-- Job Postings Section -->
    <div class="card mt-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Your Job Postings</h5>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Job Title</th>
                        <th>Applicants</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Software Engineer</td>
                        <td>12 Applicants</td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-outline-info">View</a>
                            <a href="#" class="btn btn-sm btn-outline-warning">Edit</a>
                            <a href="#" class="btn btn-sm btn-outline-danger">Delete</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Marketing Manager</td>
                        <td>8 Applicants</td>
                        <td><span class="badge bg-secondary">Closed</span></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-outline-info">View</a>
                            <a href="#" class="btn btn-sm btn-outline-warning">Edit</a>
                            <a href="#" class="btn btn-sm btn-outline-danger">Delete</a>
                        </td>
                    </tr>
                    <!-- More job listings -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Applicant Summary Section -->
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card shadow-sm p-3">
                <h5 class="fw-bold">Total Applicants</h5>
                <p class="fs-4 text-primary fw-bold">45</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm p-3">
                <h5 class="fw-bold">Active Jobs</h5>
                <p class="fs-4 text-success fw-bold">3</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm p-3">
                <h5 class="fw-bold">Closed Jobs</h5>
                <p class="fs-4 text-danger fw-bold">2</p>
            </div>
        </div>
    </div>
</div>
@endsection
