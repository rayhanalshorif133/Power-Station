<nav class="navbar navbar-light navbar-vertical navbar-expand-xl">
    <div class="d-flex align-items-center">
        <div class="toggle-icon-wrapper">
            <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-bs-toggle="tooltip"
                data-bs-placement="left" title="Toggle Navigation"><span class="navbar-toggle-icon"><span
                        class="toggle-line"></span></span></button>

        </div>
        <a class="navbar-brand" href="index.html" style="font-size: 1.28rem">
            <div class="d-flex align-items-center py-3"><img class="me-2" src="{{asset('images/logo.svg')}}" alt=""
                    width="40" /><span class="font-sans-serif">
                    <span class="font-weight-extra-bold">
                        Shahjibazar <br> Power
                    </span>
                </span>
            </div>
        </a>
    </div>
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <div class="navbar-vertical-content scrollbar">
            <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
                @role('admin')
                @include('layouts.admin._partials.role_based_side_bar.admin_sidebar')
                @endrole
                @role('manager')
                @include('layouts.admin._partials.role_based_side_bar.manager_sidebar')
                @endrole
                @role('deputy-manager')
                @include('layouts.admin._partials.role_based_side_bar.deputy_manager_sidebar')
                @endrole
                @role('operation-user')
                @include('layouts.admin._partials.role_based_side_bar.operation_user_sidebar')
                @endrole
            </ul>
        </div>
    </div>
</nav>