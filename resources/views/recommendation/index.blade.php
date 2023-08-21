@extends('layouts.admin.admin')



@section('head')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="card shadow-none">
            <div class="card-body p-0 pb-3">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card-header">
                            <div class="row flex-between-end">
                                <div class="col-auto align-self-center">
                                    <h5 class="mb-0">Spacial Recommendations</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center justify-content-end my-3">
                            <div id="bulk-select-replace-element">
                                <button class="btn btn-falcon-success btn-sm" type="button" data-bs-toggle="modal"
                                    data-bs-target="#createRecommendation">
                                    <span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span>
                                    <span class="ms-1">New</span>
                                </button>
                            </div>
                            <div class="d-none ms-3" id="bulk-select-actions">
                                <div class="d-flex">
                                    <select class="form-select form-select-sm userActionSelect"
                                        aria-label="Bulk actions">
                                        <option selected="selected">Actions</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                        <option value="delete">Delete</option>
                                    </select>
                                    <button class="btn btn-falcon-danger btn-sm ms-2 userApplyBtn"
                                        type="button">Apply</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive scrollbar">
                    <ul class="nav nav-tabs" id="recommendationTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="all-recommendation" data-bs-toggle="tab"
                                data-bs-target="#all-recommendation-pane" type="button" role="tab"
                                aria-controls="all-recommendation-pane" aria-selected="true">All</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="low" data-bs-toggle="tab" data-bs-target="#low-pane"
                                type="button" role="tab" aria-controls="low-pane" aria-selected="false">Low</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="medium" data-bs-toggle="tab" data-bs-target="#medium-pane"
                                type="button" role="tab" aria-controls="medium-pane"
                                aria-selected="false">Medium</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="high" data-bs-toggle="tab" data-bs-target="#high-pane"
                                type="button" role="tab" aria-controls="high-pane" aria-selected="false">high</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="recommendationTabContent">
                        <div class="tab-pane fade show active" id="all-recommendation-pane" role="tabpanel"
                            aria-labelledby="all-recommendation" tabindex="0">
                            <div class="col-lg-12">
                                @foreach ($recommendations as $recommendation)
                                @include('recommendation._partials.recommendationInfo')
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade" id="low-pane" role="tabpanel" aria-labelledby="low" tabindex="0">
                            <div class="col-lg-12">
                                @foreach ($recommendations as $recommendation)
                                @if($recommendation->priority == 'low')
                                @include('recommendation._partials.recommendationInfo')
                                @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade" id="medium-pane" role="tabpanel" aria-labelledby="medium"
                            tabindex="0">
                            <div class="col-lg-12">
                                @foreach ($recommendations as $recommendation)
                                @if($recommendation->priority == 'medium')
                                @include('recommendation._partials.recommendationInfo')
                                @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade" id="high-pane" role="tabpanel" aria-labelledby="high" tabindex="0">
                            <div class="col-lg-12">
                                @foreach ($recommendations as $recommendation)
                                @if($recommendation->priority == 'high')
                                @include('recommendation._partials.recommendationInfo')
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('recommendation.create')
@endsection


@section('scripts')
<script src="{{asset('js/others/recommendation.js')}}"></script>
@endsection
