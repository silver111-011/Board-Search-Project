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
                <h3 class="fw-bold">All Applications</h3>
            </div>
        
  
            @if($myapplication->count() > 0)
            <div class="col-sm-12">
              <form action="{{ route('jobseeker.allApplicationsSearch') }}" method="post" class="mb-3">
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
                <h5 class="mb-0">Applications</h5>
              </div>
              <div class="card-body table-responsive noscrollbar noscrollbarfire">
                  
                  @if($myapplication->count() > 0)
                  <table class="table table-hover">
           
                    <thead>
                        <tr>
                            <th>Job Title</th>
                            <th>Salary</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($myapplication as $application)


                        <tr>
                            <td>{{ $application->occupation->title }}</td>
                            <td>{{ $application->occupation->salary }}</td>
                            @if($application->status == 0)
                            <td><span class="badge bg-warning">Under Review</span></td>
                            @else
                            <td><span class="badge bg-success">Accepted</span></td>
                            @endif
                            @if($application->status == 0)
                            <td>
                                <a href="{{ route('jobviewforallapplication',$application->occupation->id) }}" class="btn btn-sm btn-outline-primary">View</a>

                                <a href="#"class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteModal-{{ $application->id }}">Withdraw</a>
                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="deleteModal-{{ $application->id }}"  tabindex="-1"
                                    aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-danger">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="mb-0">⚠️ Are you sure you want to withdraw this application?
                                                    This action cannot be undone.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                     <form action="{{ route('jobseeker.applicationWithdraw', $application->occupation->id) }}" method="post"> 
                                                        @csrf
                                                    <button type="submit"  class="btn btn-danger"
                                                        data-bs-dismiss="modal">Withdraw</button>
                                          
                                                    </form>
                                           
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            @else
                            <a href="{{ route('jobviewforallapplication',$application->occupation->id) }}" class="btn btn-sm btn-outline-primary">View</a>
                            @endif
                        </tr>
                        @endforeach
                        <!-- More applications -->
                    </tbody>
                </table>
                  <!-- Pagination Links -->
              <div>
                  {{ $myapplication->links('pagination::bootstrap-5') }}
              </div>
                @else
              
                <h5 class="text-info text-center">No any application yet</h5>
                @endif
             
              </div>
            </div>
        </div>
          
  
  </main>
@endsection
