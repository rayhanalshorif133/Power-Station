@extends('layouts.admin.admin')


@section('head')
<style>
    .btn-falcon-danger:hover,
    .btn-falcon-danger:focus {
        color: var(--falcon-btn-falcon-danger-hover-color) !important;
        background-color: var(--falcon-btn-falcon-background) !important;
        border-color: var(--falcon-btn-falcon-background) !important;
    }

    .mb-8 {
        margin-bottom: 6.5rem !important;
    }

    .mlr-build {
        margin: 4px 18px;
    }

    .text-purple {
        --falcon-text-opacity: 1;
        color: #8327fd !important;
    }

    .text-green {
        --falcon-text-opacity: 1;
        color: #017e39 !important;
    }

    .text-pink {
        --falcon-text-opacity: 1;
        color: #D5266B !important;
    }

    .card-body-custom {
        -webkit-box-flex: 1;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        padding: 0 17px;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-3 btn-reveal-trigger">
            <div class="card-header position-relative min-vh-25 mb-8">
                <div class="bg-holder rounded-3 rounded-bottom-0"
                    style="background-image:url('{{asset($user->cover_image)}}');">
                </div>
                <div class="avatar avatar-5xl avatar-profile">
                    @if($user->image)
                    <img class="rounded-circle img-thumbnail shadow-sm" src="{{asset($user->image)}}" width="200"
                        alt="">
                    @else
                    <div class="avatar-name rounded-circle img-thumbnail"><span class="">
                            {{substr($user->name, 0,2)}}</span></div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row g-0">
    @include('user._partials._view_profile_details')
    @include('user._partials._view_user_activity')
</div>
@endsection


@section('scripts')
@endsection