@extends('layouts.admin.admin')


@section('head')
<style>
 .text-green {
  color: #009E0F !important;
 }
</style>
@endsection

@section('content')
<div class="card mb-3">
 <div class="card-body">
  <div class="row justify-content-between align-items-center">
   <div class="col-md">
    <h5 class="mb-2 mb-md-0">
     Details Goods Device
    </h5>
   </div>
  </div>
 </div>
</div>
<div class="card mb-3">
 <div class="card-body">
  <div class="row text-center mb-3">
   <div class="col-sm-4 text-sm-start">
    <a href="{{asset($goodsTool->image)}}" data-gallery="gallery-2">
     <img src="{{asset($goodsTool->image)}}" alt="{{$goodsTool->device->name}}" class="img-fluid" width="250" />
    </a>
   </div>
   <div class="col-sm-8 text-sm-start">
    <h4 class="alert-heading fw-semi-bold">{{$goodsTool->device->name}}</h4>
    <span class="fw-bold">Category Name:</span> {{$goodsTool->device->deviceCategory->name}}
    <br />
    <span class="fw-bold">Room Number:</span> {{$goodsTool->roomDetails->room->name}}
    <br />
    <span class="fw-bold">Rack Number:</span> {{$goodsTool->roomDetails->rack}}
    <br />
    <span class="fw-bold">Shelf Number:</span> {{$goodsTool->roomDetails->shelf}}
    <div class="d-flex mt-3">
     <span class="m-3"><span class="fas fa-check-circle text-danger fs-2"></span> Totals:
      <span class="text-green">{{$goodsTool->total_quantity}}</span>
     </span>
     <span class="m-3"><span class="fas fa-store text-green fs-2"></span>
      In Stock:
      <span class="text-green">{{$goodsTool->stock_quantity}}</span>

     </span>
    </div>
   </div>
  </div>
  <div class="row mt-5">
   <h5 class="text-600">Description:</h5>
   <p class="fs--1 text-justify">
    {{$goodsTool->description}}
   </p>
   <h5 class="text-600 mt-2">Details:</h5>
   <div class="text-justify table-responsive scrollbar">
    <table class="table mb-0 customDataTable">
     <thead>
      <tr>
       <th>Date</th>
       <th>Shift S/R</th>
       <th>S/R</th>
       <th>Stock</th>
      </tr>
     </thead>
     <tbody>
      <tr>
       <td>12/10/2022</td>
       <td>Sender Name</td>
       <td>Receiver Name</td>
       <td>25</td>
      </tr>
      <tr>
       <td>07/10/2022</td>
       <td>Receiver Name</td>
       <td>Provider Name</td>
       <td>5</td>
      </tr>
     </tbody>

    </table>
   </div>
  </div>
 </div>
</div>

@endsection


@section('scripts')
{{-- <script src="{{asset('js/issue/show.js')}}"></script> --}}
{{-- <script src="{{asset('js/issue/issueHasDevice.js')}}"></script> --}}
@endsection