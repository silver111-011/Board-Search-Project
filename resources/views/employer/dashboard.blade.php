@extends('layouts.master')

@section('title', 'Employer Dashboard')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fw-bold">Employer Dashboard</h2>
        <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#paymentModal">💳 Pay & Post a Job</a>
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
                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Marketing Manager</td>
                        <td>8 Applicants</td>
                        <td><span class="badge bg-secondary">Closed</span></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-outline-info">View</a>
                            <a href="#" class="btn btn-sm btn-outline-warning">Edit</a>
                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Summary Cards -->
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

<!-- Payment Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="paymentModalLabel">Complete Payment to Post Job</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Posting a job costs <strong>$10</strong>. Please complete the payment below to continue.</p>
        <button type="button" class="btn btn-primary w-100" data-bs-dismiss="modal">Simulate Payment</button>
      </div>
    </div>
  </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-danger">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="mb-0">⚠️ Are you sure you want to delete this job posting? This action cannot be undone.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Delete</button>
      </div>
    </div>
  </div>
</div>
@endsection
