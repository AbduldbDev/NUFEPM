<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('dashboard') }}">NUFEPM</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <!-- Notification Item -->
                <li class="nav-item dropdown">
                    <a class="nav-link text-white dropdown-toggle notification-icon" href="#"
                        id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-bell"></i>
                        <span class="notification-badge">3</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end notification-dropdown"
                        aria-labelledby="notificationDropdown">
                        <div class="d-flex justify-content-between px-3 pt-2">
                            <h6 class="fw-bold">Notifications</h6>
                            <span class="mark-all-read">Mark all as read</span>
                        </div>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <!-- Notification items -->
                        <li class="notification-item unread">
                            <a class="dropdown-item" href="#">
                                <div class="d-flex">
                                    <div class="notification-icon-type notification-icon-urgent">
                                        <i class="fa-solid fa-exclamation"></i>
                                    </div>
                                    <div class="text-wrap text-break">
                                        <div class="fw-bold">System Update Required</div>
                                        <div class="small">Urgent system maintenance scheduled for tomorrow at
                                            10:00 AM
                                        </div>
                                        <div class="notification-time">30 minutes ago</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item unread">
                            <a class="dropdown-item" href="#">
                                <div class="d-flex">
                                    <div class="notification-icon-type notification-icon-warning">
                                        <i class="fa-solid fa-clock"></i>
                                    </div>
                                    <div class="text-wrap text-break">
                                        <div class="fw-bold">Deadline Approaching</div>
                                        <div class="small">Project submission deadline is in 2 days</div>
                                        <div class="notification-time">2 hours ago</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <a class="dropdown-item" href="#">
                                <div class="d-flex">
                                    <div class="notification-icon-type notification-icon-info">
                                        <i class="fa-solid fa-info"></i>
                                    </div>
                                    <div class="text-wrap text-break">
                                        <div class="fw-bold">New Message</div>
                                        <div class="small">You have received a new message from Dr. Smith</div>
                                        <div class="notification-time">Yesterday</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="text-center">
                            <a class="dropdown-item small" href="#">View all notifications</a>
                        </li>
                    </ul>
                </li>

                <!-- User Profile Item -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Hi, <b>{{ Auth::user()->fname }}
                        </b>

                        @if (Auth::user()->image)
                            <img class="profile-pic" src="{{ asset('storage/' . Auth::user()->image) }}"
                                alt="User Image">
                        @else
                            <img class="profile-pic" src="{{ asset('/Image/profile.webp') }}" alt="User Image">
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end profile-dropdown" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="{{ route('admin.ShowProfile') }}"><i
                                    class="fa-solid fa-user"></i> Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
