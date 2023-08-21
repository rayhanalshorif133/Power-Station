<div class="modal fade" id="deviceStockUpdate" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
        <div class="modal-content position-relative">
            <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('device-stock.update')}}" method="post">
                @csrf
                <div class="modal-body p-0">
                    <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
                        <h4 class="mb-1" id="modalExampleDemoLabel">Update Device Stock</h4>
                    </div>
                    <div class="p-4 pb-0">
                        <input type="number" name="stock_id" id="updateStockId" class="d-none">
                        <div class="mb-3">
                            <label for="device_id" class="col-form-label required">Device</label>
                            <select name="device_id" id="updateDeviceId" class="form-select" required>
                                @foreach ($devices as $device)
                                <option value="{{$device->id}}">{{$device->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="user_id" class="col-form-label required">Sender</label>
                            <select name="user_id" id="updateSeenderUserId" class="form-select" required>
                                @foreach ($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="user_id" class="col-form-label required">Stock Quantity</label>
                            <div class="d-flex text-center">
                                <button type="button" class="btn btn-sm  btn-outline-danger d-flex flex-center p-3"
                                    style="padding: 10px !important;" id="minusBtn">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" name="stockQuantity" id="updateStockQuantity"
                                    class="form-control w-25 mx-2 text-center stockQuantity">
                                <button type="button" class="btn btn-sm  btn-outline-success d-flex flex-center p-3"
                                    style="padding: 10px !important;" id="plusBtn">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary submitBtn" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>