@extends('layouts.joobseekersidebar')

@section('title', 'Job Seeker Dashboard')

@section('content')

<main class="bg-secondary bg-opacity-25 min-vh-100 py-4 px-3">
    <div class="flex-md-row holder  noscrollbar noscrollbarfire" style="height: 90vh; overflow-y: scroll;">
        <div class="container mt-4">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="fw-bold">Application Form</h3>

            </div>
        
                @if($additionInfo == 0)
            <h5 class="text-danger text-center">You have not yet filled additional information, Click <a
                    href="{{ route('jobseeker.additions') }}">Here</a> to fill</h5>
            @endif
                <div class="card shadow">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">Personal information</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><strong>Employee Name:</strong> {{ $jobseeker->name }}</h5>
                        @if(!empty($jobseeker->employeeMoreDetails))
                        <p><strong>Contacts:</strong> {{($jobseeker->email.', '.$jobseeker->employeeMoreDetails->phone) }}</p>
                        <p><strong>Location:</strong> {{ $jobseeker->employeeMoreDetails->country.','.$jobseeker->employeeMoreDetails->city.','.$jobseeker->employeeMoreDetails->district.','.$jobseeker->employeeMoreDetails->street }}</p>

                        @else
                        <p><strong>Contacts:</strong></p>
                        <p><strong>Location:</strong> </p>

                        @endif
                       
            
                        <hr>
                        <form action="{{ route('jobseeker.applicationFormPost',$job->id) }}" method="post" enctype="multipart/form-data">
                           @csrf
                           @if(Session::has('fail'))
                           <div class="text-danger  text-center mt-1">{{Session::get('fail')}}</div>
                           @endif
                           @if(Session::has('success'))
                           <div class="text-success  text-center mt-1">{{Session::get('success')}}</div>
                           @endif
                        
                            <div class="mb-3">
                                <label for="address" class="form-label fw-semibold text-dark">Required Attachments (PDF)</label>
                                <input type="file" name="jobdocument" accept=".pdf" class="form-control border border-2 border-primary-subtle" placeholder="Required Attachments" required>
                            </div>

                            <button class="btn btn-secondary">Submit</button>
                        </form>
                        
            
                    </div>
                </div>
            </div>
          
  
  </main>
@endsection
