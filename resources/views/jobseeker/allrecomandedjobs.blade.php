@extends('layouts.joobseekersidebar')

@section('title', 'Job Seeker Dashboard')

@section('content')
@php
  use App\Models\ApplicantJob;
@endphp
<main class="bg-secondary bg-opacity-25 min-vh-100 py-4 px-3">
    <div class="flex-md-row holder  noscrollbar noscrollbarfire" style="height: 90vh; overflow-y: scroll;">
        <div class="container mt-4">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="fw-bold">All Recommended jobs</h3>
            </div>
        
  
            @if($recommendedJobs->count() > 0)
            <div class="col-sm-12">
              <form action="{{ route('jobseeker.recommendedJobSearch') }}" method="post" class="mb-3">
                  @csrf
                  <div class="input-group">
                      <input type="text" name="searchinput" class="search-input form-control" placeholder="Search by title"
                          required autocomplete="on" style="border: 2px solid #4e4d4d;border-right: none;border-radius: 15px 0 0 15px;outline: none;height: 41px;padding-left: 10px;">
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
                <h5 class="mb-0">Jobs</h5>
              </div>
              <div class="card-body table-responsive noscrollbar noscrollbarfire">
                  
                  @if($recommendedJobs->count() > 0)
                  <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Job Title</th>
                            <th>Salary</th>
                            <th>Location</th> 
                            <th>Posted</th>
                            <th>Applied By</th>
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
                            @php
                            $jobapplicants = ApplicantJob::where('job_id',$job->id)->count();
                            @endphp
                            <td>{{ $jobapplicants }} Applicants</td>
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
                  <!-- Pagination Links -->
              <div>
                  {{ $recommendedJobs->links('pagination::bootstrap-5') }}
              </div>
                @else
              
                <h5 class="text-info text-center">No any recommendation to apply</h5>
                @endif
             
              </div>
            </div>
        </div>
          
  
  </main>
@endsection
