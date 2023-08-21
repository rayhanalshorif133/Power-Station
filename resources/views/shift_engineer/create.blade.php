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
                            <h5 class="mb-0">Add New Shift Engineer</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex align-items-center justify-content-end my-3">
                    <div class="ms-3">
                        <div class="d-flex">
                            <a class="" href="{{ route('shift-engineer.index') }}">
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
                <h5 class="mb-0">New Shift Engineer Details</h5>
            </div>
            <div class="card-body bg-light">
                <div class="row g-3">
                    <div class="col-lg-6">
                        <label class="form-label required" for="shiftName">Shift Name</label>
                        <input type="text" class="form-control" name="shiftName" id="shiftName" />
                        @error('shiftName')
                        <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label required" for="month">Choose a month</label>
                        <input type="text" class="form-control" name="datepicker" id="datepicker" />
                        @error('month')
                        <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label required" for="user">User</label>
                        <select class="" name="assignUsers[]" id="assignUser" multiple="multiple"
                            placeholder="Select users">
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('name')
                        <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-2 mt-5">
                        <button class="btn btn-outline-info btn-sm" disabled id="createBtn">Create</button>
                    </div>

                    <div class="col-12">
                        <span class="assignUserAppend"></span>
                        <span class="noAssignUser text-danger required fw-bold d-none">Zero means No Assign User</span>
                        <div class="table-responsive scrollbar manageTable mt-5">
                            <table class="table mb-0" id="shiftEngineerCreateTableId">
                                <thead class="text-black bg-200">
                                    <tr>
                                        <td class="align-middle" style="width: 100px;">Date</td>
                                        <td class="align-middle">6am to 2 pm</td>
                                        <td class="align-middle">2pm to 10pm</td>
                                        <td class="align-middle">10pm to 6am</td>
                                        <td class="align-middle">Action</td>
                                    </tr>
                                </thead>
                                <tbody class="tableBody shiftEngineerCreateTableBody" id="bulk-select-body">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <button class="btn btn-primary submitBtn" type="button">Submit </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script src="{{asset('js/shift_engineer/create.js')}}"></script>
@endsection
