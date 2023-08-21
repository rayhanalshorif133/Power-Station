@extends('layouts.admin.admin')
@section('head')
<style>
    .profileShow:hover {
        text-decoration: none !important;
        color: #0443a2 !important;
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
                                    <h5 class="mb-0">Device Logs or Histories</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center justify-content-end my-3">
                            <div id="bulk-select-replace-element"><button class="btn btn-falcon-success btn-sm"
                                    type="button"><span class="fas fa-plus"
                                        data-fa-transform="shrink-3 down-2"></span><span
                                        class="ms-1">New</span></button>
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
                                <th class="align-middle">Device Info</th>
                                <th class="align-middle">Message</th>
                                <th class="align-middle white-space-nowrap pe-3">Date And Time</th>
                            </tr>
                        </thead>
                        <tbody id="bulk-select-body">
                            @foreach ($deviceHistoryLogs as $deviceLog)
                            <tr id="{{$deviceLog->id}}">
                                <td class="align-middle white-space-nowrap">
                                    <div class="form-check mb-0">
                                        <input class="form-check-input" type="checkbox" id="checkbox-1"
                                            data-bulk-select-row="data-bulk-select-row" />
                                    </div>
                                </td>
                                <th class="align-middle">
                                    <a href="{{route('device.show', $deviceLog->device_id)}}"
                                        class="btn btn-sm text-info" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Show Device Profile">
                                        {{$deviceLog->device->name}}({{$deviceLog->device->tag_no}})
                                    </a>
                                </th>
                                <th class="align-middle text-primary">
                                    @php
                                    $isissue = strpos($deviceLog->message, "issue");
                                    @endphp
                                    @if ($isissue !== false)
                                    @php
                                    preg_match('#\((.*?)\)#', $deviceLog->message, $issueId);
                                    @endphp
                                    <a href="{{route('issue.profile-show',$issueId[1])}}"
                                        class="text-primary profileShow" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Show Issue Profile">
                                        {{$deviceLog->message}}
                                    </a>
                                    @else
                                    {{$deviceLog->message}}
                                    @endif
                                </th>
                                <th class="align-middle white-space-nowrap pe-3">
                                    <span class="badge rounded-pill {{$deviceLog->badge}}">
                                        {{$deviceLog->date_time}}
                                    </span>
                                </th>
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
@endsection
