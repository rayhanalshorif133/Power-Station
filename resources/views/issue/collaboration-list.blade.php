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
                                    <h5 class="mb-0">Issue Collaboration Pending List</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center justify-content-end my-3">
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
                                <th class="align-middle">Image</th>
                                <th class="align-middle">Title</th>
                                <th class="align-middle">Department Name</th>
                                <th class="align-middle">Collaboration Departments</th>
                                <th class="align-middle">Collaboration Status</th>
                                <th class="align-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody id="bulk-select-body">
                            @foreach ($issues as $issue)
                            <tr id="{{$issue->id}}">
                                <td class="align-middle white-space-nowrap">
                                    <div class="form-check mb-0">
                                        <input class="form-check-input" type="checkbox" id="checkbox-1"
                                            data-bulk-select-row="data-bulk-select-row" />
                                    </div>
                                </td>
                                <th class="align-middle">
                                    <a href="{{asset($issue->image)}}" data-gallery="gallery-2">
                                        <img src="{{asset($issue->image)}}" alt="{{$issue->title}}" class="img-fluid"
                                            width="40" height="40" />
                                    </a>
                                </th>
                                <th class="align-middle">{{$issue->title}}</th>
                                <th class="align-middle">
                                    @foreach ($issue->departments as $department)
                                    <span class="badge {{$issue->badge}}">{{$department->name}}</span>
                                    @endforeach
                                </th>
                                <th class="align-middle text-capitalize">
                                    @foreach ($issue->collaborationDepartments as $forwardedDepartment)
                                    <span class="badge {{$issue->badge}}">{{$forwardedDepartment->name}}</span>
                                    @endforeach
                                </th>
                                <th class="align-middle text-capitalize">
                                    @if ($issue->forwarded_status == 'pending')
                                    <span class="badge bg-red text-capitalize">{{$issue->forwarded_status}}</span>
                                    @endif
                                </th>
                                <th class="align-middle">
                                    <a href="{{route('issue.show', $issue->id)}}" class="btn btn-sm btn-falcon-primary">
                                        <i class="far fa-eye"></i>
                                    </a>
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
