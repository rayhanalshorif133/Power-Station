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
                                    <h5 class="mb-0">Issue Logs</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center justify-content-end my-3 ">
                            <div class="d-none ms-3" id="bulk-select-actions">
                                <div class="d-flex">
                                    <select class="form-select form-select-sm issueLogsActionSelect"
                                        aria-label="Bulk actions">
                                        <option selected="selected">Actions</option>
                                        <option value="delete">Delete</option>
                                    </select>
                                    <button class="btn btn-falcon-danger btn-sm ms-2 issueLogsApplyBtn"
                                        type="button">Apply</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive scrollbar">
                    <table class="table mb-0" id="issueHistoryLogId">
                        <thead class="text-black bg-200">
                            <tr>
                                <th class="align-middle white-space-nowrap">
                                    <div class="form-check mb-0">
                                        <input class="form-check-input" type="checkbox"
                                            data-bulk-select='{"body":"bulk-select-body","actions":"bulk-select-actions","replacedElement":"bulk-select-replace-element"}' />
                                    </div>
                                </th>
                                <th class="align-middle">Issue No</th>
                                <th class="align-middle">Message</th>
                                <th class="align-middle white-space-nowrap pe-3">Date And Time</th>
                            </tr>
                        </thead>
                        <tbody id="bulk-select-body">
                            @foreach ($issueHistoryLogs as $issueHistoryLog)
                            <tr id="{{$issueHistoryLog->id}}">
                                <td class="align-middle white-space-nowrap">
                                    <div class="form-check mb-0">
                                        <input class="form-check-input checkBoxOfIssueLog" type="checkbox"
                                            id="checkbox-1" data-bulk-select-row="data-bulk-select-row" />
                                    </div>
                                </td>
                                <th class="align-middle">
                                    <a href="{{route('issue.show', $issueHistoryLog->issue->id)}}"
                                        class="btn btn-sm text-primary" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Show Issue Profile">
                                        {{$issueHistoryLog->issue->issue_id}}
                                    </a>
                                </th>
                                <th class="align-middle">{{$issueHistoryLog->message}}</th>
                                <th class="align-middle white-space-nowrap pe-3">
                                    <span class="badge rounded-pill {{$issueHistoryLog->badge}}">
                                        {{$issueHistoryLog->date_time}}
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
<script src="{{asset('js/issue/logs.js')}}"></script>
@endsection
