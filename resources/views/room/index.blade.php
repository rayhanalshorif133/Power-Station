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
                                    <h5 class="mb-0">Room List</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center justify-content-end my-3">
                            <div id="bulk-select-replace-element">
                                <a href="{{route('room.create')}}">
                                    <button class="btn btn-falcon-success btn-sm" type="button">
                                        <span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span><span
                                            class="ms-1">New</span>
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
                <div class="table-responsive scrollbar">
                    <table class="table mb-0" id="roomTableId">
                        <thead class="text-black bg-200">
                            <tr>
                                <th class="align-middle white-space-nowrap">
                                    <div class="form-check mb-0"><input class="form-check-input" type="checkbox"
                                            data-bulk-select='{"body":"bulk-select-body","actions":"bulk-select-actions","replacedElement":"bulk-select-replace-element"}' />
                                    </div>
                                </th>
                                <th class="align-middle">Name</th>
                                <th class="align-middle">Rack</th>
                                <th class="align-middle">Shelf</th>
                                <th class="align-middle">Added By</th>
                                <th class="align-middle">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="bulk-select-body" class="collapsedTable">
                            @foreach ($rooms as $room)
                            <tr>
                                <td class="align-middle">
                                    <div class="form-check mb-0">
                                        <input class="form-check-input" type="checkbox" id="checkbox-1"
                                            data-bulk-select-row="data-bulk-select-row" />
                                    </div>
                                </td>
                                <td class="align-middle">{{$room->name}}</td>
                                <td class="align-middle">{{$room->rack}}</td>
                                <td class="align-middle">{{$room->shelf}}</td>
                                <td class="align-middle">{{$room->addedBy->name}}</td>
                                <td class="align-middle">
                                    <div class="btn-group btn-group-sm btn-group-flush" role="group"
                                        aria-label="Basic example" id="roomID-{{$room->id}}">
                                        <button class="btn btn-falcon-primary btn-sm editAndAssignUser" type="button"
                                            data-bs-toggle="modal" data-bs-target="#editAndAssignUser"
                                            data-toggle="tooltip" data-placement="top" title="View And Edit"><span
                                                class="fas fa-eye"></span></button>
                                        <button class="btn btn-falcon-danger btn-sm roomDeleteBtn" type="button"
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
@endsection


@section('scripts')
<script src="{{asset('js/room/index.js')}}"></script>
@endsection
