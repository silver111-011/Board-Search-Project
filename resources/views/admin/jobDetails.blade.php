@extends('layouts.adminsidebar')

@section('title', 'Dashboard')

@section('content')


<!-- Your page-specific content here -->
<main class="bg-secondary bg-opacity-25 min-vh-100">

  <div class="flex-md-row holder   noscrollbar noscrollbarfire" style="height: 90vh; overflow-y: scroll;">
     <div class="container-fluid mt-4">
           <!-- Header Section -->
      <div class="row align-items-center">
        <div class="col-md-12">
          <h3 class="fw-bold">Job Details </h3>
        </div>
     
     </div>
     <hr>
     @foreach ($jobs as $job)
     <div class="col-sm-12">
        <h3>Job Title</h3>
        <h4>{{ $job->title }}</h4>
     </div>
     <hr>
     <div class="col-sm-12">
        <h3>Job Salary</h3>
        <h4>{{number_format($job->salary)   }} TZS</h4>
     </div>
     <hr>
     <div class="col-sm-12">
        <h3>Job Description</h3>
        <h4>{{ $job->description }}</h4>
     </div>
     <hr>
     <div class="col-sm-12">
        <h3>Job Categories</h3>
        @foreach ($job->jobCategories as $category)
        <h4>{{ $category->category->name }}</h4>   
        @endforeach
      
     </div>
     <hr>
     <div class="col-sm-12">
        <h3>Employer Information</h3>
        <h4>{{ $job->employer->name }}</h4>
        <h4>{{ $job->employer->email }}</h4>
     </div>
     <hr>
     <div class="col-sm-12">
        <h3>Job Address</h3>
        <h4>{{ $job->jobAddress->country.', '.$job->jobAddress->city.', '.$job->jobAddress->district.', '.$job->jobAddress->street }}</h4>
     </div>
     <hr>


     @endforeach
     <a href="{{ route('admin.jobDelete',$job->id) }}"  class="btn btn-danger fw-bold form-control shadow-sm text-black"> Delete</a>
  </div>

</main>
@endsection