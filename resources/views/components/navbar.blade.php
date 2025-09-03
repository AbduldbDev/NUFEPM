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
                        @if ($unreadCount > 0)
                            <span class="notification-badge">{{ $unreadCount }}</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end notification-dropdown"
                        aria-labelledby="notificationDropdown">
                        <div class="d-flex justify-content-between px-3 pt-2">
                            <h6 class="fw-bold">Notifications</h6>

                        </div>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        @forelse($notifications as $notif)
                            <li class="notification-item {{ $notif->is_read ? '' : 'unread' }}">
                                <div class="dropdown-item d-flex">
                                    <div
                                        class="notification-icon-type 
                                        @if ($notif->type === 'maintenance') notification-icon-warning 
                                        @elseif($notif->type === 'sos') notification-icon-urgent 
                                        @else notification-icon-info @endif">
                                        <i
                                            class="fa-solid 
                                            @if ($notif->type === 'maintenance') fa-clock 
                                            @elseif($notif->type === 'sos') fa-exclamation 
                                            @else fa-info @endif">
                                        </i>
                                    </div>

                                    <div class="text-wrap text-break ms-2">
                                        <div class="fw-bold">
                                            {{ $notif->type === 'sos' ? 'Emergency!' : ucfirst($notif->type) }}
                                        </div>

                                        <div class="small">{{ $notif->message }}</div>
                                        <div class="notification-time">{{ $notif->created_at->diffForHumans() }}</div>

                                        <div class="d-flex gap-2 mt-1">
                                            @if (!$notif->is_read)
                                                <form action="{{ route('notifications.markRead', $notif->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn btn-link btn-sm text-decoration-none p-0">
                                                        Mark as read
                                                    </button>
                                                </form>
                                            @endif

                                            <form action="{{ route('notifications.destroy', $notif->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-link btn-sm text-danger text-decoration-none p-0">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                        @empty
                            <li class="text-center p-2">No notifications</li>
                        @endforelse

                        <li class="text-center">
                            <form action="{{ route('notifications.markAllRead') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-link btn-sm text-decoration-none">Mark all as
                                    read</button>
                            </form>
                        </li>
                    </ul>
                </li>

                <!-- User Profile Item -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Hi, <b>{{ Auth::user()->fname }}</b>
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
