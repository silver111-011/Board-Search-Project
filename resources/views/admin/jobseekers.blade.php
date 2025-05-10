@extends('layouts.adminsidebar')

@section('title', 'Dashboard')

@section('content')


<!-- Your page-specific content here -->
<main class="bg-secondary bg-opacity-25 min-vh-100">

  <div class="flex-md-row holder  noscrollbar noscrollbarfire" style="height: 90vh; overflow-y: scroll;">
    <div class="container-fluid mt-4">
      <!-- Header Section -->
      <div class="row align-items-center">
        <div class="col-md-12">
          <h4 class="fw-bold">All Job Seekers</h4>
        </div>
     
      </div>
      @if($jobSeekers->count() > 0)
      <div class="col-sm-12">
        <form action="{{ route('admin.jobSeekersearch') }}" method="post" class="mb-3">
            @csrf
            <div class="input-group">
                <input type="text" name="searchinput" class="search-input form-control" placeholder="Search Applicant"
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
        <div class="card-header bg-black text-white">
          <h5 class="mb-0">Job Seekers Detail</h5>
        </div>
        <div class="card-body table-responsive noscrollbar noscrollbarfire">
            @if(Session::has('success'))
            <h5 class="text-success  text-center mt-1">{{Session::get('success')}}</h5>
            @endif
            @if($jobSeekers->count() > 0)
           <table class="table table-hover align-middle text-nowrap">
            <thead class="table-light">
              <tr>
                <th>Name</th>
                <th>Email</th>
            
              </tr>
            </thead>
            <tbody> 
            <tr>
              @foreach ($jobSeekers as $jobseeker)
                  
             
              <td>{{ $jobseeker->name }}</td>
              <td>{{ $jobseeker->email }}</td>
            </tr>
            @endforeach
          
            </tbody>
          </table>
            <!-- Pagination Links -->
        <div>
            {{ $jobSeekers->links('pagination::bootstrap-5') }}
        </div>
          @else
        
          <h5 class="text-info text-center">No any job seeker yet</h5>
          @endif
       
        </div>
      </div>


  </div>

</main>
@endsection