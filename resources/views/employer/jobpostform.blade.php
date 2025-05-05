@extends('layouts.sidebar')

@section('title', 'Job Post Form')

@section('content')
<main class="bg-secondary bg-opacity-25 min-vh-100 py-4 px-3">
  <div class="flex-md-row holder  noscrollbar noscrollbarfire" style="height: 90vh; overflow-y: scroll;">
  <div class="container">
    @if($job->id == null)
    <h3 class="fw-bold mb-4 text-primary">Post a New Job</h3>
    @else
    <h3 class="fw-bold mb-4 text-primary">Edit {{ $job->title }}</h3>
    @endif

    <form action="{{$job->id? route('employer.editjobsform',$job->id): route('employer.submitjobsform') }}" method="POST" class="card shadow-sm p-4 bg-white rounded" enctype="multipart/form-data">
      @csrf
      @if(Session::has('fail'))
      <div class="text-danger  text-center mt-1">{{Session::get('fail')}}</div>
      @endif
      <!-- Title -->
      <div class="mb-3">
        <label for="title" class="form-label fw-semibold text-dark">Job Title</label>
        @if($job->id == null)
        <input type="text" name="title" id="title" class="form-control  border border-2 border-primary-subtle" placeholder="Enter job title" required>
        @else
        <input type="text" name="title" id="title" class="form-control  border border-2 border-primary-subtle" value="{{$job->title}}">
        @endif
    </div>

      <!-- Description -->
      <div class="mb-3">
        <label for="description" class="form-label fw-semibold text-dark">Job Description</label>
        <textarea name="description" id="description" class="form-control border border-2 border-primary-subtle" rows="4" placeholder="Describe the role" required>{{ $job->description }}</textarea>
      </div>

      <!-- Salary -->
      <div class="mb-3">
        <label for="salary" class="form-label fw-semibold text-dark">Salary Amount</label>
        @if($job->id == null)
        <input type="number" name="salary" id="salary" class="form-control border border-2 border-primary-subtle" placeholder="e.g. 50000" required>
        @else
        <input type="number" name="salary" id="salary" class="form-control border border-2 border-primary-subtle" value="{{$job->salary}}" >
        @endif
      </div>

      <!-- Occupation Categories -->

      <div class="mb-3">
        <label for="category" class="form-label fw-semibold text-dark">Occupation Category</label>
        @if($job->id == null)
        <select name="categories[]" id="category" class="form-select border border-2 border-primary-subtle" multiple required>
        @else
        <select name="categories[]" id="category" class="form-select border border-2 border-primary-subtle" multiple>
        @endif
            @foreach ($categories  as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option> 
            @endforeach
        </select>
  
      </div>

      <!-- Working Address -->
      <div class="mb-3">
        <label for="address" class="form-label fw-semibold text-dark">Working Address</label>
        @if($job->id == null)
        <input type="text" name="address" id="address" class="form-control border border-2 border-primary-subtle" placeholder="Enter work location" required>
        @else
        <input type="text" name="address" id="address" class="form-control border border-2 border-primary-subtle" value="{{ $job->jobAddress->country.', '.$job->jobAddress->city.', '.$job->jobAddress->district.', '.$job->jobAddress->street }}">
        @endif
      </div>

      <div class="mb-3">
        <label for="address" class="form-label fw-semibold text-dark">Attach PDF</label>
        @if($job->id == null)
        <input type="file" name="jobdocument" accept=".pdf" class="form-control border border-2 border-primary-subtle" placeholder="Enter work location" required>
        @else
        <input type="file" name="jobdocument" accept=".pdf" class="form-control border border-2 border-primary-subtle" placeholder="Enter work location">
        @endif
      </div>

      <!-- Submit Button -->
      <div class="d-grid mt-4">
        @if($job->id == null)
        <button type="submit" class="btn btn-success fw-bold shadow-sm">📩 Post Job</button>
        @else
        <button type="submit" class="btn btn-success fw-bold shadow-sm">📩 Edit Job</button>
        @endif
      </div>

    </form>
  </div>

</main>
@endsection
