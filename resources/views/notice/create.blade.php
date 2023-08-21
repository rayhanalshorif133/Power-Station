<div class="modal fade" id="createNotice" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 600px">
    <div class="modal-content position-relative">
      <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
        <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal"
          aria-label="Close"></button>
      </div>
      <form action="{{route('notice.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body p-0">
          <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
            <h4 class="mb-1" id="modalExampleDemoLabel">Add a new Notice </h4>
          </div>
          <div class="p-4 pb-0">
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="col-form-label" for="title">Title<span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="title" name="title" placeholder="Enter notice title"
                    required />
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="col-form-label" for="file">File<span class="text-danger">*</span></label>
                  <input type="file" class="form-control" id="file" name="files[]" placeholder="upload file or image"
                    required />
                </div>
              </div>
            </div>
          </div>
          <div class="p-4 pt-2 pb-0">
            <div class="mb-3">
              <label class="col-form-label" for="description">Description(<span
                  class="text-danger">optional</span>)</label>
              <textarea type="text" class="form-control" id="description" name="description"
                placeholder="Enter notice description" required></textarea>
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