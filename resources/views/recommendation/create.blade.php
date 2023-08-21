<div class="modal fade" id="createRecommendation" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 600px">
        <div class="modal-content position-relative">
            <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('recommendation.store')}}" method="post">
                @csrf
                <div class="modal-body p-0">
                    <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
                        <h4 class="mb-1" id="modalExampleDemoLabel">Add a new Recommendation </h4>
                    </div>
                    <div class="p-4 pb-0">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="col-form-label" for="title">Title<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="Enter recommendation title" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="col-form-label" for="priority">Priority<span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" id="priority" name="priority" required>
                                        <option value="low">Low</option>
                                        <option value="medium">Medium</option>
                                        <option value="high">High</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 pt-2 pb-0">
                        <div class="mb-3">
                            <label class="col-form-label" for="note">Note<span class="text-danger">*</span></label>
                            <textarea type="text" class="form-control" id="note" name="note"
                                placeholder="Enter recommendation note" required></textarea>
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
