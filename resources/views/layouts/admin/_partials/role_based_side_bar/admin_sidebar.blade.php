<li class="nav-item">
    <!-- parent pages--><a class="nav-link" href="/">
        <div class="d-flex align-items-center">
            <span class="nav-link-icon">
                <span class="fas fa-chart-pie"></span></span>
            <span class="nav-link-text ps-1">Dashboard</span>
        </div>
    </a>
</li>
<li class="nav-item">
    <!-- label-->
    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
        <div class="col-auto navbar-vertical-label">User Department
        </div>
        <div class="col ps-0">
            <hr class="mb-0 navbar-vertical-divider" />
        </div>
    </div>
    <!-- User pages-->
    <a class="nav-link dropdown-indicator" href="#user" role="button" data-bs-toggle="collapse" aria-expanded="false"
        aria-controls="user">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-user"></span></span><span
                class="nav-link-text ps-1">User</span>
        </div>
    </a>
    <ul class="nav collapse false" id="user">
        <li class="nav-item">
            <a class="nav-link" href="{{route('user.create')}}" aria-expanded="false">
                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Add User</span>
                </div>
            </a>
        </li>
        <li class="nav-item"><a class="nav-link" href="{{route('user.index')}}" aria-expanded="false">
                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">User List</span>
                </div>
            </a>
        </li>
        <li class="nav-item"><a class="nav-link" href="{{route('user.pending.index')}}" aria-expanded="false">
                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Pending Users</span>
                </div>
            </a>
        </li>
        <li class="nav-item"><a class="nav-link" href="{{route('user.deactive.index')}}" aria-expanded="false">
                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Deactive Users</span>
                </div>
            </a>
        </li>
    </ul>

</li>
{{-- Issue Pages --}}
<li class="nav-item">
    <!-- label-->
    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
        <div class="col-auto navbar-vertical-label">Issue Management
        </div>
        <div class="col ps-0">
            <hr class="mb-0 navbar-vertical-divider" />
        </div>
    </div>
    <!-- Issue pages-->
    <a class="nav-link dropdown-indicator" href="#issue" role="button" data-bs-toggle="collapse" aria-expanded="false"
        aria-controls="issue">
        <div class="d-flex align-items-center">
            <span class="nav-link-icon"><span class="fas fa-bug"></span></span>
            <span class="nav-link-text ps-1">Issue</span>
        </div>
    </a>
    <ul class="nav collapse false" id="issue">
        <li class="nav-item"><a class="nav-link" href="{{route('issue.index')}}" aria-expanded="false">
                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">
                        Issue List</span>
                </div>
            </a>
        </li>
        <li class="nav-item"><a class="nav-link" href="{{route('issue.logs')}}" aria-expanded="false">
                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">
                        Issue Logs</span>
                </div>
            </a>
        </li>
        <li class="nav-item"><a class="nav-link" href="{{route('issue.forwardedList.index')}}" aria-expanded="false">
                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">
                        Forwarded Pending List</span>
                </div>
            </a>
        </li>
        <li class="nav-item"><a class="nav-link" href="{{route('issue.collaboration.index')}}" aria-expanded="false">
                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">
                        Collaboration Pending List</span>
                </div>
            </a>
        </li>
    </ul>
    <!-- Department pages-->
    <a class="nav-link" href="{{route('department.index')}}" role="button" aria-expanded="false">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                    class="fas fa-building"></span></span><span class="nav-link-text ps-1">Department</span>
        </div>
    </a>
    <a class="nav-link dropdown-indicator" href="#device" role="button" data-bs-toggle="collapse" aria-expanded="false"
        aria-controls="device">
        <div class="d-flex align-items-center">
            <span class="nav-link-icon"><span class="fas fa-tools"></span></span>
            <span class="nav-link-text ps-1">Device</span>
        </div>
    </a>
    <ul class="nav collapse false" id="device">
        <li class="nav-item"><a class="nav-link" href="{{route('device.index')}}" aria-expanded="false">
                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">
                        Device List</span>
                </div>
            </a>
        </li>
        <li class="nav-item"><a class="nav-link" href="{{route('device.logs.index')}}" aria-expanded="false">
                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">
                        Device Logs</span>
                </div>
            </a>
        </li>
        <li class="nav-item"><a class="nav-link" href="{{route('device.category.index')}}" aria-expanded="false">
                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">
                        Category</span>
                </div>
            </a>
        </li>
        <li class="nav-item"><a class="nav-link" href="{{route('device.area.index')}}" aria-expanded="false">
                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">
                        Area</span>
                </div>
            </a>
        </li>
        <li class="nav-item"><a class="nav-link" href="{{route('device.section.index')}}" aria-expanded="false">
                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">
                        Section</span>
                </div>
            </a>
        </li>
        <li class="nav-item"><a class="nav-link" href="{{route('device.status.index')}}" aria-expanded="false">
                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">
                        Status</span>
                </div>
            </a>
        </li>
        <li class="nav-item"><a class="nav-link" href="{{route('device.main-device.index')}}" aria-expanded="false">
                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">
                        Main Device</span>
                </div>
            </a>
        </li>
    </ul>
