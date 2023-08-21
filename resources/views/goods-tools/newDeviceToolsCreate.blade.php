<div class="modal fade" id="newDeviceToolsCreate" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 700px">
    <div class="modal-content position-relative">
      <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
        <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal"
          aria-label="Close"></button>
      </div>
      <form action="{{route('goods-tools.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body p-0">
          <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
            <h4 class="mb-1" id="modalExampleDemoLabel">Add Goods Tools/Device</h4>
          </div>
          <div class="p-4 pb-0">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="category_id" class="col-form-label required">Category</label>
                <select name="category_id" id="categoryId" class="form-select" required>
                  <option value="" disabled selected>Select Category</option>
                  @foreach ($deviceCategories as $category)
                  <option value="{{$category->id}}">{{$category->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label for="device_id" class="col-form-label required">Device</label>
                <select name="device_id" id="deviceId" class="form-select" required>
                  <option value="" disabled selected>Waiting For Selected Category</option>
                </select>
                <h5 class="noDeviceFound text-danger d-none">No Device Found</h5>
              </div>
              <div class="col-md-6">
                <label for="image" class="col-form-label required">Image</label>
                <input type="file" name="image" id="image" class="form-control" required
                  accept="image/png, image/gif, image/jpeg">
              </div>
            </div>
            <div class="mb-3">
              <label for="description" class="col-form-label">Description</label>
              <textarea name="description" id="description" class="form-control" rows="3"></textarea>
            </div>
            <div class="row mb-3">
              <div class="col-md-4">
                <label for="room_id" class="col-form-label required">Room</label>
                <select name="room_id" id="roomId" class="form-select" required>
                  <option value="" disabled selected>Select Room</option>
                  @foreach ($rooms as $room)
                  <option value="{{$room->id}}">{{$room->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-4">
                <label for="rack_id" class="col-form-label required">Rack</label>
                <select name="rack_id" id="rackId" class="form-select" required>
                  <option value="" disabled selected>Select Rack</option>
                </select>
              </div>
              <div class="col-md-4">
                <label for="shelf_id" class="col-form-label required">Shelf</label>
                <select name="shelf_id" id="shelfId" class="form-select" required>
                  <option value="" disabled selected>Select shelf</option>
                </select>
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