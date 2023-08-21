@extends('layouts.admin.admin')


@section('head')
<style>
    .bg-success-200 {
        background-color: #b5ddbe;
    }

    .bg-success-200:hover {
        background-color: #a4deb2;
    }

    .bg-green-400 {
        background-color: #01bf70;
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
                                    <h5 class="mb-0"><span class="fas fa-users fs-1 text-success"></span> Shift
                                        Engineers List</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center justify-content-end my-3">
                            <div id="bulk-select-replace-element">
                                <a href="{{route('shift-engineer.create')}}">
                                    <button class="btn btn-falcon-success btn-sm">
                                        <span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span>
                                        <span class="ms-1">New</span>
                                    </button>
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
            </div>
            <div class="table-responsive scrollbar">
                <table class="table mb-0 shiftEngineerTable">
                    <thead class="text-black bg-success-200">
                        <tr>
                            <th class="align-middle white-space-nowrap">
                                <div class="form-check mb-0"><input class="form-check-input" type="checkbox"
                                        data-bulk-select='{"body":"bulk-select-body","actions":"bulk-select-actions","replacedElement":"bulk-select-replace-element"}' />
                                </div>
                            </th>
                            <th class="align-middle">Date</th>
                            <th class="align-middle">Shift Name</th>
                            <th class="align-middle">Assign Users</th>
                            <th class="align-middle">Added By</th>
                            <th class="align-middle">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="bulk-select-body">
                        @foreach($shiftEngineers as $shiftEngineer)
                        <tr id="shift-eng-{{$shiftEngineer->id}}">
                            <td class="align-middle white-space-nowrap">
                                <div class="form-check mb-0">
                                    <input class="form-check-input" type="checkbox" id="checkbox-1"
                                        data-bulk-select-row="data-bulk-select-row" />
                                </div>
                            </td>
                            <td>{{ date('M-Y', strtotime($shiftEngineer->year_month)) }}</td>
                            <td class="text-capitalize">{{$shiftEngineer->shift_name}}</td>
                            <td>
                                @foreach($shiftEngineer->assignUsers as $user)
                                <span class="badge bg-green-400 text-capitalize">{{$user->name}}</span>
                                @endforeach
                            </td>
                            <td>{{$shiftEngineer->addedBy->name}}</td>
                            <td class="align-middle">
                                <div class="btn-group btn-group-sm btn-group-flush" role="group"
                                    aria-label="Basic example">
                                    <a href="{{route('shift-engineer.viewAndEdit',$shiftEngineer->id)}}">
                                        <button class="btn btn-falcon-primary btn-sm" type="button"
                                            data-toggle="tooltip" data-placement="top" title="View and edit">
                                            <span class="fas fa-eye"></span>
                                            <span class="fas fa-pencil-alt d-none"></span>
                                        </button>
                                    </a>
                                    <button class="btn btn-falcon-danger btn-sm shiftEngDeleteBtn" type="button"
                                        data-toggle="tooltip" data-placement="top" title="Delete"><span
                                            class="fas fa-trash"></span></button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script src="{{asset('js/shift_engineer/index.js')}}"></script>
@endsection
