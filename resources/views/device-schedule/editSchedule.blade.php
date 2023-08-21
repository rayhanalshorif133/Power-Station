<div class="modal fade" id="editSchedule" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
        <div class="modal-content position-relative">
            <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('device-schedule.update')}}" method="post">
                @csrf
                <div class="modal-body p-0">
                    <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
                        <h4 class="mb-1" id="modalExampleDemoLabel">Update Schedule</h4>
                    </div>
                    <div class="p-4 pb-0">
                        <input type="number" class="d-none" name="deviceSchedule_id" id="updateSetDeviceSchedule_id"
                            value="" />
                        <div class="mb-3">
                            <label class="col-form-label" for="time">Time <span class="text-danger">*</span></label>
                            <div class="row">
                                <div class="col-md-6 mt-2">
                                    <select class="form-select" name="time" id="editTime">
                                        <option value="day">Day</option>
                                        <option value="month">Month</option>
                                        <option value="year">Year</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <input type="number" class="form-control" name="time_value" id="editTimeValue" />
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label" for="purpose">Purpose <span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control" name="purpose" id="editPurpose" rows="3"></textarea>
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