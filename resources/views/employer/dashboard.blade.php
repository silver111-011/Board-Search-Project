@extends('layouts.sidebar')

@section('title', 'Dashboard')

@section('content')

@php
  use App\Models\ApplicantJob;
@endphp
<!-- Your page-specific content here -->
<main class="bg-secondary bg-opacity-25 min-vh-100">

  <div class="flex-md-row holder  noscrollbar noscrollbarfire" style="height: 90vh; overflow-y: scroll;">
    <div class="container-fluid mt-4">
      <!-- Header Section -->
      <div class="row align-items-center">
        <div class="col-md-6">
          <h2 class="fw-bold">Employer Dashboard</h2>
        </div>
        <div class="col-md-6 text-md-end mt-3 mt-md-0">
          <a href="{{ route('employer.jobsform') }}" class="btn btn-success" >
           + Post a Job
          </a>
        </div>
      </div>

      <p class="text-muted">Manage your job postings and track applicants easily.</p>

      <!-- Job Postings Card -->
      <div class="card mt-4 shadow-sm">
        <div class="card-header bg-primary text-white">
          <h5 class="mb-0">Recent Job Posts</h5>
        </div>
        <div class="card-body table-responsive noscrollbar noscrollbarfire">
          <table class="table table-hover align-middle text-nowrap">
            <thead class="table-light">
              <tr>
                <th>Job Title</th>
                <th>Salary (TZS)</th>
                <th>Applicants</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
            @if($recentJobs->count() > 0)
            @foreach($recentJobs as $job)
            <tr>
              <td>{{ $job->title }}</td>
              <td> {{number_format($job->salary)  }}</td>
              @php
                $jobapplicants = ApplicantJob::where('job_id',$job->id)->count();
              @endphp
              <td>{{ $jobapplicants }} Applicants</td>
              @if($job->is_closed == 0)
              <td><span class="badge bg-success">Active</span></td>
              @else
              <td><span class="badge bg-danger">Closed</span></td>
              @endif
              <td>
                <a href="{{ route('employer.jobApplicants',$job->id) }}" class="btn btn-sm btn-outline-info">View</a>
                <a href="{{ route('employer.jobsform',$job->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                  data-bs-target="#deleteModal">Delete</button>
                  @if($job->is_closed == 0)
                  <a href="{{ route('employer.closeOpenJob',['jobId'=>$job->id, 'status' => 1]) }}" class="btn btn-sm btn-outline-secondary">Close</a>
                  @else
                  <a href="{{ route('employer.closeOpenJob',['jobId'=>$job->id, 'status' => 0]) }}" class="btn btn-sm btn-outline-success">Open</a>
                  @endif
                 
              </td>
            </tr>
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
            <form action="{{ route('employer.deleteJob',$job->id) }}">
              @csrf
              <button type="submit"  class="btn btn-danger" data-bs-dismiss="modal">Delete</button>
            </form>
        
          </form>
          </div>
        </div>
      </div>
    </div>
            @endforeach
            
            @endif
            </tbody>
          </table>
        </div>
      </div>

      <!-- Summary Cards -->
      <div class="row mt-4">
        <div class="col-sm-6 col-md-4 mb-3">
          <div class="card shadow-sm p-3 h-100">
            <h5 class="fw-bold">Total Applicants</h5>
            <p class="fs-4 text-primary fw-bold mb-0">{{ $totalApplicants }}</p>
          </div>
        </div>
        <div class="col-sm-6 col-md-4 mb-3">
          <div class="card shadow-sm p-3 h-100">
            <h5 class="fw-bold">Active Jobs</h5>
            <p class="fs-4 text-success fw-bold mb-0">{{ $activeJobs }}</p>
          </div>
        </div>
        <div class="col-sm-6 col-md-4 mb-3">
          <div class="card shadow-sm p-3 h-100">
            <h5 class="fw-bold">Closed Jobs</h5>
            <p class="fs-4 text-danger fw-bold mb-0">{{ $closedJobs }}</p>
          </div>
        </div>
      </div>
    </div>

   

  </div>

</main>
@endsection