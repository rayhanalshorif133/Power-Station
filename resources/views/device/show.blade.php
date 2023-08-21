@extends('layouts.admin.admin')


@section('head')
<link href="{{asset('vendors/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
<style>
    .creatorMargintop {
        margin-top: 3px !important;
    }
</style>
@endsection

@section('content')
<div class="card mb-3">
    <div class="card-body">
        <div class="row justify-content-between align-items-center">
            <div class="col-md">
                <h5 class="mb-2 mb-md-0">
                    Device Tag No: #{{$device->tag_no}}
                </h5>
            </div>
        </div>
    </div>
</div>
<div class="card mb-3">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="product-slider" id="galleryTop">
                    <div class="swiper-container theme-slider position-lg-absolute all-0"
                        data-swiper='{"autoHeight":true,"spaceBetween":5,"loop":true,"loopedSlides":5,"thumb":{"spaceBetween":5,"slidesPerView":5,"loop":true,"freeMode":true,"grabCursor":true,"loopedSlides":5,"centeredSlides":true,"slideToClickedSlide":true,"watchSlidesVisibility":true,"watchSlidesProgress":true,"parent":"#galleryTop"},"slideToClickedSlide":true}'>
                        <div class="swiper-wrapper h-100">
                            @if($device->images)
                            @foreach($device->images as $image)
                            <div class="swiper-slide h-100">
                                @if (strpos($image, '.mp4') !== false)
                                <video class="rounded-1 fit-cover h-100 w-100" controls>
                                    <source src="{{asset($image)}}" type="video/mp4">
                                </video>
                                @else
                                <img class="rounded-1 fit-cover h-100 w-100" src="{{asset($image)}}" alt="" />
                                @endif
                            </div>
                            @endforeach
                            @else
                            <div class="swiper-slide h-100">
                                <img class="rounded-1 fit-cover h-100 w-100" src="{{asset('images/no-image.svg')}}"
                                    alt="" />
                            </div>
                            @endif
                        </div>
                        <div class="swiper-nav">
                            <div class="swiper-button-next swiper-button-white"></div>
                            <div class="swiper-button-prev swiper-button-white"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="d-flex">
                    <h5 class="text-capitalize">
                        {{$device->name}}
                    </h5>
                    <a class="fs--1 d-block mx-2 creatorMargintop" href="#!">({{$device->addedBy->name}})</a>
                </div>
                <span class="fs--1 d-block me-2 text-success" href="#!">
                    {{$device->created_at->diffForHumans()}}
                </span>
                <h5 class="d-flex align-items-center">
                    <span class="text-warning me-2">Details:</span>
                </h5>
                <p class="fs--1">
                    <strong>Tag No:</strong>
                    {{$device->tag_no}}
                </p>
                <p class="fs--1">
                    <strong>Category:</strong>
                    {{$device->deviceCategory->name}}
                </p>
                <p class="fs--1">
                    <strong>Area:</strong>
                    {{$device->deviceArea->name}}
                </p>
                <p class="fs--1">
                    <strong>Section:</strong>
                    {{$device->deviceSection->name}}
                </p>
                <p class="fs--1">
                    <strong>Main Device:</strong>
                    {{$device->deviceMainDevice->name}}
                </p>
                <p class="fs--1">
                    <strong>Description:</strong>
                    {{$device->description}}
                </p>
            </div>
        </div>
        <div class="row d-none">
            <div class="col-12">
                <div class="overflow-hidden mt-4">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item"><a class="nav-link active ps-0" id="device-history" data-bs-toggle="tab"
                                href="#tab-description" role="tab" aria-controls="tab-description"
                                aria-selected="true">Device History</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="tab-description" role="tabpanel"
                            aria-labelledby="device-history">
                            <div class="mt-3">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Description</th>
                                                        <th scope="col">Added By</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {{-- @foreach($device->deviceHistories as
                                                    $history)
                                                    <tr>
                                                        <td>{{$history->created_at->diffForHumans()}}
                                                        </td>
                                                        <td>{{$history->description}}</td>
                                                        <td>{{$history->addedBy->name}}</td>
                                                    </tr>
                                                    @endforeach --}}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script src="{{asset('vendors/swiper/swiper-bundle.min.js')}}"></script>
@endsection
