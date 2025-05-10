@extends('layouts.adminsidebar')

@section('title', 'Dashboard')

@section('content')


<main class="bg-secondary bg-opacity-25 min-vh-100 py-4 px-3">

  <div class="container">
    @if(empty($employer->charges))
    <h4 class="fw-bold">Assign Fee for {{' '. $employer->name }}</h4>
    @else
    <h4 class="fw-bold">Edit Fee for{{ ' '.$employer->name }}</h4>
    @endif
    <form action="{{$employer->charges != null?route('admin.employerchargesFormEdit',$employer->id): route('admin.employerchargesFormPost',$employer->id) }}" method="POST" class="card shadow-sm p-4 bg-white rounded">
      @csrf
      @if(Session::has('fail'))
      <div class="text-danger  text-center mt-1">{{Session::get('fail')}}</div>
      @endif
      <!-- Title -->
      <div class="mb-3">
        <label for="title" class="form-label fw-semibold text-dark">Fee Amount</label>
        @if(empty($employer->charges))
        <input type="number" name="charges" id="title" class="form-control  border border-2 border-primary-subtle" placeholder="Enter Amount" required>
        @else
        <input type="text" name="charges" id="title" class="form-control  border border-2 border-primary-subtle" value="{{$employer->charges->amount}}">
        @endif
    </div>

      <!-- Submit Button -->
      <div class="d-grid mt-4">
        @if(empty($employer->charges))
        <button type="submit" class="btn btn-success fw-bold shadow-sm text-black">Assign</button>
        @else
        <button type="submit" class="btn btn-success fw-bold shadow-sm text-black"> Edit</button>
        @endif
      </div>

    </form>
  </div>

</main>
@endsection
