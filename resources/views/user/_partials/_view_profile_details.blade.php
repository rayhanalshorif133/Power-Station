<div class="col-lg-7 pe-lg-2">
  <div class="card mb-3">
    <div class="card-header">
      <h5 class="mb-0">Profile Details</h5>
    </div>
    <div class="card-body bg-light">
      <div class="row g-3">
        <div class="col-lg-6">
          <h6 class="fs-0 mb-0"><small class="fa fa-user text-primary" data-fa-transform="shrink-4 down-2"></small> Name
          </h6>
          <p class="text-1000 mb-0 mlr-build">{{$user->name}}</p>
        </div>
        <div class="col-lg-6">
          <h6 class="fs-0 mb-0"><small class="fa fa-envelope text-success" data-fa-transform="shrink-4 down-2"></small>
            Email
          </h6>
          <p class="text-1000 mb-0 mlr-build">{{$user->email}}</p>
        </div>
        <div class="col-lg-6">
          <h6 class="fs-0 mb-0"><small class="fa fa-phone-alt text-purple" data-fa-transform="shrink-4 down-2"></small>
            Phone
          </h6>
          <p class="text-1000 mb-0 mlr-build">{{$user->phone}}</p>
        </div>
        <div class="col-lg-6">
          <h6 class="fs-0 mb-0"><small class="fa fa-creative-commons-by text-purple"
              data-fa-transform="shrink-4 down-2"></small> Designation
          </h6>
          <p class="text-1000 mb-0 mlr-build">{{$user->designation}}</p>
        </div>
        <div class="col-lg-6">
          <h6 class="fs-0 mb-0"><small class="fa fa-user text-green" data-fa-transform="shrink-4 down-2"></small> Role
          </h6>
          <p class="text-1000 mb-0 mlr-build">
            <span class="badge rounded-pill bg-primary text-capitalize">
              {{str_replace("-"," ",$user->roles[0]->name)}}
            </span>
          </p>
        </div>
        <div class="col-lg-6">
          <h6 class="fs-0 mb-0">
            @if($user->status == "active")
            <small class="fa fa-user-check text-green" data-fa-transform="shrink-4 down-2"></small>
            @else
            <small class="fa fa-user-times text-danger" data-fa-transform="shrink-4 down-2"></small>
            @endif
            Status
          </h6>
          <p class="text-1000 mb-0 mlr-build">
            @if($user->status == "active")
            <span class="badge badge-soft-primary text-capitalize">
              {{$user->status}}
            </span>
            @else
            <span class="badge badge-soft-danger text-capitalize">
              {{$user->status}}
            </span>
            @endif
          </p>
        </div>
        <div class="col-lg-12">
          <h6 class="fs-0 mb-0"><small class="fas fa-building text-pink" data-fa-transform="shrink-4 down-2"></small>
            Assigned Departments
          </h6>
          <p class="text-1000 mb-0 mlr-build">
            @foreach($user->department as $department)
            <span class="badge badge-soft-success">{{$department}}</span>
            @endforeach
          </p>
        </div>

        <a href="{{route('user.index')}}" class="mt-5">
          <button class="btn btn-outline-danger btn-sm px-3" type="button"><span class="fas fa-backspace"></span>
            Back</button>
        </a>
      </div>
    </div>
  </div>
  <div class="card mb-3 d-none">
    <div class="card-header">
      <h5 class="mb-0">Experiences</h5>
    </div>
    <div class="card-body bg-light"><a class="mb-4 d-block d-flex align-items-center" href="#experience-form1"
        data-bs-toggle="collapse" aria-expanded="false" aria-controls="experience-form1"><span
          class="circle-dashed"><span class="fas fa-plus"></span></span><span class="ms-3">Add new
          experience</span></a>
      <div class="collapse" id="experience-form1">
        <form class="row">
          <div class="col-3 mb-3 text-lg-end">
            <label class="form-label" for="company">Company</label>
          </div>
          <div class="col-9 col-sm-7 mb-3">
            <input class="form-control form-control-sm" id="company" type="text" />
          </div>
          <div class="col-3 mb-3 text-lg-end">
            <label class="form-label" for="position">Position</label>
          </div>
          <div class="col-9 col-sm-7 mb-3">
            <input class="form-control form-control-sm" id="position" type="text" />
          </div>
          <div class="col-3 mb-3 text-lg-end">
            <label class="form-label" for="city">City </label>
          </div>
          <div class="col-9 col-sm-7 mb-3">
            <input class="form-control form-control-sm" id="city" type="text" />
          </div>
          <div class="col-3 mb-3 text-lg-end">
            <label class="form-label" for="exp-description">Description </label>
          </div>
          <div class="col-9 col-sm-7 mb-3">
            <textarea class="form-control form-control-sm" id="exp-description" rows="3"> </textarea>
          </div>
          <div class="col-9 col-sm-7 offset-3 mb-3">
            <div class="form-check mb-0 lh-1">
              <input class="form-check-input" type="checkbox" id="experience-current" checked="checked" />
              <label class="form-check-label mb-0" for="experience-current">I currently work here
              </label>
            </div>
          </div>
          <div class="col-3 text-lg-end">
            <label class="form-label" for="experience-form2">From </label>
          </div>
          <div class="col-9 col-sm-7 mb-3">
            <input class="form-control form-control-sm text-500 datetimepicker" id="experience-form2" type="text"
              placeholder="d/m/y" data-options='{"dateFormat":"d/m/y","disableMobile":true}' />
          </div>
          <div class="col-3 text-lg-end">
            <label class="form-label" for="experience-to">To </label>
          </div>
          <div class="col-9 col-sm-7 mb-3">
            <input class="form-control form-control-sm text-500 datetimepicker" id="experience-to" type="text"
              placeholder="d/m/y" data-options='{"dateFormat":"d/m/y","disableMobile":true}' />
          </div>
          <div class="col-9 col-sm-7 offset-3">
            <button class="btn btn-primary" type="button">Save</button>
          </div>
        </form>
        <div class="border-dashed-bottom my-4"></div>
      </div>
      <div class="d-flex"><a href="#!"> <img class="img-fluid" src="../../assets/img/logos/g.png" alt=""
            width="56" /></a>
        <div class="flex-1 position-relative ps-3">
          <h6 class="fs-0 mb-0">Big Data Engineer<span data-bs-toggle="tooltip" data-bs-placement="top"
              title="Verified"><small class="fa fa-check-circle text-primary"
                data-fa-transform="shrink-4 down-2"></small></span>
          </h6>
          <p class="mb-1"> <a href="#!">Google</a></p>
          <p class="text-1000 mb-0">Apr 2012 - Present &bull; 6 yrs 9 mos</p>
          <p class="text-1000 mb-0">California, USA</p>
          <div class="border-dashed-bottom my-3"></div>
        </div>
      </div>
      <div class="d-flex"><a href="#!"> <img class="img-fluid" src="../../assets/img/logos/apple.png" alt=""
            width="56" /></a>
        <div class="flex-1 position-relative ps-3">
          <h6 class="fs-0 mb-0">Software Engineer<span data-bs-toggle="tooltip" data-bs-placement="top"
              title="Verified"><small class="fa fa-check-circle text-primary"
                data-fa-transform="shrink-4 down-2"></small></span>
          </h6>
          <p class="mb-1"> <a href="#!">Apple</a></p>
          <p class="text-1000 mb-0">Jan 2012 - Apr 2012 &bull; 4 mos</p>
          <p class="text-1000 mb-0">California, USA</p>
          <div class="border-dashed-bottom my-3"></div>
        </div>
      </div>
      <div class="d-flex"><a href="#!"> <img class="img-fluid" src="../../assets/img/logos/nike.png" alt=""
            width="56" /></a>
        <div class="flex-1 position-relative ps-3">
          <h6 class="fs-0 mb-0">Mobile App Developer<span data-bs-toggle="tooltip" data-bs-placement="top"
              title="Verified"><small class="fa fa-check-circle text-primary"
                data-fa-transform="shrink-4 down-2"></small></span>
          </h6>
          <p class="mb-1"> <a href="#!">Nike</a></p>
          <p class="text-1000 mb-0">Jan 2011 - Apr 2012 &bull; 1 yr 4 mos</p>
          <p class="text-1000 mb-0">Beaverton, USA</p>
        </div>
      </div>
    </div>
  </div>
</div>