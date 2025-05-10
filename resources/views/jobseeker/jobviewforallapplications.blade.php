@extends('layouts.joobseekersidebar')

@section('title', 'Job Seeker Dashboard')

@section('content')
<main class="bg-secondary bg-opacity-25 min-vh-100 py-4 px-3">
<div class="container mt-4">
  
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Job Details</h4>
        </div>
        <div class="card-body">
            <h5 class="card-title"><strong>Job Title:</strong> {{ $job->title }}</h5>
            <p><strong>Salary:</strong> {{ number_format($job->salary) }} TZS</p>
            <p><strong>Location:</strong> {{ $job->jobAddress->country.','.$job->jobAddress->city.','.$job->jobAddress->district.','.$job->jobAddress->street }}</p>
            <p><strong>Posted On:</strong> {{ $job->created_at->format('d-m-Y') }}</p>

            <hr>

            <h6><strong>Job Summary:</strong></h6>
            <p>{{ $job->description }}</p>

            @if($job->pdf_path)
                <p><strong>Full Job Description:</strong></p>
                <a href="{{ asset('storage/' . $job->pdf_path) }}" class="btn btn-outline-primary" target="_blank">
                    📄 View Full Description
                </a>
            @endif

            <div class="mt-4 d-flex justify-content-between">
                <a href="{{ route('jobseeker.allapplicantions') }}" class="btn btn-secondary">Back to Listings</a>
             
                
            </div>
        </div>
    </div>
</div>
</main>
@endsection
