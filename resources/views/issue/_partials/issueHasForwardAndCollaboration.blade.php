@if($issue->forwarded_department_id != null && $issue->forwarded_department_id == department()->id)
<div class="alert alert-warning border-2 d-flex align-items-center" role="alert">
    <div class="bg-warning me-3 icon-item"><span class="fas fa-exclamation-circle text-white fs-3"></span></div>
    <p class="mb-0 flex-1">
        @foreach ($issue->getImplodeDepartments($issue->from_forwarded_department_id) as $key => $department)
        <span>{{$department->name}}</span>
        @if(!$loop->last)
        <span>|</span>
        @endif
        @endforeach
        Department forward issue in your department.
    </p>
    <div class="d-flex flex-center">
        <div class="m-2">
            <a href="{{route('issue.forwardedStatusUpdate', [$issue->id,'rejected'])}}">
                <button class="btn btn-falcon-danger me-1 mb-1 btn-sm" type="button">Not Now</button>
            </a>
        </div>
        <div class="m-2">
            <a href="{{route('issue.forwardedStatusUpdate', [$issue->id,'accepted'])}}">
                <button class="btn btn-falcon-success me-1 mb-1 btn-sm" type="button">Accept</button>
            </a>
        </div>
    </div>
</div>
@endif

@if($collaborationDepartments->count() > 0)
@foreach ($collaborationDepartments as $collaborationDepartment)
@if($collaborationDepartment->id == Auth::department()->id)
<div class="alert alert-success border-2 d-flex align-items-center" role="alert">
    <div class="bg-success me-3 icon-item"><span class="fas fa-exclamation-circle text-white fs-3"></span></div>
    <p class="mb-0 flex-1">
        @foreach ($issue->departments as $key => $department)
        <span>{{$department->name}}</span>
        @if($issue->departments->count() > 1 && $key != $issue->departments->count() - 1)
        <span>|</span>
        @endif
        @endforeach
        Department want to collaboration this issue in your department.
    </p>
    <div class="d-flex flex-center">
        <div class="m-2">
            <a href="{{route('issue.collaborationStatusUpdate', [$issue->id,'rejected'])}}">
                <button class="btn btn-falcon-danger me-1 mb-1 btn-sm" type="button">Not Now</button>
            </a>
        </div>
        <div class="m-2">
            <a href="{{route('issue.collaborationStatusUpdate', [$issue->id,'accepted'])}}">
                <button class="btn btn-falcon-success me-1 mb-1 btn-sm" type="button">Accept</button>
            </a>
        </div>
    </div>
</div>
@endif
@endforeach
@endif