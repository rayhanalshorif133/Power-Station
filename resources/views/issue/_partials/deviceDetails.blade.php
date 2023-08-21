<div class="col-12 align-items-center text-center h5 text-capitalize">
    <h5 class="text-600" style="display:inline-grid">
        Add Device
        <hr />
    </h5>
</div>

<div class="row justify-content-between align-items-center">
    <div class="col-md">
        <h5 class="mb-2 mb-md-0">
            Devices Details
        </h5>
    </div>
    <div class="col-auto">
        <button class="btn btn-falcon-success btn-sm" type="button" data-bs-toggle="modal"
            data-bs-target="#createAddNewDeviceInIssue">
            <span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span>
            <span class="ms-1">Add New</span>
        </button>
    </div>
</div>
<div class="table-responsive scrollbar mt-4 fs--1">
    @php
    $sendWorkPermit = false;
    @endphp
    <table class="table table-striped border-bottom">
        <thead class="light">
            <tr class="bg-primary text-white dark__bg-1000">
                <th class="border-0">Device Name</th>
                <th class="border-0 text-center">Current Status</th>
                <th class="border-0 text-center">Needed Status</th>
                <th class="border-0 text-center">Note</th>
                <th class="border-0 text-end">Actions</th>
            </tr>
        </thead>
        <tbody id="addedDeviceTable">
            @if($issue->issueHasDevices->count() > 0)
            @foreach($issue->issueHasDevices as $issueHasDevice)
            <tr>
                <td class="align-middle deviceName">
                    <span>{{$issueHasDevice->devices->name}}</span>
                    <span class="d-none">
                        <select class="form-select" name="device_id" id="editDevice_id" required>
                            <option selected value={{$issueHasDevice->devices->id}}>
                                {{$issueHasDevice->devices->name}}
                            </option>
                            @foreach ($notAddedDevices as $device)
                            @if($device->id == $issueHasDevice->devices->id)
                            @else
                            <option value="{{$device->id}}">{{$device->name}}</option>
                            @endif
                            @endforeach
                        </select>
                    </span>
                </td>
                <td class="align-middle text-center">
                    <span>{{$issueHasDevice->devices->deviceStatus->name}}</span>
                </td>
                <td class="align-middle text-center status">
                    <span>{{$issueHasDevice->neededStatus->name}}
                        @if($issueHasDevice->work_permit_status == 'pending')
                        <span class="badge bg-warning">
                            Pending
                        </span>
                        @endif
                        @if($issueHasDevice->work_permit_status == 'waiting')
                        @php
                        $sendWorkPermit = true;
                        @endphp
                        @endif
                        <span class="d-none">
                            <select class="form-select" name="assign_status" id="editAssign_status" required>
                                @foreach ($devicesStatuses as $devicesStatus)
                                @if($issueHasDevice->neededStatus->id == $devicesStatus->id)
                                <option selected value="{{$devicesStatus->id}}">{{$devicesStatus->name}}</option>
                                @else
                                <option value="{{$devicesStatus->id}}">{{$devicesStatus->name}}</option>
                                @endif
                                @endforeach
                            </select>
                        </span>
                </td>
                <td class="align-middle text-center">
                    @if($issueHasDevice->note != null)
                    {{$issueHasDevice->note}}
                    @else
                    <span class="badge badge-soft-danger">None</span>
                    @endif
                </td>
                <td class="align-middle text-end" id="{{$issueHasDevice->id}}">
                    @include('issue._partials.deviceDetailsBtn')
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
@if($sendWorkPermit == true)
<div class="alert alert-info alert-dismissible fade show mt-3" role="alert">
    <strong>Send Work Permit!</strong>
    Your device needs permission to work that is added. Please send work permit.
    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@include('issue._partials.createAddNewDeviceInIssue')
