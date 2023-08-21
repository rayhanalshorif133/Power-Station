@if (Session::has('message'))
<div class="alert alert-{{ Session::get('class') }} border-2 d-flex align-items-center" role="alert">
    <div class="bg-{{ Session::get('class') }} me-3 icon-item">
        @if(Session::get('class') == 'success')
        <span class="fas fa-check-circle text-white fs-3"></span>
        @elseif(Session::get('class') == 'info')
        <span class="fas fa-info-circle text-white fs-3"></span>
        @elseif(Session::get('class') == 'warning')
        <span class="fas fa-exclamation-circle text-white fs-3"></span>
        @elseif(Session::get('class') == 'danger')
        <span class="fas fa-times-circle text-white fs-3"></span>
        @endif
    </div>
    <p class="mb-0 flex-1">
        {{ Session::get('message')}}
    </p>
    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
