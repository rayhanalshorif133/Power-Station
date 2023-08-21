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
                            <h5 class="mb-0">Add New User</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex align-items-center justify-content-end my-3">
                    <div class="ms-3">
                        <div class="d-flex">
                            <a class="" href="{{ route('user.index') }}">
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
                <h5 class="mb-0">New User Details</h5>
            </div>
            <div class="card-body bg-light">
                <form class="row g-3" action="{{route('user.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-lg-6">
                        <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
                        <input class="form-control" required name="name" type="text" placeholder="Enter user name" />
                        @error('name')
                        <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                        <input class="form-control" required name="email" type="email" placeholder="Enter user email" />
                        @error('email')
                        <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label" for="phone">Phone <span class="text-danger">*</span></label>
                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone"
                            placeholder="Enter Phone Number" required maxlength="11" value="{{old('phone')}}"
                            pattern="[0-9]{3}[0-9]{8}">
                        @error('phone')
                        <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label" for="designation">Designation <span
                                class="text-danger">*</span></label>
                        <input class="form-control" required name="designation" placeholder="Enter user designation"
                            type="text" />
                    </div>
                    {{-- password and password confirmation--}}
                    <div class="col-lg-6">
                        <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                        <input class="form-control" required name="password" type="password"
                            placeholder="Enter user password" />
                        @error('password')
                        <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label" for="password_confirmation">Confirm Password <span
                                class="text-danger">*</span></label>
                        <input class="form-control" required name="password_confirmation" type="password"
                            placeholder="Enter user password" />
                        @error('password_confirmation')
                        <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label optional" for="image">Image</label>
                        <input class="form-control" name="image" type="file" placeholder="Enter user image" />
                        @error('image')
                        <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label optional" for="cover_image">Cover Image</label>
                        <input class="form-control" name="cover_image" type="file"
                            placeholder="Enter user cover_image" />
                        @error('cover_image')
                        <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- Role --}}
                    <div class="col-lg-6">
                        <label class="form-label" for="role_id">Select User Role <span
                                class="text-danger">*</span></label>
                        <select class="form-select form-select-md" name="role_id" id="role_id" required>
                            @foreach ($roles as $role)
                            <option value="{{ $role->id }}" class="text-capitalize">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <button class="btn btn-primary userCreateSubmitBtn" type="submit">Submit </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
{{-- <script src="{{asset('js/user/create.js')}}"></script> --}}
@endsection