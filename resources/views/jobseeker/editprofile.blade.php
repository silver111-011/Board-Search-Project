@extends('layouts.joobseekersidebar')

@section('title', 'Job Seeker Dashboard')

@section('content')

<main class="bg-secondary bg-opacity-25 min-vh-100 py-4 px-3">
  <div class="flex-md-row holder  noscrollbar noscrollbarfire" style="height: 90vh; overflow-y: scroll;">
  <div class="container">

    <h3 class="fw-bold mb-4 text-primary">Edit Profile</h3>
  

    <form action="{{ route('jobseeker.editprofilepost') }}" method="POST" class="card shadow-sm p-4 bg-white rounded" enctype="multipart/form-data">
      @csrf
      @if(Session::has('fail'))
      <div class="text-danger  text-center mt-1">{{Session::get('fail')}}</div>
      @endif
      <div class="mb-3">
        <label for="title" class="form-label fw-semibold text-dark">Name</label>
        @if(empty($jobseeker))
        <input type="text" name="name"  class="form-control  border border-2 border-primary-subtle" placeholder="Enter Full Name" required>
        @else
        <input type="text" name="name"  class="form-control  border border-2 border-primary-subtle" value="{{$jobseeker->name}}">
        @endif
    </div>

    <div class="mb-3">
        <label for="title" class="form-label fw-semibold text-dark">Email</label>
        @if(empty($jobseeker))
        <input type="text" name="email"  class="form-control  border border-2 border-primary-subtle" placeholder="Enter email" required>
        @else
        <input type="text" name="email"  class="form-control  border border-2 border-primary-subtle" value="{{$jobseeker->email}}">
        @endif
    </div>
      <!-- phone -->
      <div class="mb-3">
        <label for="title" class="form-label fw-semibold text-dark">Phone</label>
        @if(empty($jobseeker->employeeMoreDetails))
        <input type="text" name="phone"  class="form-control  border border-2 border-primary-subtle" placeholder="Enter phone" required>
        @else
        <input type="text" name="phone"  class="form-control  border border-2 border-primary-subtle" value="{{$jobseeker->employeeMoreDetails->phone}}">
        @endif
    </div>
    {{--Date of birth  --}}
    <div class="mb-3">
        <label for="title" class="form-label fw-semibold text-dark">Date Of Birth</label>
        @if(empty($jobseeker->employeeMoreDetails))
        <input type="text" class="form-control" id="dob" name="dob" placeholder="date of birth" required>
        @else
        @php
            $dob = \Carbon\Carbon::now()->subYears($jobseeker->employeeMoreDetails->age)->format('d-m-Y');
          
        @endphp
        <input type="text" class="form-control" id="dob" name="dob" placeholder="{{$dob}}" >
        @endif
    </div>
    <div class="mb-3">
        <label for="title" class="form-label fw-semibold text-dark">Gender</label>
        @if(empty($jobseeker->employeeMoreDetails))
        <select name="gender" class="form-control" required>
         <option value="Male">Male</option>
         <option value="Female">Female</option>
         @else
        <select name="gender" class="form-control">
         @if($jobseeker->employeeMoreDetails->gender == 'Male')
         <option value="Male">Male</option>
         <option value="Female">Female</option>
         @else
         <option value="Female">Female</option>
         <option value="Male">Male</option>
         @endif
         @endif
        </select>
    </div>
    <div class="mb-3">
        <label for="title" class="form-label fw-semibold text-dark">Marital Status</label>
        @if(empty($jobseeker->employeeMoreDetails))
        <select name="marital" class="form-control" required>
            <option value="1">Married</option>
            <option value="0">Single</option>
         @else
        <select name="marital" class="form-control">
        @if($jobseeker->employeeMoreDetails->is_married == 1)
         <option value="1">Married</option>
         <option value="0">Single</option>
         @else
         <option value="0">Single</option>
         <option value="1">Married</option>
         @endif
         @endif
        </select>
    </div>
    <div class="mb-3">
        <label for="title" class="form-label fw-semibold text-dark">Country</label>
        @if(empty($jobseeker->employeeMoreDetails))
        <input type="text" name="country"  class="form-control  border border-2 border-primary-subtle" placeholder="Enter country" required>
        @else
        <input type="text" name="country"  class="form-control  border border-2 border-primary-subtle" value="{{$jobseeker->employeeMoreDetails->country}}">
        @endif
    </div>
    {{-- region --}}
    <div class="mb-3">
        <label for="title" class="form-label fw-semibold text-dark">Region</label>
        @if(empty($jobseeker->employeeMoreDetails))
        <input type="text" name="region"  class="form-control  border border-2 border-primary-subtle" placeholder="Enter region/city" required>
        @else
        <input type="text" name="region"  class="form-control  border border-2 border-primary-subtle" value="{{$jobseeker->employeeMoreDetails->region}}">
        @endif
    </div>
      <!-- district -->
      <div class="mb-3">
        <label for="title" class="form-label fw-semibold text-dark">District</label>
        @if(empty($jobseeker->employeeMoreDetails))
        <input type="text" name="district"  class="form-control  border border-2 border-primary-subtle" placeholder="Enter district" required>
        @else
        <input type="text" name="district"  class="form-control  border border-2 border-primary-subtle" value="{{$jobseeker->employeeMoreDetails->district}}">
        @endif
    </div>
    {{-- street --}}
    <div class="mb-3">
        <label for="title" class="form-label fw-semibold text-dark">Street</label>
        @if(empty($jobseeker->employeeMoreDetails))
        <input type="text" name="street"  class="form-control  border border-2 border-primary-subtle" placeholder="Enter street" required>
        @else
        <input type="text" name="street"  class="form-control  border border-2 border-primary-subtle" value="{{$jobseeker->employeeMoreDetails->street}}">
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

   <!-- jQuery Library -->
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

   <!-- jQuery UI -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
   
   
   
   <style>
       .ui-datepicker {
           background: #fff; /* White background */
           border: 1px solid #ccc;
           box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
           padding: 10px;
           border-radius: 8px;
           z-index: 1000 !important; /* Ensure it's above other elements */
       }
   </style>
   
   <script>
       $(document).ready(function() {
           $("#dob").datepicker({
               dateFormat: "yy-mm-dd",
               changeMonth: true,
               changeYear: true,
               yearRange: "1900:2025"
           });
       });
   </script>