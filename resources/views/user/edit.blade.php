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
                            <h5 class="mb-0">Update User</h5>
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
                <h5 class="mb-0">User Details</h5>
            </div>
            <div class="card-body bg-light">
                <form class="row g-3" action="{{route('user.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <div class="col-lg-6">
                        <label class="form-label" for="name">Name</label>
                        <input class="form-control" name="name" type="text" placeholder="Enter user name"
                            value="{{ $user->name }}" />
                        @error('name')
                        <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label" for="email">Email</label>
                        <input class="form-control" name="email" type="email" placeholder="Enter user email"
                            value={{$user->email}} />
                        @error('email')
                        <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label" for="phone">Phone</label>
                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone"
                            placeholder="Enter Phone Number" maxlength="11" pattern="[0-9]{3}[0-9]{8}"
                            value="{{$user->phone}}" />
                        @error('phone')
                        <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label" for="designation">Designation</label>
                        <input class="form-control" name="designation" placeholder="Enter user designation" type="text"
                            value="{{$user->designation}}" />
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label" for="password">Password </label>
                        <input class="form-control" name="password" type="password" placeholder="Enter user password" />
                        @error('password')
                        <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label" for="password_confirmation">Confirm Password </label>
                        <input class="form-control" name="password_confirmation" type="password"
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
                        <label class="form-label" for="role_id">Select User Role </label>
                        <select class="form-select form-select-md" name="role_id" id="role_id">
                            @foreach ($roles as $role)
                            @if($user->roles[0]->name == $role->name)
                            <option value="{{$role->id}}" selected>{{$role->name}}</option>
                            @else
                            <option value="{{ $role->id }}" class="text-capitalize">{{ $role->name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
@endsection