<div class="d-flex flex-center mb-1">
    <div class="m-2">
        <button class="btn btn-outline-primary btn-sm p-2 issueCollaborationBtn" type="button" data-bs-toggle="modal"
            data-bs-target="#issueCollaboration">
            <span class="fas fa-users"></span>
        </button>
    </div>
    <div class="m-2">
        <button class="btn btn-outline-success btn-sm p-2 issueForwardBtn" type="button" data-bs-toggle="modal"
            data-bs-target="#issueForward">
            <span class="fas fa-reply"></span>
        </button>
    </div>
    <div class="m-2">
        {{-- <a href="{{route('issue.workPermit', $issue->id)}}">
            <span class="btn btn-outline-info btn-sm p-2">Work Permit</span>
        </a> --}}
        <span class="btn btn-outline-info btn-sm p-2" data-bs-toggle="modal"
            data-bs-target="#addNoteAndSubmitWorkPermit">Work Permit</span>
    </div>
</div>
