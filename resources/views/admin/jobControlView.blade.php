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
          <h4 class="fw-bold">UnVerifed Jobs</h4>
        </div>
     
      </div>
      @if($jobs->count() > 0)
      <div class="col-sm-12">
        <form action="" method="post" class="mb-3">
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
          <h5 class="mb-0">Job Partials</h5>
        </div>
        <div class="card-body table-responsive noscrollbar noscrollbarfire">
            @if(Session::has('success'))
            <h5 class="text-success  text-center mt-1">{{Session::get('success')}}</h5>
            @endif
            @if($jobs->count() > 0)
           <table class="table table-hover align-middle text-nowrap">
            <thead class="table-light">
              <tr>
                <th>Title</th>
                <th>Saralary</th>
                <th>Posted On</th>
                <th>Posted By</th>
                <th>Action</th>
            
              </tr>
            </thead>
            <tbody> 
            <tr>
              @foreach ($jobs as $job)
                  
             
              <td>{{ $job->title }}</td>
              <td>{{ $job->salary }}</td>
              <td>{{ date_format($job->created_at, 'd-m-Y') }}</td>
              <td>{{ $job->employer->name }}</td>
              <td><a href="{{ route('admin.jobDetail',$job->id) }}" class="btn btn-outline-success mb-2">View More</a></td>

            </tr>
            @endforeach
          
            </tbody>
          </table>
            <!-- Pagination Links -->
        <div>
            {{ $jobs->links('pagination::bootstrap-5') }}
        </div>
          @else
        
          <h5 class="text-info text-center">No any jobs yet</h5>
          @endif
       
        </div>
      </div>


  </div>

</main>
@endsection