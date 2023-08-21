<div class="row align-items-center text-center mb-3">
    <div class="col-sm-6 text-sm-start">
        <a href="{{asset($issue->image)}}" data-gallery="gallery-2">
            <img src="{{asset($issue->image)}}" alt="{{$issue->title}}" class="img-fluid" width="250" />
        </a>
    </div>
    <div class="col text-sm-end mt-3 mt-sm-0">
        <h3 class="mb-3">Title: {{$issue->title}}</h2>
            <h5>Creator: {{$issue->addedBy->name}}</h5>
            <p class="fs--1 mb-0">Department:
                <span class="badge">
                    @if($departmentWithCollaborations->count() > 0)
                    @foreach($departmentWithCollaborations as $collaborationDepartment)
                    <span class="{{ $collaborationDepartment->badge}}">
                        {{$collaborationDepartment->name}}
                    </span>
                    @endforeach
                    @else
                    {{$issue->department->name}}
                    @endif
                </span>
            </p>
            <p class="fs--1 mb-0">Forwarded Department:
                @if($issue->forwarded_department_id != null)
                <span class="badge bg-info">
                    {{$issue->forwardedDepartmentName($issue->forwarded_department_id)}}
                </span>
                <span class="badge rounded-pill bg-danger text-capitalize">({{$issue->forwarded_status}})</span>
                @else
                <span class="badge bg-danger">
                    None
                </span>
                @endif

            </p>
            <p class="fs--1 mb-0">Collaboration Department:
                @if($collaborationDepartments->count() > 0)
                <span>
                    @foreach($collaborationDepartments as $collaborationDepartment)
                    <span class="{{ $collaborationDepartment->badge}}">
                        {{$collaborationDepartment->name}}
                    </span>
                    @endforeach
                </span>
                <span class="badge rounded-pill bg-danger text-capitalize">({{$issue->collaboration_status}})</span>
                @else
                <span class="badge bg-danger">
                    None
                </span>
                @endif
            </p>
    </div>
    <div class="col-12 align-items-center text-center h5 text-capitalize">
        @if ($issue->seriousness == 'normal')
        <span class="badge rounded-pill badge-soft-success">{{$issue->seriousness}}</span>
        @elseif($issue->seriousness == 'emergency')
        <span class="badge rounded-pill badge-soft-warning">{{$issue->seriousness}}</span>
        @else
        <span class="badge rounded-pill badge-soft-danger">
            @if($issue->seriousness == 'super_emergency')
            Super Emergency
            @endif
        </span>
        @endif
        <hr />
    </div>
</div>
<div class="row">
    <h5 class="text-600">Description:</h5>
    <p class="fs--1 text-justify">
        {{$issue->description}}
    </p>
    <h5 class="text-600 mt-2">Recommendation:</h5>
    <p class="fs--1 text-justify">
        {{$issue->recommendation}}
    </p>
</div>
