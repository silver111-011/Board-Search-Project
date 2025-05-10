@extends('layouts.adminsidebar')

@section('title', 'Dashboard')

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
            <p><strong>Categories:</strong> 
            @foreach ($job->jobCategories as $category)
            {{ $category->category->name.',' }}
            @endforeach
          </p>
            <hr>
            <h5 class="card-title"><strong>Posted By:</strong> {{ $job->employer->name }}</h5>
            <p><strong>Contacts:</strong> {{  $job->employer->email  }}</p>
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
                <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                data-bs-target="#deleteModal-{{ $job->id }}">Delete</button>
                <div class="modal fade" id="deleteModal-{{ $job->id }}" tabindex="-1" aria-labelledby="deleteModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content border-danger">
                        <div class="modal-header bg-danger text-white">
                          <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <p class="mb-0">⚠️ Are you sure you want to delete this job post? This action cannot be undone.
                          </p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                          <form action="{{ route('admin.deleteJob',$job->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Delete</button>
                          </form>
    
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
               
                <a href="{{ route('admin.verifyjob',$job->id) }}" class="btn btn-success">Verify</a>
          
                
            </div>
        </div>
    </div>
</div>
</main>
@endsection
