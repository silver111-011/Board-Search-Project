@extends('layouts.adminsidebar')

@section('title', 'Dashboard')

@section('content')


<main class="bg-secondary bg-opacity-25 min-vh-100 py-4 px-3">

  <div class="container">
     <!-- Header Section -->
     <div class="row align-items-center">
        <div class="col-md-6">
          <h3 class="fw-bold">Job Categories</h3>
        </div>
        <div class="col-md-6 text-md-end mt-3 mt-md-0">
          <a href="{{ route('admin.categoriesformView') }}" class="btn btn-success">
            + Category
          </a>
        </div>
      </div>
      

      @if($categories->count() > 0)
      <div class="col-sm-12 mt-2">
        <form action="{{ route('admin.categorysearch') }}" method="post" class="mb-3">
            @csrf
            <div class="input-group">
                <input type="text" name="searchinput" class="searchinput form-control" placeholder="Search Job"
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
          <h5 class="mb-0">Categories</h5>
        </div>
        <div class="card-body table-responsive noscrollbar noscrollbarfire">
            @if(Session::has('success'))
            <h5 class="text-success  text-center mt-1">{{Session::get('success')}}</h5>
            @endif
            @if($categories->count() > 0)
           <table class="table table-hover align-middle text-nowrap">
            <thead class="table-light">
              <tr>
                <th>S/N</th>
                <th>Name</th>
                <th colspan="2">Action</th>
              </tr>
            </thead>
            <tbody> 
            <tr>
              @foreach ($categories as $category)
                  
             
              <td>{{ $loop->index + 1 }}</td>
              <td>{{ $category->name }}</td>
              <td>
                <a href="{{ route('admin.categoriesformView',$category->id) }}" class="btn btn-sm btn-outline-success">Edit</a>
                <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                  data-bs-target="#deleteModal-{{ $category->id }}">Delete</button>
              </td>
            </tr>
              <!-- Delete Confirmation Modal -->
              <div class="modal fade" id="deleteModal-{{ $category->id }}" tabindex="-1" aria-labelledby="deleteModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content border-danger">
                    <div class="modal-header bg-danger text-white">
                      <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <p class="mb-0">⚠️ Are you sure you want to delete this category? This action cannot be undone.
                      </p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                      <form action="{{ route('admin.deleteJobCategory',$category->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Delete</button>
                      </form>

                      </form>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          
            </tbody>
          </table>
            <!-- Pagination Links -->
        <div>
            {{ $categories->links('pagination::bootstrap-5') }}
        </div>
          @else
        
          <h5 class="text-info text-center">No any category yet</h5>
          @endif
   
  </div>

</main>
@endsection