</li>
{{-- Store Management Pages --}}
<li class="nav-item">
    <!-- label-->
    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
        <div class="col-auto navbar-vertical-label">Store Management
        </div>
        <div class="col ps-0">
            <hr class="mb-0 navbar-vertical-divider" />
        </div>
    </div>
    <a class="nav-link" href="{{route('room.index')}}">
        <div class="d-flex align-items-center">
            <span class="nav-link-icon"><span class="fas fa-store"></span></span>
            <span class="nav-link-text ps-1">Room</span>
        </div>
    </a>
    <!-- Tools pages-->
    <a class="nav-link dropdown-indicator" href="#tools" role="button" data-bs-toggle="collapse" aria-expanded="false"
        aria-controls="tools">
        <div class="d-flex align-items-center">
            <span class="nav-link-icon"><span class="fas fa-screwdriver"></span></span>
            <span class="nav-link-text ps-1">Tools and Consumables</span>
        </div>
    </a>
    <ul class="nav collapse false" id="tools">
        <li class="nav-item"><a class="nav-link" href="{{route('device-stock.index')}}" aria-expanded="false">
                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">
                        Device Stock</span>
                </div>
            </a>
        </li>
        <li class="nav-item"><a class="nav-link" href="{{route('goods-tools.index')}}" aria-expanded="false">
                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">
                        Goods Tools/Devices</span>
                </div>
            </a>
        </li>
        <li class="nav-item"><a class="nav-link" href="{{route('provide-device.index')}}" aria-expanded="false">
                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">
                        Provide</span>
                </div>
            </a>
        </li>
    </ul>
</li>
{{-- Issue Pages --}}
<li class="nav-item">
    <!-- label-->
    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
        <div class="col-auto navbar-vertical-label">Tools & Consumables
        </div>
        <div class="col ps-0">
            <hr class="mb-0 navbar-vertical-divider" />
        </div>
    </div>

    <!-- Shaedule pages-->
    <a class="nav-link dropdown-indicator" href="#shaedule" role="button" data-bs-toggle="collapse"
        aria-expanded="false" aria-controls="shaedule">
        <div class="d-flex align-items-center">
            <span class="nav-link-icon"><span class="fas fa-calendar"></span></span>
            <span class="nav-link-text ps-1">Shaedule</span>
        </div>
    </a>
    <ul class="nav collapse false" id="shaedule">
        <li class="nav-item"><a class="nav-link" href="{{route('device-schedule.index')}}" aria-expanded="false">
                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">
                        Shaedule With Device</span>
                </div>
            </a>
            <!-- more inner pages-->
        </li>
    </ul>

    <!-- recommendation pages-->
    <a class="nav-link" href="{{route('recommendation.index')}}">
        <div class="d-flex align-items-center">
            <span class="nav-link-icon"><span class="fas fa-thumbs-up"></span></span>
            <span class="nav-link-text ps-1">Recommendation</span>
        </div>
    </a>
</li>

{{-- Issue Pages --}}
<li class="nav-item">
    <!-- label-->
    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
        <div class="col-auto navbar-vertical-label">Shift Engineer & Worker
        </div>
        <div class="col ps-0">
            <hr class="mb-0 navbar-vertical-divider" />
        </div>
    </div>
    <a class="nav-link" href="{{route('shift-engineer.index')}}">
        <div class="d-flex align-items-center">
            <span class="nav-link-icon"><span class="fas fa-calendar"></span></span>
            <span class="nav-link-text ps-1">Shift Engineers</span>
        </div>
    </a>
    <a class="nav-link" href="{{route('worker-over-time.index')}}">
        <div class="d-flex align-items-center">
            <span class="nav-link-icon"><span class="fas fa-calendar"></span></span>
            <span class="nav-link-text ps-1">Worker OT</span>
        </div>
    </a>
</li>

{{-- web site view Pages --}}
<li class="nav-item">
    <!-- label-->
    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
        <div class="col-auto navbar-vertical-label">Web Contents
        </div>
        <div class="col ps-0">
            <hr class="mb-0 navbar-vertical-divider" />
        </div>
    </div>
    <!-- Shaedule pages-->
    <a class="nav-link" href="{{ route('notice.index')}}">
        <div class="d-flex align-items-center">
            <span class="nav-link-icon">
                <span class="fas fa-star"></span>
            </span>
            <span class="nav-link-text ps-1">Notice</span>
        </div>
    </a>
</li>