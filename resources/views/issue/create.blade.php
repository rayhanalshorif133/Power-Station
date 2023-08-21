<div class="modal fade" id="createIssue" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 590px">
        <div class="modal-content position-relative">
            <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('issue.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-0">
                    <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
                        <h4 class="mb-1" id="modalExampleDemoLabel">Create issue </h4>
                    </div>
                    <div class="p-4 pb-0">
                        <div class="mb-3">
                            <label class="form-label" for="title">Issue Title<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Title"
                                required>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <label class="col-form-label" for="department_id">Department Name <span
                                        class="text-danger">*</span></label>
                                <select class="form-select" name="department_id" id="department_id">
                                    <option selected disabled>Select Department</option>
                                    @foreach ($departments as $department)
                                    <option value="{{$department->id}}">{{$department->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label" for="image">Image <span
                                        class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="image" name="image" placeholder="Image"
                                    required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label" for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="2"
                                placeholder="Description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label" for="status">Seriousness <span
                                    class="text-danger">*</span></label> <br>
                            <div class="row">
                                <div class="col-md-4 col-sm-4">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="seriousness" id="normal"
                                            value="normal">
                                        <button class="btn btn-outline-info py-2 radioBtn" type="button">Normal</button>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="seriousness" id="emergency"
                                            value="emergency">
                                        <button class="btn btn-outline-success py-2 radioBtn"
                                            type="button">Emergency</button>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="seriousness"
                                            id="super_emergency" value="super_emergency">
                                        <button class="btn btn-outline-danger radioBtn" style="font-size: 10px;"
                                            type="button">Super Emergency</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label" for="recommendation">Recommendation<span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control" id="recommendation" name="recommendation" rows="2"
                                placeholder="Enter recommendation" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
