@extends('layouts.sidebar')

@section('title', 'Applicants')

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
                <div class="col-md-12">
                    <h4 class="fw-bold">Posted Jobs</h4>
                </div>

            </div>
            @if($occupations->count() > 0)
            <div class="col-sm-12">
                <form action="{{ route('employer.jobssearch') }}" method="post" class="mb-3">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="searchinput" class="search-input form-control"
                            placeholder="Search Applicant" required autocomplete="on"
                            style="border: 2px solid #4e4d4d;border-right: none;border-radius: 15px 0 0 15px;outline: none;height: 41px;padding-left: 10px;">
                        <button class="search-button" type="submit">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </div>
                </form>
            </div>
            @endif
            <!-- Job Postings Card -->
            <div class="card mt-4 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">All Jobs</h5>
                </div>
                <div class="card-body table-responsive noscrollbar noscrollbarfire">
                    @if($occupations->count() > 0)
                    <table class="table table-hover align-middle text-nowrap">
                        <thead class="table-light">
                            <tr>
                                <th>Job Title</th>
                                <th>Salary (TZS)</th>
                                <th>Applicants</th>
                                <th>Status</th>
                                <th>Created On</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($occupations as $job)
                            <tr>
                                <td>{{ $job->title }}</td>
                                <td> {{number_format($job->salary) }}</td>
                                @php
                                $jobapplicants = ApplicantJob::where('job_id',$job->id)->count();
                                @endphp
                                <td>{{ $jobapplicants }} Applicants</td>
                                @if($job->is_closed == 0)
                                <td><span class="badge bg-success">Active</span></td>
                                @else
                                <td><span class="badge bg-danger">Closed</span></td>
                                @endif
                                <td>{{ date_format($job->created_at, 'd-m-Y') }}</td>
                                <td>
                                    <a href="{{ route('employer.jobDetail',$job->id) }}"
                                        class="btn btn-sm btn-outline-info">View</a>
                                    <a href="{{ route('employer.jobsform',$job->id) }}"
                                        class="btn btn-sm btn-outline-warning">Edit</a>
                                    <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal">Delete</button>
                                    @if($job->is_closed == 0)
                                    <a href="{{ route('employer.closeOpenJob',['jobId'=>$job->id, 'status' => 1]) }}"
                                        class="btn btn-sm btn-outline-secondary">Close</a>
                                    @else
                                    <a href="{{ route('employer.closeOpenJob',['jobId'=>$job->id, 'status' => 0]) }}"
                                        class="btn btn-sm btn-outline-success">Open</a>
                                    @endif

                                </td>
                            </tr>
                            <!-- Delete Confirmation Modal -->
                            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-danger">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="mb-0">⚠️ Are you sure you want to delete this job posting? This
                                                action cannot be undone.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('employer.deleteJob',$job->id) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-danger"
                                                    data-bs-dismiss="modal">Delete</button>
                                            </form>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach


                        </tbody>
                    </table>

                    <!-- Pagination Links -->
                    <div>
                        {{ $occupations->links('pagination::bootstrap-5') }}
                    </div>
                    @else
                    @endif
                </div>
            </div>


        </div>

</main>
@endsection