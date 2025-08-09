@extends('layouts.joobseekersidebar')

@section('title', 'Job Seeker Dashboard')

@section('content')
<style>
   .ui-datepicker {
            z-index: 1000 !important;
        }
</style>
<main class="bg-secondary bg-opacity-25 min-vh-100 py-4 px-3">
  <div class="flex-md-row holder  noscrollbar noscrollbarfire" style="height: 90vh; overflow-y: scroll;">
  <div class="container">
    @if(empty($jobseeker))
    <h3 class="fw-bold mb-4 text-primary">Add Additional Information</h3>
    @else
    <h3 class="fw-bold mb-4 text-primary">Add Additional Information</h3>
    @endif

    <form action="{{ route('jobseeker.additionspost') }}" method="POST" class="card shadow-sm p-4 bg-white rounded" enctype="multipart/form-data">
      @csrf
      @if(Session::has('fail'))
      <div class="text-danger  text-center mt-1">{{Session::get('fail')}}</div>
      @endif
      <!-- phone -->
      <div class="mb-3">
        <label for="title" class="form-label fw-semibold text-dark">Phone</label>
        @if(empty($jobseeker))
        <input type="text" name="phone"  class="form-control  border border-2 border-primary-subtle" placeholder="Enter phone" required>
        @else
        <input type="text" name="phone"  class="form-control  border border-2 border-primary-subtle" value="{{$jobseeker->phone}}">
        @endif
    </div>

    <div class="mb-3">
        <label for="title" class="form-label fw-semibold text-dark">Country</label>
        @if(empty($jobseeker))
        <input type="text" name="country"  class="form-control  border border-2 border-primary-subtle" placeholder="Enter country" required>
        @else
        <input type="text" name="country"  class="form-control  border border-2 border-primary-subtle" value="{{$jobseeker->country}}">
        @endif
    </div>
    {{-- region --}}
    <div class="mb-3">
        <label for="title" class="form-label fw-semibold text-dark">Region</label>
        @if(empty($jobseeker))
        <input type="text" name="region"  class="form-control  border border-2 border-primary-subtle" placeholder="Enter region/city" required>
        @else
        <input type="text" name="region"  class="form-control  border border-2 border-primary-subtle" value="{{$jobseeker->region}}">
        @endif
    </div>
      <!-- district -->
      <div class="mb-3">
        <label for="title" class="form-label fw-semibold text-dark">District</label>
        @if(empty($jobseeker))
        <input type="text" name="district"  class="form-control  border border-2 border-primary-subtle" placeholder="Enter district" required>
        @else
        <input type="text" name="district"  class="form-control  border border-2 border-primary-subtle" value="{{$jobseeker->district}}">
        @endif
    </div>
    {{-- street --}}
    <div class="mb-3">
        <label for="title" class="form-label fw-semibold text-dark">Street</label>
        @if(empty($jobseeker))
        <input type="text" name="street"  class="form-control  border border-2 border-primary-subtle" placeholder="Enter street" required>
        @else
        <input type="text" name="street"  class="form-control  border border-2 border-primary-subtle" value="{{$jobseeker->street}}">
        @endif
    </div>
      <!-- jobseeker Categories -->

      <div class="mb-3">
        <label for="category" class="form-label fw-semibold text-dark">Choose Occupation Categories</label>
        @if(empty($jobseeker))
        <select name="categories[]" id="category" class="form-select border border-2 border-primary-subtle" multiple required>
        @else
        <select name="categories[]" id="category" class="form-select border border-2 border-primary-subtle" multiple>
        @endif
            @foreach ($categories  as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option> 
            @endforeach
        </select>
  
      </div>

      {{-- gender --}}
      <div class="mb-3">
        <label for="title" class="form-label fw-semibold text-dark">Gender</label>
        @if(empty($jobseeker))
        <select name="gender" class="form-control" required>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
        </select>
        @else
       <select name="gender" class="form-control">
          <option value="Male">Male</option>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
        </select>
        @endif
    </div>
    <label for="title" class="form-label fw-semibold text-dark">Date Of Birth</label>
      <div class="col-md-12">
                    <input type="text" id="dob" name="dob" class="form-control bg-transparent text-secondary"  required>
                </div> 
      <!-- Submit Button -->
      <div class="d-grid mt-4">
        @if(empty($jobseeker))
        <button type="submit" class="btn btn-success fw-bold shadow-sm">Submit</button>
        @else
        <button type="submit" class="btn btn-success fw-bold shadow-sm">Edit</button>
        @endif
      </div>

    </form>
  </div>

</main>
@endsection
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $(function () {
            $('#dob').datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                yearRange: '1900:2025'
            });
        });

        
    </script>
