<div class="modal fade" id="newWorkerOTCreate" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 600px">
    <div class="modal-content position-relative">
      <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
        <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal"
          aria-label="Close"></button>
      </div>
      <form action="{{route('worker-over-time.store')}}" method="post">
        @csrf
        <div class="modal-body p-0">
          <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
            <h4 class="mb-1" id="modalExampleDemoLabel">Add a new Worker's Over Time </h4>
          </div>
          <div class="p-4 pb-0 mb-3">
            <label for="user_id" class="col-form-label required">Worker Name</label>
            <select name="user_id" id="user_id" class="form-select" required>
              <option value="" disabled selected>Select Worker</option>
              @foreach ($users as $user)
              <option value="{{$user->id}}">{{$user->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="p-4 pt-2 pb-0 mb-3 row">
            <div class="col-md-6">
              <label for="start_date_time" class="col-form-label required">Start Date Time</label>
              <input type="datetime-local" name="start_date_time" id="start_date_time" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label for="end_date_time" class="col-form-label required">End Date Time</label>
              <input type="datetime-local" name="end_date_time" id="end_date_time" class="form-control" required>
            </div>
          </div>
          <div class="p-4 pt-2 pb-0 mb-3">
            <label for="purpose" class="col-form-label required">Work Purpose</label>
            <textarea name="purpose" id="purpose" class="form-control" rows="3" required></textarea>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
            <button class="btn btn-primary" type="submit">Submit</button>
          </div>
      </form>
    </div>
  </div>
</div>