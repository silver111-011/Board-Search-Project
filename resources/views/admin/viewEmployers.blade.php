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
          <h4 class="fw-bold">All Employers</h4>
        </div>
     
      </div>
      @if($employers->count() > 0)
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
          <h5 class="mb-0">Employers Detail</h5>
        </div>
        <div class="card-body table-responsive noscrollbar noscrollbarfire">
            @if(Session::has('success'))
            <h5 class="text-success  text-center mt-1">{{Session::get('success')}}</h5>
            @endif
            @if($employers->count() > 0)
           <table class="table table-hover align-middle text-nowrap">
            <thead class="table-light">
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Fee Status</th>
                <th>Fee Amount (TZS)</th>
                <th>Blocked Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
        
         
            <tr>
              @foreach ($employers as $employer)
                  
             
              <td>{{ $employer->name }}</td>
              <td>{{ $employer->email }}</td>
              @if (!empty($employer->charges))
              
              <td class="text-success">{{ 'Assigned' }}</td>
              <td>{{ $employer->charges->amount}}</td>
              @else
              <td class="text-danger">{{ 'Unassigned' }}</td> 
              <td>{{ '0'}}</td>
              @endif
        
              @if($employer->is_blocked == 0)
              <td class=" text-success">{{  'not blocked' }}</td>
              @else
              <td class="text-danger">{{  'blocked' }}</td>
              @endif
  
              <td>
                @if($employer->is_blocked == 0)
                <a href="{{ route('admin.blockUnblock',['id' => $employer->id, 'status' => 1]) }}" class="btn btn-sm btn-outline-danger">Block</a>
                @else
                <a href="{{ route('admin.blockUnblock',['id' => $employer->id, 'status' => 0]) }}" class="btn btn-sm btn-outline-success">Unblock</a>
                @endif
                @if (!empty($employer->charges))
                <a href="{{ route('admin.employerchargesForm',$employer->id) }}" class="btn btn-sm btn-outline-secondary">Edit Fee</a>
                @else
                <a href="{{ route('admin.employerchargesForm',$employer->id) }}" class="btn btn-sm btn-outline-secondary">Assign Fee</a>
                @endif
                
              </td>
            </tr>
            @endforeach
          
            </tbody>
          </table>
            <!-- Pagination Links -->
        <div>
            {{ $employers->links('pagination::bootstrap-5') }}
        </div>
          @else
        
          <h5 class="text-info text-center">No any employer yet</h5>
          @endif
       
        </div>
      </div>


  </div>

</main>
@endsection