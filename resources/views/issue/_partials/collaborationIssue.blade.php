<div class="modal fade" id="issueCollaboration" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
        <div class="modal-content position-relative">
            <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('issue.collaborationIssue')}}" method="POST">
                @csrf
                <div class="modal-body p-0">
                    <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
                        <h4 class="mb-1" id="modalExampleDemoLabel">Issue Collaboration</h4>
                    </div>
                    <div class="p-4 pb-0">
                        <h5 class="text-center">Issue Collaboration With</h5>
                        <input type="number" name="issue_id" id="issueID" value="{{$issue->id}}" class="d-none">
                        <div class="mb-3">
                            <label class="col-form-label" for="department_id">Department Name <span
                                    class="text-danger">*</span></label>
                            <select name="departmentIds[]" id="departmentIDSelect" autocomplete="off" multiple>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Collaboration</button>
                </div>
            </form>
        </div>
    </div>
</div>
