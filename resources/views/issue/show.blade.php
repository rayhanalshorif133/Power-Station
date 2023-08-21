@extends('layouts.admin.admin')


@section('head')
@endsection

@section('content')
<div class="card mb-3">
    <div class="card-body">
        <div class="row justify-content-between align-items-center">
            <div class="col-md">
                <h5 class="mb-2 mb-md-0">
                    Issue ID: #{{$issue->issue_id}}
                </h5>
            </div>
        </div>
    </div>
</div>
<div class="card mb-3">
    <div class="card-body">
        @include('issue._partials.extends_show_of_Issue')
        @include('issue._partials.deviceDetails')
        @include('issue._partials.issue_note')
        @include('issue._partials.issueForwardCollabAndWorkPermitBtns')
        @role('admin')
        @include('issue._partials.issueHasForwardAndCollaborationForAdmin')
        @else
        @include('issue._partials.issueHasForwardAndCollaboration')
        @endrole
    </div>
</div>
@include('issue._partials.forwardIssue')
@include('issue._partials.collaborationIssue')
@endsection


@section('scripts')
<script src="{{asset('js/issue/show.js')}}"></script>
<script src="{{asset('js/issue/issueHasDevice.js')}}"></script>
@endsection