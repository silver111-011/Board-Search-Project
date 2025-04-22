@extends('layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container mt-5">
    <h2 class="fw-bold mb-4">Admin Dashboard</h2>
    <p class="text-muted">Welcome Admin! Manage users, jobs, and platform activity.</p>

    <!-- Quick Stats -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm p-3">
                <h5>Total Employers</h5>
                <p class="fs-4 fw-bold text-primary">120</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm p-3">
                <h5>Total Job Seekers</h5>
                <p class="fs-4 fw-bold text-success">350</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm p-3">
                <h5>Total Jobs Posted</h5>
                <p class="fs-4 fw-bold text-danger">480</p>
            </div>
        </div>
    </div>

    <!-- Management Sections -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">User Management</h5>
        </div>
        <div class="card-body">
            <a href="#" class="btn btn-outline-primary mb-2">View All Employers</a>
            <a href="#" class="btn btn-outline-success mb-2">View All Job Seekers</a>
        </div>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">Job Control</h5>
        </div>
        <div class="card-body">
            <a href="#" class="btn btn-outline-info mb-2">View All Job Posts</a>
            <a href="#" class="btn btn-outline-danger mb-2">Remove Inappropriate Jobs</a>
        </div>
    </div>

    <!-- System Controls -->
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">System Settings</h5>
        </div>
        <div class="card-body">
            <a href="#" class="btn btn-outline-secondary">Settings</a>
            <a href="#" class="btn btn-outline-warning">Logs & Reports</a>
        </div>
    </div>
</div>
@endsection
