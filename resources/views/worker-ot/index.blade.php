@extends('layouts.admin.admin')


@section('head')
@endsection

@section('content')
<div class="card shadow-none">
    <div class="card-body">
        <div class="card shadow-none">
            <div class="card-body p-0 pb-3">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card-header">
                            <div class="row flex-between-end">
                                <div class="col-auto align-self-center">
                                    <h5 class="mb-0">Worker Over Time List</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center justify-content-end my-3">
                            <div id="bulk-select-replace-element">
                                <button class="btn btn-falcon-success btn-sm newWorkerOTCreate" type="button"
                                    data-bs-toggle="modal" data-bs-target="#newWorkerOTCreate">
                                    <span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span>
                                    <span class="ms-1">New</span>
                                </button>
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
                                <th class="align-middle white-space-nowrap">
                                    <div class="form-check mb-0"><input class="form-check-input" type="checkbox"
                                            data-bulk-select='{"body":"bulk-select-body","actions":"bulk-select-actions","replacedElement":"bulk-select-replace-element"}' />
                                    </div>
                                </th>
                                <th class="align-middle">Name</th>
                                <th class="align-middle">Start
                                    <span class="far fa-calendar-alt fs-1"></span>
                                </th>
                                <th class="align-middle">End
                                    <span class="far fa-calendar-alt fs-1"></span>
                                </th>
                                <th class="align-middle">Total</th>
                                <th class="align-middle">Perpose</th>
                                <th class="align-middle">Added By</th>
                                <th class="align-middle">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="bulk-select-body" class="collapsedTable">
                            @foreach ($workerOTs as $workerOT)
                            <tr>
                                <td class="align-middle white-space-nowrap">
                                    <div class="form-check mb-0"><input class="form-check-input" type="checkbox"
                                            value="{{ $workerOT->id }}" data-bulk-select-check />
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <a href="#">
                                        {{ $workerOT->user->name }}
                                    </a>
                                </td>
                                <td class="align-middle">
                                    <span class="badge {{$workerOT->badge_start}}">
                                        {{ date('d-M-Y', strtotime($workerOT->start_date_time)) }}
                                    </span>
                                    <span class="badge rounded-pill {{$workerOT->badge_start}}">
                                        {{ date('h:i:s A', strtotime($workerOT->start_date_time)) }}
                                    </span>
                                </td>
                                <td class="align-middle">
                                    <span class="badge {{$workerOT->badge_end}}">
                                        {{ date('d-M-Y', strtotime($workerOT->end_date_time)) }}
                                    </span>
                                    <span class="badge rounded-pill {{$workerOT->badge_end}}">
                                        {{ date('h:i:s A', strtotime($workerOT->end_date_time)) }}
                                    </span>
                                </td>
                                <td class="align-middle">
                                    @php
                                    $start = $workerOT->start_date_time;
                                    $end = $workerOT->end_date_time;
                                    $secondsDifference= strtotime($end) - strtotime($start);
                                    $hours = floor($secondsDifference / 3600);
                                    $minutes = floor($secondsDifference / 60) % 60;
                                    @endphp
                                    <span class="badge {{$workerOT->bg}}">
                                        {{ $hours }} Hours
                                        @if($minutes > 0)
                                        {{ $minutes }} Minutes
                                        @endif
                                    </span>
                                </td>
                                <td class="align-middle">
                                    {{ $workerOT->purpose }}
                                </td>
                                <td class="align-middle">
                                    {{ $workerOT->user->name }}
                                </td>
                                <td class="align-middle">
                                    <div class="btn-group btn-group-sm btn-group-flush" role="group"
                                        aria-label="Basic example">
                                        <button class="btn btn-falcon-primary btn-sm editAndAssignUser" type="button"
                                            data-bs-toggle="modal" data-bs-target="#editAndAssignUser"
                                            data-toggle="tooltip" data-placement="top" title="Edit"><span
                                                class="fas fa-pencil-alt"></span></button>
                                        <button class="btn btn-falcon-danger btn-sm departmentDeleteBtn" type="button"
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
</div>
@include("worker-ot.create")
@endsection


@section('scripts')
<script src="{{asset('js/worker-ot/index.js')}}"></script>
@endsection
