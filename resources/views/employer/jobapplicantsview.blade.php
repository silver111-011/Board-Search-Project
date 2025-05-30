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
        <div class="col-md-12">
          <h4 class="fw-bold">Applicants For {{ $job->title }} Job</h4>
        </div>

      </div>
      @if($applicants->count() > 0)
      <div class="col-sm-12">
        <form action="{{ route('employer.jobApplicantsearch',$job->id) }}" method="post" class="mb-3">
          @csrf
          <div class="input-group">
            <input type="text" name="searchinput" class="search-input form-control" placeholder="Search Applicant"
              required autocomplete="on"
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
          <h5 class="mb-0">Applicants</h5>
        </div>
        <div class="card-body table-responsive noscrollbar noscrollbarfire">

          @if($applicants->count() > 0)
       
          <div class="mb-3 d-flex justify-content-end">
            <a href="{{ route('employer.downloadAcceptedApplicantsPDF', $job->id) }}" class="btn btn-danger">
              <i class="fa fa-file-pdf-o"></i> Download Accepted Applicants PDF
            </a>
          </div>
          

          <table class="table table-hover align-middle text-nowrap">
            <thead class="table-light">
              <tr>
                <th>Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Marrital Status</th>
                <th>Application Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>


              <tr>
                @foreach ($applicants as $applicant)
                <td>{{ $applicant->applicant->name }}</td>
                <td>{{ $applicant->applicant->employeeMoreDetails->age }}</td>
                <td>{{ $applicant->applicant->employeeMoreDetails->gender }} </td>
                @if( $applicant->applicant->employeeMoreDetails->is_married == 0)
                <td>{{ 'Single' }} </td>
                @else
                <td>{{ 'Married' }} </td>
                @endif
                @php
                $applicantjob =
                ApplicantJob::where([['job_id',$job->id],['applicant_id',$applicant->applicant->id]])->first();
                @endphp
                @if($applicantjob->status == 0)
                <td><span class="badge bg-warning">Not Checked</span></td>
                @endif
                @if($applicantjob->status == 3)
                <td><span class="badge bg-danger">Disqualified</span></td>
                @endif
                @if($applicantjob->status == 1)
                <td><span class="badge bg-success">Accepted</span></td>
                @endif
                <td>
                  <a href="{{ route('employer.applicantDetails',['applicantid' => $applicant->applicant->id, 'jobid'=>$job->id]) }}"
                    class="btn btn-sm btn-outline-info">View More</a>
                </td>
              </tr>
              @endforeach

            </tbody>
          </table>
          <!-- Pagination Links -->
          <div>
            {{ $applicants->links('pagination::bootstrap-5') }}
          </div>
          @else

          <h5 class="text-info text-center">No any applicant for this job</h5>
          @endif

        </div>
      </div>
    </div>
</main>
@endsection