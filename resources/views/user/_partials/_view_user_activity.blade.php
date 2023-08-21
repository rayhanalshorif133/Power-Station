<div class="col-lg-5 ps-lg-2">
  <div class="sticky-sidebar">
    <div class="card mb-3 overflow-hidden">
      <div class="card-header">
        <h5 class="mb-0">User Activity</h5>
      </div>
      <div class="card-header bg-light align-items-center">
        <h6 class="mb-0">Approved Issues</h6>
      </div>
      <div class="card-body-custom bg-light mb-3">
        @if($user->approvedIssue == "No accepted issue.")
        <div class="col-12">
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>No accepted issue.!</strong>
          </div>
        </div>
        @else
        @foreach($user->approvedIssue as $issue)
        <div class="row g-0 align-items-center position-relative border-bottom">
          <div class="col py-1 position-static">
            <div class="d-flex align-items-center">
              <div class="avatar avatar-xl me-3">
                <div class="avatar-name rounded-circle bg-soft-primary text-dark"><span
                    class="fs-0 text-primary">{{substr($issue->title, 0,1)}}</span></div>
              </div>
              <div class="flex-1">
                <h6 class="mb-0 d-flex align-items-center">
                  <a class="text-800 stretched-link" href="{{route('issue.show', $issue->id)}}">
                    {{$issue->title}}
                  </a>
                </h6>
              </div>
            </div>
          </div>
          <div class="col py-1">
            <div class="row flex-end-center g-0">
              <div class="col-auto pe-2">
                <div class="fs--1 fw-semi-bold">
                  <span class="badge rounded-pill bg-primary">{{$issue->forwarded_status}}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
        @endif
      </div>
      <div class="card-header bg-light align-items-center">
        <h6 class="mb-0">Denied Issues</h6>
      </div>
      <div class="card-body-custom bg-light mb-3">
        @if($user->deniedIssue == "No rejected issue.")
        <div class="col-12">
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>No rejected issue.!</strong>
          </div>
        </div>
        @else
        @foreach($user->deniedIssue as $issue)
        <div class="row g-0 align-items-center position-relative border-bottom">
          <div class="col py-1 position-static">
            <div class="d-flex align-items-center">
              <div class="avatar avatar-xl me-3">
                <div class="avatar-name rounded-circle bg-soft-primary text-dark"><span
                    class="fs-0 text-primary">{{substr($issue->title, 0,1)}}</span></div>
              </div>
              <div class="flex-1">
                <h6 class="mb-0 d-flex align-items-center">
                  <a class="text-800 stretched-link" href="{{route('issue.show', $issue->id)}}">
                    {{$issue->title}}
                  </a>
                </h6>
              </div>
            </div>
          </div>
          <div class="col py-1">
            <div class="row flex-end-center g-0">
              <div class="col-auto pe-2">
                <div class="fs--1 fw-semi-bold">
                  <span class="badge rounded-pill bg-primary">{{$issue->forwarded_status}}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
        @endif
      </div>
    </div>
  </div>
</div>