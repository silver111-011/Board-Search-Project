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
        <form action="{{ route('admin.employersearch') }}" method="post" class="mb-3">
            @csrf
            <div class="input-group">
                <input type="text" name="searchinput" class="search-input form-control" placeholder="Search Employer"
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
            <table class="table">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Charge Status</th>
                  <th>Charge Fee (TZS)</th>
                  <th>Block Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($employers as $employer)
                <tr>
                  <td>{{ $employer->name }}</td>
                  <td>{{ $employer->email }}</td>
            
                  @if (!empty($employer->charges))
                    <td class="text-success">Assigned</td>
                    <td>{{ $employer->charges->amount }}</td>
                  @else
                    <td class="text-danger">Unassigned</td> 
                    <td>0</td>
                  @endif
            
                  <td class="{{ $employer->is_blocked ? 'text-danger' : 'text-success' }}">
                    {{ $employer->is_blocked ? 'Blocked' : 'Not Blocked' }}
                  </td>
            
                  <td>
                    <a href="{{ route('admin.blockUnblock', ['id' => $employer->id, 'status' => $employer->is_blocked ? 0 : 1]) }}" 
                       class="btn btn-sm {{ $employer->is_blocked ? 'btn-outline-success' : 'btn-outline-danger' }}">
                       {{ $employer->is_blocked ? 'Unblock' : 'Block' }}
                    </a>
            
                    <a href="{{ route('admin.employerchargesForm', $employer->id) }}" class="btn btn-sm btn-outline-secondary">
                      {{ $employer->charges ? 'Edit Fee' : 'Assign Fee' }}
                    </a>
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