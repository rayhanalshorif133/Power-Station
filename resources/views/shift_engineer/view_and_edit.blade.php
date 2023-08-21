@extends('layouts.admin.admin')


@section('head')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
<style>
 .dropdown-menu {
  color: #000000 !important;
 }

 .editBtn {
  padding: 2px 7px !important;
 }

 .checkBtn {
  padding: 2px 7px !important;
 }

 .bg-green-400 {
  background-color: #01bf70;
 }
</style>

@endsection
@section('content')
<div class="card mb-3">
 <div class="card-body">
  <div class="row">
   <div class="col-md-6">
    <h5 class="mb-2 mb-md-0">
     Details of ShiftEngineer
    </h5>
   </div>
   <div class="col-md-6">
    <div class="d-flex align-items-center justify-content-end">
     <a class="" href="{{ route('shift-engineer.index') }}">
      <button class="btn btn-falcon-danger btn-sm ms-2" type="button">
       <span class="fas fas fa-backspace" data-fa-transform="shrink-3"></span>
       <span class="d-none d-sm-inline-block ms-1">Back</span>
      </button>
     </a>
    </div>
   </div>
  </div>
 </div>
</div>
<div class="card mb-3">
 <div class="card-body">
  <div class="bg-holder d-none d-lg-block bg-card"
   style="background-image:url({{asset('assets/img/icons/spot-illustrations/corner-4.png')}});opacity: 0.7;">
  </div>
  <div class="card-body position-relative">
   <h5 class="mb-3 fs-0">
    Shift Name: #<span class="text-capitalize">{{$shiftEngineer->shift_name}}</span>
   </h5>
   <p class="mb-0 fs--1"> <strong>Assign Month: </strong> {{date('M-Y', strtotime($shiftEngineer->year_month))}} </p>
   <p class="mb-0 fs--1"> <strong>Assign Users: </strong>
    @foreach($shiftEngineer->assignUsers as $user)
    <span class="badge bg-green-400 text-capitalize">{{$user->name}}</span>
    @endforeach
   </p>
  </div>
 </div>
</div>
@endsection