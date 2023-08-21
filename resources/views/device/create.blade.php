@extends('layouts.admin.admin')


@section('head')
@endsection

@section('content')
<div class="card shadow-none">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="card-header">
                    <div class="row flex-between-end">
                        <div class="col-auto align-self-center">
                            <h5 class="mb-0">Add New Device</h5>
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
                <h5 class="mb-0">New Device Details</h5>
            </div>
            <div class="card-body bg-light">
                <form class="row g-3" action="{{route('device.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-lg-6">
                        <label class="form-label" for="name">Device Name <span class="text-danger">*</span></label>
                        <input class="form-control" required name="name" type="text" />
                        @error('name')
                        <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label" for="category_id">Select Category <span
                                class="text-danger">*</span></label>
                        <select class="form-select form-select-md" name="category_id">
                            <option selected="selected">Select Category</option>
                            @foreach ($deviceCategories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label" for="area_id">Select Area <span class="text-danger">*</span></label>
                        <select class="form-select form-select-md" name="area_id">
                            <option selected="selected">Select Area</option>
                            @foreach ($areas as $area)
                            <option value="{{ $area->id }}">{{ $area->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label" for="section_id">Select Section <span
                                class="text-danger">*</span></label>
                        <select class="form-select form-select-md" name="section_id">
                            <option selected="selected">Select Section</option>
                            @foreach ($sections as $section)
                            <option value="{{ $section->id }}">{{ $section->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label" for="main_device_id">Select Main Device <span
                                class="text-danger">*</span></label>
                        <select class="form-select form-select-md" name="main_device_id">
                            <option selected="selected">Select Main Device</option>
                            @foreach ($mainDevices as $mainDevice)
                            <option value="{{ $mainDevice->id }}">{{ $mainDevice->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label" for="tag_no">Tag No <span class="text-danger">*</span></label>
                        <input class="form-control" name="tag_no" type="text" />
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label" for="image">Images <span
                                class="text-google-plus">(Multiple)</span><span class="text-danger">*</span></label>
                        <input class="form-control" name="images[]" type="file" multiple
                            accept=".png, .jpg, .jpeg, .mp4" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="png, jpg, jpeg and mp4 files are accepted" />
                    </div>
                    <div class="col-lg-6">
                        {{-- status --}}
                        <label class="form-label" for="status_id">Status <span class="text-danger">*</span></label>
                        <select class="form-select form-select-md" name="status_id">
                            <option selected="selected">Select Status</option>
                            @foreach ($statuses as $status)
                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-12">
                        <label class="form-label" for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" cols="10"
                            rows="2"></textarea>
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
@endsection
