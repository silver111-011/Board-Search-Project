@extends('layouts.sidebar')

@section('title', 'Applicant Detail')

@section('content')
@php
    use App\Models\ApplicantJob;
@endphp
<main class="bg-secondary bg-opacity-25 min-vh-100 py-4 px-3">
<div class="container mt-4">
  
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Applicant Details</h4>
        </div>
        <div class="card-body">
            <h5 class="card-title"><strong>Employee Name:</strong> {{ $jobseeker->name }}</h5>
            @if(!empty($jobseeker->employeeMoreDetails))
            <p><strong>Contacts:</strong> {{($jobseeker->email.', '.$jobseeker->employeeMoreDetails->phone) }}</p>
            <p><strong>Age:</strong> {{($jobseeker->employeeMoreDetails->age.' Years') }}</p>
            <p><strong>Marital Status: </strong>
                @if($jobseeker->employeeMoreDetails->is_married == 0)
                 {{('Single') }}
                @else
                {{('Married') }}
                @endif
            </p>
            <p><strong>Gender:</strong> {{($jobseeker->employeeMoreDetails->gender) }}</p>
              
            <p><strong>Location:</strong> {{ $jobseeker->employeeMoreDetails->country.','.$jobseeker->employeeMoreDetails->city.','.$jobseeker->employeeMoreDetails->district.','.$jobseeker->employeeMoreDetails->street }}</p>

            @else
            <p><strong>Contacts:</strong></p>
            <p><strong>Location:</strong> </p>

            @endif
 
            <hr>
            @php
                $applicantjob = ApplicantJob::where([['job_id',$job->id],['applicant_id',$jobseeker->id]])->first();
            @endphp

            @if($job->pdf_path)
                <p><strong>Attachments:</strong></p>
                <a href="{{ asset('storage/' .   $applicantjob->attachments) }}" class="btn btn-outline-primary" target="_blank">
                    📄 View Attchments
                </a>
            @endif

            <div class="mt-4 d-flex justify-content-between">
                <a href="{{ route('employer.recruitDisqualify',['applicantid'=>$jobseeker->id, 'jobid' => $job->id, 'action' => 0]) }}" class="btn btn-danger">Disqualify</a>
           
                <a href="{{ route('employer.recruitDisqualify',['applicantid'=>$jobseeker->id, 'jobid' => $job->id, 'action' => 1]) }}" class="btn btn-success">Recruit</a>
         
                
            </div>
        </div>
    </div>
</div>
</main>
@endsection
