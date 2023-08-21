@extends('layouts.admin.admin')


@section('head')
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
                                    <h5 class="mb-0">Device List</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center justify-content-end my-3">
                            <div id="bulk-select-replace-element">
                                <a href="{{route('device.create')}}">
                                    <button class="btn btn-falcon-success btn-sm" type="button">
                                        <span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span><span
                                            class="ms-1">New</span>
                                    </button>
                                </a>
                            </div>
                            <div class="d-none ms-3" id="bulk-select-actions">
                                <div class="d-flex">
                                    <select class="form-select form-select-sm deviceActionSelect"
                                        aria-label="Bulk actions">
                                        <option selected="selected" disabled>Actions</option>
                                        @foreach ($deviceStatuses as $deviceStatus)
                                        <option value="{{$deviceStatus->id}}">{{$deviceStatus->name}}</option>
                                        @endforeach
                                        <option value="delete">Delete</option>
                                    </select>
                                    <button class="btn btn-falcon-danger btn-sm ms-2 deviceApplyBtn"
                                        type="button">Apply</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive scrollbar">
                    <table class="table mb-0" id="deviceListTableId">
                        <thead class="text-black bg-200">
                            <tr>
                                <th class="align-middle white-space-nowrap">
                                    <div class="form-check mb-0">
                                        <input class="form-check-input checkAll" type="checkbox"
                                            data-bulk-select='{"body":"bulk-select-body","actions":"bulk-select-actions","replacedElement":"bulk-select-replace-element"}' />
                                    </div>
                                </th>
                                <th class="align-middle">Tag No</th>
                                <th class="align-middle">Name</th>
                                <th class="align-middle">Category</th>
                                <th class="align-middle">Area</th>
                                <th class="align-middle">Section</th>
                                <th class="align-middle">Main Device</th>
                                <th class="align-middle">Status</th>
                                <th class="align-middle white-space-nowrap pe-3">Action</th>
                            </tr>
                        </thead>
                        <tbody id="bulk-select-body" class="deviceTableBody">
                            @foreach ($devices as $device)
                            <tr id="{{$device->id}}">
                                <td class="align-middle white-space-nowrap">
                                    <div class="form-check mb-0">
                                        <input class="form-check-input selectedDevice" type="checkbox" id="checkbox-1"
                                            data-device-selected-id="{{$device->id}}"
                                            data-bulk-select-row=" data-bulk-select-row" />
                                    </div>
                                </td>
                                <td class="align-middle" data-toggle="tooltip" data-placement="top"
                                    title="View Details">
                                    <a href="{{route('device.show', $device->id)}}">{{$device->tag_no}}</a>
                                </td>
                                <td class="align-middle">{{$device->name}}</td>
                                <td class="align-middle">{{$device->deviceCategory->name}}</td>
                                <td class="align-middle">{{$device->deviceArea->name}}</td>
                                <td class="align-middle">{{$device->deviceSection->name}}</td>
                                <td class="align-middle">{{$device->deviceMainDevice->name}}</td>
                                <td class="align-middle">
                                    {{$device->deviceStatus->name}}
                                </td>
                                <td class="align-middle white-space-nowrap">
                                    <div class="btn-group btn-group-sm btn-group-flush" role="group"
                                        aria-label="Basic example">
                                        <a href="{{route('device.show', $device->id)}}"
                                            class="btn btn-falcon-info btn-sm" type="button" data-toggle="tooltip"
                                            data-placement="top" title="View">
                                            <span class="fas fa-eye" data-fa-transform="shrink-3 down-2"></span>
                                        </a>
                                        <a href="{{route('device.edit', $device->id)}}"
                                            class="btn btn-falcon-success btn-sm" type="button" data-toggle="tooltip"
                                            data-placement="top" title="Edit"><span class="fas fa-pencil-alt"
                                                data-fa-transform="shrink-3 down-2"></span>
                                        </a>
                                        <button class="btn btn-falcon-danger btn-sm deviceDeleteBtn"
                                            id="deviceID-{{$device->id}}" data-toggle="tooltip" tyep="button"
                                            data-placement="top" title="Delete">
                                            <span class="fas fa-trash"></span>
                                        </button>
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
<script src="{{asset('js/device/index.js')}}"></script>
@endsection
