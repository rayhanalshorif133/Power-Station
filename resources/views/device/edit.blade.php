@extends('layouts.admin.admin')

@section('head')
<link rel="stylesheet" href="{{ asset('vendors/glightbox/glightbox.min.css') }}">
<style>
    .img-fluid {
        height: 100% !important;
    }
</style>
@endsection

@section('content')
<div class="card shadow-none">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="card-header">
                    <div class="row flex-between-end">
                        <div class="col-auto align-self-center">
                            <h5 class="mb-0">Update Device</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex align-items-center justify-content-end my-3">
                    <div class="ms-3">
                        <div class="d-flex">
                            <a class="" href="{{ route('device.index') }}">
                                <button class="btn btn-falcon-danger btn-sm ms-2" type="button">Cancel</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-lg-12 pe-lg-2">
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="mb-0">Edit Device Details</h5>
            </div>
            <div class="card-body bg-light">
                <form class="row g-3" action="{{route('device.update',$device->id)}}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-lg-12">
                        <label class="form-label" for="Images">Images</label>
                        <div class="row mx-n1">
                            @if($device->images)
                            @foreach($device->images as $key => $image)
                            <div class="col-3 p-1 text-center mb-5" id="imageKey-{{$key}}">
                                @if (strpos($image, '.mp4') !== false)
                                <video class="rounded-1 fit-cover h-100 w-100" controls>
                                    <source src="{{asset($image)}}" type="video/mp4">
                                </video>
                                @else
                                <a class="post1" href="{{asset($image)}}" data-gallery="gallery-1">
                                    <img class="img-fluid rounded" src="{{asset($image)}}" alt="{{$image}}"
                                        height="20" />
                                </a>
                                @endif
                                <span class="btn btn-sm btn-outline-danger mt-1 deleteImage"
                                    id="device-{{$device->id}}"><i class="fas fa-trash"></i></span>
                            </div>
                            @endforeach
                            @else
                            <div class="col-3 p-1">
                                <a class="post1" href="{{asset('images/no-image.svg')}}" data-gallery="gallery-1">
                                    <img class="img-fluid rounded" src="{{asset('images/no-image.svg')}}" alt="" />
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 mt-3">
                        <label class="form-label" for="image">Images <span
                                class="text-google-plus">(Multiple)</span><span class="text-danger">*</span></label>
                        <input class="form-control" name="images[]" type="file" multiple
                            accept=".png, .jpg, .jpeg, .mp4" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="png, jpg, jpeg and mp4 files are accepted" />
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label" for="name">Device Name <span class="text-danger">*</span></label>
                        <input class="form-control" required name="name" type="text" value="{{$device->name}}" />
                        @error('name')
                        <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label" for="category_id">Select Category <span
                                class="text-danger">*</span></label>
                        <select class="form-select form-select-md" name="category_id">
                            @foreach ($deviceCategories as $category)
                            @if($category->id == $device->category_id)
                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                            @else
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('category_id')
                        <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label" for="area_id">Select Area <span class="text-danger">*</span></label>
                        <select class="form-select form-select-md" name="area_id">
                            @foreach ($areas as $area)
                            @if($area->id == $device->area_id)
                            <option value="{{ $area->id }}" selected>{{ $area->name }}</option>
                            @else
                            <option value="{{ $area->id }}">{{ $area->name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label" for="section_id">Select Section <span
                                class="text-danger">*</span></label>
                        <select class="form-select form-select-md" name="section_id">
                            @foreach ($sections as $section)
                            @if($section->id == $device->section_id)
                            <option value="{{ $section->id }}" selected>{{ $section->name }}</option>
                            @else
                            <option value="{{ $section->id }}">{{ $section->name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label" for="main_device_id">Select Main Device <span
                                class="text-danger">*</span></label>
                        <select class="form-select form-select-md" name="main_device_id">
                            @foreach ($mainDevices as $mainDevice)
                            @if($mainDevice->id == $device->main_device_id)
                            <option value="{{ $mainDevice->id }}" selected>{{ $mainDevice->name }}</option>
                            @else
                            <option value="{{ $mainDevice->id }}">{{ $mainDevice->name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label" for="tag_no">Tag No <span class="text-danger">*</span></label>
                        <input class="form-control" name="tag_no" type="text" value="{{$device->tag_no}}" />
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label" for="status_id">Status <span class="text-danger">*</span></label>
                        <select class="form-select form-select-md" name="status_id">
                            @foreach ($statuses as $status)
                            @if($status->id == $device->status_id)
                            <option value="{{ $status->id }}" selected>{{ $status->name }}</option>
                            @else
                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label" for="description">Description</label>
                        <textarea class="form-control text-left" id="description" name="description" cols="10"
                            rows="2">{{$device->description}}</textarea>
                    </div>

                    <div class="col-12 d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit">Submit </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script src="{{asset('vendors/glightbox/glightbox.min.js')}}"></script>
<script src="{{asset('js/device/edit.js')}}"></script>
@endsection
