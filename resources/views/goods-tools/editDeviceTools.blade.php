<div class="modal fade" id="editDeviceTools" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
    <div class="modal-content position-relative">
      <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
        <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal"
          aria-label="Close"></button>
      </div>
      <form action="{{route('goods-tools.update')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body p-0">
          <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
            <h4 class="mb-1" id="modalExampleDemoLabel">Update Goods Tools/Device</h4>
          </div>
          <div class="p-4 pb-0">
            <input type="text" class="form-control d-none" id="goodsToolsID" name="goodsToolsID">
            <div class="mb-3">
              <label for="device_id" class="col-form-label required">Device</label>
              <select name="device_id" id="editDeviceId" class="form-select" required>
                @foreach ($devices as $device)
                <option value="{{$device->id}}">{{$device->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label for="category_id" class="col-form-label required">Category</label>
              <select name="category_id" id="editCategoryId" class="form-select" required>
                @foreach ($deviceCategories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3 setImage">
              <label for="image" class="col-form-label">Image</label> <br>
              <img src="" alt="Device Tools Image" style="max-width: 100% !important;" height="45%" width="45%" />
            </div>
            <div class="mb-3">
              <label for="image" class="col-form-label">Update Image</label>
              <input type="file" name="image" class="form-control" accept="image/png, image/gif, image/jpeg">
            </div>
            <div class="mb-3">
              <label for="description" class="col-form-label">Description</label>
              <textarea name="description" id="editDescription" class="form-control" rows="3"></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
          <button class="btn btn-primary editSubmitBtn" type="submit">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>