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
                  <h5 class="mb-0">Notice List</h5>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="d-flex align-items-center justify-content-end my-3">
              <div id="bulk-select-replace-element">
                <button class="btn btn-falcon-info btn-sm" type="button" data-bs-toggle="modal"
                  data-bs-target="#createNotice">
                  <span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span>
                  <span class="ms-1">New</span>
                </button>
              </div>
              <div class="d-none ms-3" id="bulk-select-actions">
                <div class="d-flex">
                  <select class="form-select form-select-sm userActionSelect" aria-label="Bulk actions">
                    <option selected="selected">Actions</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                    <option value="delete">Delete</option>
                  </select>
                  <button class="btn btn-falcon-danger btn-sm ms-2 userApplyBtn" type="button">Apply</button>
                </div>
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
              <th class="align-middle">Notice No</th>
              <th class="align-middle">Title</th>
              <th class="align-middle">Description</th>
              <th class="align-middle">Status</th>
              <th class="align-middle">Published on</th>
              <th class="align-middle">Added By</th>
              <th class="align-middle">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($notices as $notice)
            <tr>
              <td class="align-middle white-space-nowrap">
                <div class="form-check mb-0">
                  <input class="form-check-input" type="checkbox" id="checkbox-1"
                    data-bulk-select-row="data-bulk-select-row" />
                </div>
              </td>
              <td>{{$notice->notice_no}}</td>
              <td>{{$notice->title}}</td>
              <td>{{$notice->description}}</td>
              <td>
                <a href="{{route('notice.publicationUpdate',$notice->id)}}">
                  @if($notice->is_published == 1)
                  <span class="badge badge-soft-success" data-toggle="tooltip" data-placement="top"
                    title="Click here to Unpublished">Published</span>
                  @else
                  <span class="badge badge-soft-danger" data-toggle="tooltip" data-placement="top"
                    title="Click here to Published">
                    Unpublished</span>
                  @endif
                </a>
              </td>
              <td>
                @if($notice->is_published == 1)
                <span class="badge rounded-pill bg-success-soft text-success">
                  {{$notice->updated_at->format('d M Y')}}
                </span>
                @else
                <span class="badge rounded-pill bg-danger-soft text-danger">Unpublished</span>
                @endif
              </td>
              <td>
                {{$notice->user->name}}
              </td>
              <td class="align-middle">
                <div class="btn-group btn-group-sm btn-group-flush" role="group" aria-label="Basic example">
                  <button class="btn btn-falcon-primary btn-sm editAndAssignUser" type="button" data-bs-toggle="modal"
                    data-bs-target="#editAndAssignUser" data-toggle="tooltip" data-placement="top" title="Edit"><span
                      class="fas fa-pencil-alt"></span></button>
                  <button class="btn btn-falcon-danger btn-sm departmentDeleteBtn" type="button" data-toggle="tooltip"
                    data-placement="top" title="Delete"><span class="fas fa-trash"></span></button>
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
{{-- @include('department._partials.editAssignUser') --}}
@include('notice.create')
@endsection


@section('scripts')
{{-- <script src="{{asset('js/others/department.js')}}"></script> --}}
@endsection