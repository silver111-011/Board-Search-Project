@extends('layouts.joobseekersidebar')

@section('title', 'Job Seeker Dashboard')

@section('content')

<main class="bg-secondary bg-opacity-25 min-vh-100 py-4 px-3">
    <div class="flex-md-row holder  noscrollbar noscrollbarfire" style="height: 90vh; overflow-y: scroll;">
        <div class="container mt-4">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="fw-bold">Employee Dashboard</h2>
                <a href="{{ route('jobseeker.allJobs') }}" class="btn btn-success">+ Apply for a Job</a>
            </div>

            <p class="text-muted">Find and apply for jobs that match your skills.</p>
            @if($additionInfo == 0)
            <h5 class="text-danger text-center">You have not yet filled additional information, Click <a
                    href="{{ route('jobseeker.additions') }}">Here</a> to fill</h5>
            @endif
            <!-- Job Recommendations Section -->
            <div class="card mt-4 shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Recommended Jobs</h5>
                </div>
                <div class="card-body">
                    @if($recommendedJobs->count() > 0)
                    <div class="table-responsive noscrollbar noscrollbarfire">
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
                                <td>{{ $job->jobAddress->country }}</td>
                                <td>{{ date_format($job->created_at, 'd-m-Y') }}</td>
                                <td>
                                    <a href="{{ route('jobseeker.jobdescription',$job->id) }}"
                                        class="btn btn-sm btn-outline-primary">View</a>

                                    <a href="{{route('jobseeker.applicationForm',$job->id)}}" class="btn btn-sm btn-outline-success">Apply</a>
                                </td>
                            </tr>
                            @endforeach


                            <!-- More job listings -->
                        </tbody>
                    </table>
                    </div>
                    @endif
                    <center>
                        <a href="{{ route('allRecommandedJobs') }}" class="text-center mb-2 ">
                            <---------View All-------->
                        </a>
                    </center>

                </div>

            </div>
            @if(Session::has('fail'))
            <div class="text-danger  text-center mt-1">{{Session::get('fail')}}</div>
            @endif
            @if(Session::has('success'))
            <div class="text-success  text-center mt-1">{{Session::get('success')}}</div>
            @endif

            <!-- Application Status Section -->
            <div class="card mt-4 shadow-sm">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">My Applications</h5>
                </div>
                <div class="card-body">
                    @if($myapplication->count() > 0)
                    <div class="table-responsive noscrollbar noscrollbarfire">
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
                                    <a href="{{ route('jobseeker.jobdescription',$application->occupation->id) }}" class="btn btn-sm btn-outline-primary">View</a>

                                    <a href="#"class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal-{{ $application->id }}">Withdraw</a>
                                    <!-- Delete Confirmation Modal -->
                                    <div class="modal fade" id="deleteModal-{{ $application->id }}"  tabindex="-1"
                                        aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-danger">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="mb-0">⚠️ Are you sure you want to withdraw this application?
                                                        This action cannot be undone.</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                         <form action="{{ route('jobseeker.applicationWithdraw', $application->occupation->id) }}" method="post"> 
                                                            @csrf
                                                        <button type="submit"  class="btn btn-danger"
                                                            data-bs-dismiss="modal">Withdraw</button>
                                              
                                                        </form>
                                               
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                @else
                                <a href="{{ route('jobseeker.jobdescription',$application->occupation->id) }}" class="btn btn-sm btn-outline-primary">View</a>
                                @endif
                            </tr>
                            @endforeach
                            <!-- More applications -->
                        </tbody>
                    </table>
                    </div>
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