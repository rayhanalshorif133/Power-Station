<div class="modal fade" id="createAddNewDeviceInIssue" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 400px">
        <div class="modal-content position-relative">
            <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('issue.addDevice', $issue->id)}}" method="POST">
                @csrf
                <div class="modal-body p-0">
                    <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
                        <h4 class="mb-1" id="modalExampleDemoLabel">Added Device</h4>
                    </div>
                    <div class="p-4 pb-0">
                        <div class="mb-3">
                            <label class="col-form-label" for="device_id">Device Name <span
                                    class="text-danger">*</span></label>
                            <select class="form-select" name="device_id" id="addedNewDeviceIdOption" required>
                                <option selected disabled>Select device</option>
                                @foreach ($notAddedDevices as $device)
                                <option value="{{$device->id}}">{{$device->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 d-none showDeviceStatusDiv">
                            <label class="col-form-label" for="device_id"><span class="text-danger">*</span>
                                Device Current Status
                            </label> <br>
                            <span class="badge showDeviceStatus h3" style="font-size:1rem!important;"></span>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label" for="needed_status">Needed Status <span
                                    class="text-danger">*</span></label>
                            <select class="form-select" name="needed_status" id="needed_status" required>
                                <option selected disabled>Select Status</option>
                                @foreach ($devicesStatuses as $deviceStatus)
                                <option value="{{ $deviceStatus->id }}">{{ $deviceStatus->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label" for="note">Note <small
                                    class="text-danger">(Optional)</small></label>
                            <textarea class="form-control" name="note" id="note" rows="3" placeholder="Note"></textarea>
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
