@extends('layouts.admin.admin')


@section('head')
<style>
    .changeStatus {
        cursor: pointer;
    }
</style>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="card shadow-none">
            <div class="card-body p-0 pb-3">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card-header">
                            <div class="row flex-between-end">
                                <div class="col-auto align-self-center">
                                    <h5 class="mb-0">User List</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center justify-content-end my-3">
                            <div id="bulk-select-replace-element">
                                <a href="{{route('user.create')}}">
                                    <button class="btn btn-falcon-success btn-sm" type="button"><span
                                            class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span><span
                                            class="ms-1">New</span></button>
                                </a>
                            </div>
                            <div class="d-none ms-3" id="bulk-select-actions">
                                <div class="d-flex">
                                    <select class="form-select form-select-sm userActionSelect"
                                        aria-label="Bulk actions">
                                        <option selected="selected">Actions</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                        <option value="delete">Delete</option>
                                    </select>
                                    <button class="btn btn-falcon-danger btn-sm ms-2 userApplyBtn"
                                        type="button">Apply</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive scrollbar">
                    <table class="table mb-0 customDataTable">
                        <thead class="text-black bg-200">
                            <tr>
                                <th class="align-middle">
                                    <div class="form-check mb-0"><input class="form-check-input" type="checkbox"
                                            data-bulk-select='{"body":"bulk-select-body","actions":"bulk-select-actions","replacedElement":"bulk-select-replace-element"}' />
                                    </div>
                                </th>
                                <th class="align-middle">Name</th>
                                <th class="align-middle">Email </th>
                                <th class="align-middle">Phone</th>
                                <th class="align-middle">Department</th>
                                <th class="align-middle">Role</th>
                                <th class="align-middle">Status</th>
                                <th class="align-middle pe-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="bulk-select-body">
                            @foreach ($users as $user)
                            @include('user._partials._index_user_table_body')


                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script src="{{asset('js/user/index.js')}}"></script>
@endsection
