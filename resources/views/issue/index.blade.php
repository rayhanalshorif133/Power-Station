@extends('layouts.admin.admin')


@section('head')
<style>
    input[type="radio"] {
        display: none;
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
                                    <h5 class="mb-0">Issue List</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center justify-content-end my-3">
                            <div id="bulk-select-replace-element">
                                <button class="btn btn-falcon-success btn-sm" type="button" data-bs-toggle="modal"
                                    data-bs-target="#createIssue">
                                    <span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span>
                                    <span class="ms-1">New</span>
                                </button>
                            </div>
                            <div class="d-none ms-3" id="bulk-select-actions">
                                <div class="d-flex">
                                    <select class="form-select form-select-sm issueActionSelect"
                                        aria-label="Bulk actions">
                                        <option selected="selected">Actions</option>
                                        <option value="delete">Delete</option>
                                    </select>
                                    <button class="btn btn-falcon-danger btn-sm ms-2 issueApplyBtn"
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
                                    <div class="form-check mb-0">
                                        <input class="form-check-input" type="checkbox"
                                            data-bulk-select='{"body":"bulk-select-body","actions":"bulk-select-actions","replacedElement":"bulk-select-replace-element"}' />
                                    </div>
                                </th>
                                <th class="align-middle">Image</th>
                                <th class="align-middle">Title</th>
                                <th class="align-middle">Department Name</th>
                                <th class="align-middle">Seriousness</th>
                                <th class="align-middle">Status</th>
                                <th class="align-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody id="bulk-select-body">
                            @foreach ($issues as $issue)
                            <tr id="{{$issue->id}}">
                                <td class="align-middle white-space-nowrap">
                                    <div class="form-check mb-0">
                                        <input class="form-check-input checkedIssue" data-issueId="{{$issue->id}}"
                                            type="checkbox" id="checkbox-1"
                                            data-bulk-select-row="data-bulk-select-row" />
                                    </div>
                                </td>
                                <th class="align-middle">
                                    <a href="{{asset($issue->image)}}" data-gallery="gallery-2">
                                        <img src="{{asset($issue->image)}}" alt="{{$issue->title}}"
                                            style="max-width: 100% !important;" height="40" width="40" />
                                    </a>
                                </th>
                                <th class="align-middle">
                                    @php
                                    $len = strlen($issue->title);
                                    @endphp
                                    @if($len > 20)
                                    <span style="font-size:14px">{{$issue->title}}</span>
                                    @else
                                    {{$issue->title}}
                                    @endif
                                </th>
                                <th class="align-middle">
                                    @foreach ($issue->departments as $department)
                                    <span class="badge {{$issue->badge}}">{{$department->name}}</span>
                                    @endforeach
                                </th>
                                <th class="align-middle text-capitalize">
                                    @if ($issue->seriousness == 'normal')
                                    <span class="badge bg-success">Normal</span>
                                    @elseif($issue->seriousness == 'emergency')
                                    <span class="badge bg-warning">Emergency</span>
                                    @else
                                    <span class="badge bg-danger">Super Emergency</span>
                                    @endif
                                </th>
                                <th class="align-middle text-capitalize">
                                    @if ($issue->status == 'pending')
                                    <span class="badge bg-red">Pending</span>
                                    @elseif($issue->status == 'checked')
                                    <span class="badge bg-info">Checked</span>
                                    @elseif($issue->status == 'accepted')
                                    <span class="badge bg-primary">Accepted</span>
                                    @elseif($issue->status == 'approved')
                                    <span class="badge bg-success">Approved</span>
                                    @elseif($issue->status == 'solved')
                                    <span class="badge bg-success">Solved</span>
                                    @else
                                    <span class="badge bg-danger">Canceled</span>
                                    @endif
                                </th>
                                <td class="align-middle">
                                    <div class="btn-group btn-group-sm btn-group-flush" role="group"
                                        aria-label="Basic example">
                                        <a class="btn btn-sm btn-falcon-primary"
                                            href="{{route('issue.show', $issue->id)}}"
                                            class="btn btn-sm btn-falcon-primary">
                                            <i class="far fa-eye"></i>
                                        </a>
                                        <a class="btn btn-sm btn-falcon-info editIssue" id="editIssue-{{$issue->id}}"
                                            data-bs-toggle="modal" data-bs-target="#editIssue" data-toggle="tooltip"
                                            data-placement="top" title="Edit">
                                            <span class="fas fa-pencil-alt"></span>
                                        </a>
                                        <a class="btn btn-sm btn-falcon-danger issueDeleteBtn"
                                            id="deleteIssue-{{$issue->id}}" data-toggle="tooltip" data-placement="top"
                                            title="Delete">
                                            <span class="fas fa-trash"></span>
                                        </a>
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
@include('issue.create')
@include('issue.edit')
@endsection


@section('scripts')
<script src="{{asset('js/issue/issue.js')}}"></script>
@endsection