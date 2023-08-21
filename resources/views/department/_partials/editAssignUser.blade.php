<div class="modal fade" id="editAndAssignUser" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
        <div class="modal-content position-relative">
            <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('department.assignUser')}}" method="POST" id="formOfAssignUser">
                @csrf
                <div class="modal-body p-0">
                    <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
                        <h4 class="mb-1" id="modalExampleDemoLabel">Assing User</h4>
                    </div>
                    <div class="p-4 pb-0">
                        <input type="text" name="department_id" class="d-none" id="setDepartmentId">
                        <div class="mb-3">
                            <label class="col-form-label" for="users">Users<span class="text-danger">*</span></label>
                            <span class="appendSelectOfUserIds"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary userIdSelectCloseBtn" type="button"
                        data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>