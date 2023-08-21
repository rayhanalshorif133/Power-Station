@extends('layouts.admin.admin')


@section('head')
<style>
    .showPurpose {
        cursor: pointer;
    }

    .fa-caret-up,
    .fa-caret-down {
        font-size: 1.5rem;
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
                                    <h5 class="mb-0">Device in Schedule List</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center justify-content-end my-3">
                            <div id="bulk-select-replace-element">
                                <button class="btn btn-falcon-success btn-sm" type="button" data-bs-toggle="modal"
                                    data-bs-target="#createDeviceSchedule">
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
                    <table class="table mb-0" id="deviceScheduleTableId">
                        <thead class="text-black bg-200">
                            <tr>
                                <th class="align-middle white-space-nowrap">
                                    <div class="form-check mb-0"><input class="form-check-input" type="checkbox"
                                            data-bulk-select='{"body":"bulk-select-body","actions":"bulk-select-actions","replacedElement":"bulk-select-replace-element"}' />
                                    </div>
                                </th>
                                <th class="align-middle">Device Image</th>
                                <th class="align-middle">Device Name</th>
                                <th class="align-middle">Category</th>
                            </tr>
                        </thead>
                        <tbody id="bulk-select-body" class="collapsedTable">
                            @foreach ($devices as $device)
                            @if($device->deviceSchedule->count() > 0)
                            <tr id="{{$device->id}}" class="showPurpose">
                                <td class="align-middle white-space-nowrap">
                                    <div class="form-check mb-0">
                                        <input class="form-check-input" type="checkbox" id="checkbox-1"
                                            data-bulk-select-row="data-bulk-select-row" />
                                    </div>
                                </td>
                                <td class="align-middle" data-toggle="tooltip" data-placement="top"
                                    title="View Details">
                                    <a href="{{route('device.show', $device->id)}}">{{$device->tag_no}}</a>
                                </td>
                                <td class="align-middle">
                                    {{$device->name}}
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex justify-content-between">
                                        <div>{{$device->deviceCategory->name}}</div>
                                        <div><i class="fas fa-caret-down text-info"></i></div>
                                        <div class="d-none"><i class="fas fa-caret-up text-danger"></i></div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="d-none tr-{{$device->id}}">
                                <th></th>
                                <th>Purpose</th>
                                <th>Time</th>
                                <th>Actions</th>
                            </tr>
                            @foreach ($device->deviceSchedule as $deviceSchedule)
                            <tr class="d-none tr-{{$device->id}}">
                                <td></td>
                                <td class="purpose">{{$deviceSchedule->purpose}}</td>
                                <td class="time">{{$deviceSchedule->time}}-{{$deviceSchedule->time_value}}</td>
                                <td>
                                    <div class="btn-group btn-group-sm btn-group-flush" role="group"
                                        aria-label="Basic example" id="deviceSchedule-{{$deviceSchedule->id}}">
                                        <button class="btn btn-falcon-primary btn-sm editDeviceSchedule" type="button"
                                            data-bs-toggle="modal" data-bs-target="#editSchedule" data-toggle="tooltip"
                                            data-placement="top" title="Edit"><span
                                                class="fas fa-pencil-alt"></span></button>
                                        <button class="btn btn-falcon-danger btn-sm deviceScheduleDeleteBtn"
                                            type="button" data-toggle="tooltip" data-placement="top"
                                            title="Delete"><span class="fas fa-trash"></span></button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            <tr class="d-none tr-{{$device->id}}">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <button class="btn btn-outline-info btn-sm me-1 mb-1" type="button"
                                        data-bs-toggle="modal" data-bs-target="#addNewSchedule">
                                        <span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span>
                                        <span class="ms-1">New</span>
                                    </button>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('device-schedule.create')
@include('device-schedule.newScheduleCreate')
@include('device-schedule.editSchedule')

@endsection
@section('scripts')
<script src="{{asset('js/device/device-schedule.js')}}"></script>
<script>
    var time = "";
    var time_value = "";
    var purpose = "";
    var thisDelete = "";
    $(document).ready(function () {
        // $('#deviceScheduleTableId').DataTable();
        editSchedule();
        deviceScheduleDeleteBtn();
    });

    function deviceScheduleDeleteBtn(){
        $('.deviceScheduleDeleteBtn').click(function(){
            id = $(this).closest('div').attr('id').split('-')[1];
            thisDelete = $(this);
            swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this data!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            }).then((willDelete) => {
            if (willDelete) {
            swal("Done! Your data has been deleted", {
            icon: "success",
            });
            axios
            .delete(`/device-schedule/${id}/delete`)
            .then(function (response) {
                thisDelete.closest('tr').remove();
            });
            } else {
            swal("Your data is now deleted", {
            icon: "error",
            });
            }
            });
        });
    }

    function editSchedule(){
        $(document).on('click', '.editDeviceSchedule', function () {
            id = $(this).closest('div').attr('id').split('-')[1];
            time = $(this).closest('tr').find('.time').text().split('-')[0];
            time_value = $(this).closest('tr').find('.time').text().split('-')[1];
            purpose = $(this).closest('tr').find('.purpose').text();
            $('#updateSetDeviceSchedule_id').val(id);
            $('#editTimeValue').val(time_value);
            $('#editTime').val(time);
            $('#editPurpose').val(purpose);
        });
    }
</script>
@endsection