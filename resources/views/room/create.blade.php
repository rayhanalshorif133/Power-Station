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
                            <h5 class="mb-0">Add New Room</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex align-items-center justify-content-end my-3">
                    <div class="ms-3">
                        <div class="d-flex">
                            <a class="" href="{{ route('room.index') }}">
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
                <h5 class="mb-0">New Room Details</h5>
            </div>
            <div class="card-body bg-light">
                <div class="row g-3">
                    <div class="col-lg-3">
                        <label class="form-label" for="name">Room Name/Number <span class="text-danger">*</span></label>
                        <input class="form-control" required name="name" type="text" value="Room-1" />
                        @error('name')
                        <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-3">
                        <label class="form-label" for="rack">Rack<span class="text-danger">*</span></label>
                        <input class="form-control" required name="rack" type="number" value="1" />
                        @error('name')
                        <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-3">
                        <label class="form-label" for="shelf">Shelf</label>
                        <input class="form-control" required name="shelf" type="number" value="6" />
                        @error('name')
                        <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-3">
                        <button class="btn btn-falcon-primary me-3 mb-1 mt-4 createBtn" type="button">Create
                            <span class="fas fa-check text-primary me-1" data-fa-transform="shrink-2"></span></button>
                        <button class="btn btn-falcon-danger me-3 mb-1 mt-4 resetBtn d-none" type="button">Reset
                            <span class="fas fa-times text-danger me-1" data-fa-transform="shrink-2"></span></button>
                    </div>
                    <div class="col-lg-12">
                        <span class="appendRackAndShelf"></span>
                    </div>
                    <div class="col-lg-12">
                        <label class="form-label" for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" cols="10"
                            rows="2"></textarea>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <button class="btn btn-primary submitBtn" disabled type="button">Submit </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script src="{{asset('js/room/create.js')}}"></script>
@endsection
