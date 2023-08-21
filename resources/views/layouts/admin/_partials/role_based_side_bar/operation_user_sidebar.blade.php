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
</li>
