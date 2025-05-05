@extends('layouts.joobseekersidebar')

@section('title', 'Job Seeker Dashboard')

@section('content')

<main class="bg-secondary bg-opacity-25 min-vh-100 py-4 px-3">
    <div class="flex-md-row holder  noscrollbar noscrollbarfire" style="height: 90vh; overflow-y: scroll;">
        <div class="container mt-4">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="fw-bold">Technical Support Engineer</h2>
                <a href="" class="btn btn-success">+ Apply for a Job</a>
            </div>
        
            <p class="text-muted">Find and apply for jobs that match your skills.</p>
           @if($additionInfo == 0)
             <h4 class="text-danger text-center">You have not yet filled additional information, Click <a href="{{ route('jobseeker.additions') }}">Here</a> to fill</h4>
           @endif
            <!-- Job Recommendations Section -->
            <div class="card mt-4 shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Recommended Jobs</h5>
                </div>
                <div class="card-body">
                    @if($recommendedJobs->count() > 0)
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Job Title</th>
                                <th>Salary</th>
                                <th>Location</th>
                                <th>Posted</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recommendedJobs as $job)
                            <tr>
                                <td>{{ $job->title }}</td>
                                <td>{{ number_format($job->salary) }}</td>
                                <td>{{ $job->jobAddress->city }}</td>
                                <td>{{ date_format($job->created_at, 'd-m-Y') }}</td>
                                <td>
                                <a href="{{ route('jobseeker.jobdescription') }}" class="btn btn-sm btn-outline-primary">View</a>
        
                                    <a href="#" class="btn btn-sm btn-outline-success">Apply</a>
                                </td>
                            </tr> 
                            @endforeach
                          
                          
                            <!-- More job listings -->
                        </tbody>
                    </table>
                    @endif
                    <center>
                        <a href="" class="text-center mb-2 "><---------View All--------></a>
                    </center>
                
                </div>
                
            </div>
        
            <!-- Application Status Section -->
            <div class="card mt-4 shadow-sm">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Your Applications</h5>
                </div>
                <div class="card-body">
                    @if($myapplication->count() > 0)
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Job Title</th>
                                <th>Salary</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($myapplication as $application)
                                
                          
                            <tr>
                                <td>{{ $application->occupation->title }}</td>
                                <td>{{ $application->occupation->salary }}</td>
                                @if($application->status == 0)
                                <td><span class="badge bg-warning">Under Review</span></td>
                                @else
                                <td><span class="badge bg-success">Accepted</span></td>
                                @endif
                                @if($application->status == 0)
                                <td>
                                <a href="" class="btn btn-sm btn-outline-primary">View</a>
        
                                    <a href="#" class="btn btn-sm btn-outline-danger">Withdraw</a>
                                </td>
                                @else
                                <a href="" class="btn btn-sm btn-outline-primary">View</a>
                                @endif
                            </tr>
                            @endforeach
                            <!-- More applications -->
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        
            <!-- Quick Stats Section -->
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card shadow-sm p-3">
                        <h5 class="fw-bold">Total Applications</h5>
                        <p class="fs-4 text-primary fw-bold">{{ $totalApplications }}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm p-3">
                        <h5 class="fw-bold">Accepted Applications</h5>
                        <p class="fs-4 text-success fw-bold">{{ $acceptedApplications }}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm p-3">
                        <h5 class="fw-bold">Pending Applications</h5>
                        <p class="fs-4 text-danger fw-bold">{{ $pendingApplications }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </main>
@endsection
