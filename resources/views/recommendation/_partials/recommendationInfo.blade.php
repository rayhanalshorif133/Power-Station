<div class="fs--1 alert {{$recommendation->alert}} mt-2" role="alert">
    <div class="flex-1 ps-3" id="{{$recommendation->id}}">
        <h6 class="fs-0 mb-0">
            <h4 class="alert-heading fw-semi-bold"> {{ $recommendation->title }}
                <small class="fa fa-check-circle text-primary" data-fa-transform="shrink-4 down-2"></small>
            </h4>
        </h6>
        <p class="text-1000 mb-0 mt-2 note">
            {{ $recommendation->note }}
        </p>
        <p class="text-1000 mb-0 mt-2 moreNote d-none">
            {{ $recommendation->note }}
        </p>
        <span class="seeMore mt-2 p-1 d-none" style="cursor:pointer">See more...</span>
        <span class="lessMore d-none mt-2 p-1" style="cursor:pointer">Less more</span>

        {{-- creator --}}
        <div class="d-flex justify-content-between mb-0 mt-3">
            <div>
                <p class="text-muted">
                    <span class="fa fa-user"></span>
                    {{ $recommendation->addedBy->name }}
                    <small class="text-muted ml-2">
                        <span class="fa fa-clock-o"></span>
                        {{ $recommendation->created_at->diffForHumans() }}
                    </small>
                </p>
            </div>
            <div class="">
                <span class="btn btn-outline-danger btn-sm p-1 px-2"><i class="fas fa-edit"></i></span>
            </div>
        </div>

    </div>
</div>
