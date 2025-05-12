@extends('layouts.adminsidebar')

@section('title', 'Dashboard')

@section('content')

<main class="bg-secondary bg-opacity-25 min-vh-100 py-4 px-3">
  <div class="flex-md-row holder  noscrollbar noscrollbarfire" style="height: 90vh; overflow-y: scroll;">
  <div class="container">
    @if($category->id == null)
    <h3 class="fw-bold mb-4 text-primary">Post a New Category</h3>
    @else
    <h3 class="fw-bold mb-4 text-primary">Edit Category {{ $category->name }}</h3>
    @endif

    <form action="{{$category->id?route('admin.categoriesFormPost',$category->id):route('admin.categoriesFormPost') }}" method="POST" class="card shadow-sm p-4 bg-white rounded" enctype="multipart/form-data">
      @csrf
      @if(Session::has('fail'))
      <div class="text-danger  text-center mt-1">{{Session::get('fail')}}</div>
      @endif
      <!-- Title -->
      <div class="mb-3">
        <label for="title" class="form-label fw-semibold text-dark">Category Name</label>
        @if($category->id == null)
        <input type="text" name="category" id="title" class="form-control  border border-2 border-primary-subtle" placeholder="Enter Category" required>
        @else
        <input type="text" name="category" id="title" class="form-control  border border-2 border-primary-subtle" value="{{$category->name}}">
        @endif
    </div>


      <!-- Submit Button -->
      <div class="d-grid mt-4">
        @if($category->id == null)
        <button type="submit" class="btn btn-success fw-bold shadow-sm">Submit</button>
        @else
        <button type="submit" class="btn btn-success fw-bold shadow-sm">Edit</button>
        @endif
      </div>

    </form>
  </div>

</main>
@endsection
