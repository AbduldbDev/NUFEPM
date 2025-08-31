@extends('layouts.app')
@section('content')
    <div class="page-header">
        <div class="container-fluid">
            @php
                $hour = now()->format('H');
                if ($hour >= 0 && $hour < 12) {
                    $greeting = 'Good morning';
                } elseif ($hour >= 12 && $hour < 18) {
                    $greeting = 'Good afternoon';
                } else {
                    $greeting = 'Good evening';
                }
            @endphp
            <h1 class="greeting-text">{{ $greeting }}, {{ Auth::user()->fname }}!</h1>
            <p class="greeting-subtext">Welcome to your Fire Safety Control Center</p>
        </div>
    </div>

    <div class="container main-container">
        <div class="section-title">
            <span class="section-title-icon"><i class="fa-solid fa-home"></i></span>
            <span>Dashboard</span>
        </div>

        <div class="menu-grid">
            @if (Auth::user()->type === 'admin' || Auth::user()->type === 'engineer')
                <div class="menu-card">
                    <a href="{{ route('admin.ShowAdminDeviceMenu') }}" class="card-link"></a>
                    <div class="card-body">
                        <div class="card-icon-container">
                            <div class="card-icon">
                                <i class="fa-solid fa-radiation"></i>

                            </div>
                        </div>
                        <h3 class="card-title">Devices Management</h3>
                        <p class="card-description">
                            Manage and monitor all registered devices, including their type, model, serial number, and
                            installation details.
                        </p>
                    </div>
                </div>

                <div class="menu-card">
                    <a href="{{ route('admin.ShowExtinguishersMenu') }}" class="card-link"></a>
                    <div class="card-body">
                        <div class="card-icon-container">
                            <div class="card-icon">
                                <i class="fa-solid fa-fire-extinguisher"></i>
                            </div>
                        </div>
                        <h3 class="card-title">Fire Extinguisher Management</h3>
                        <p class="card-description">
                            Organize extinguisher entries with full control over their information.
                        </p>
                    </div>
                </div>

                <!-- Inspection Records Card -->
                <div class="menu-card">
                    <a href="{{ route('admin.ShowAdminInspectionMenu') }}" class="card-link"></a>
                    <div class="card-body">
                        <div class="card-icon-container">
                            <div class="card-icon">
                                <i class="fa-solid fa-folder"></i>
                            </div>
                        </div>
                        <h3 class="card-title">Inspection Records</h3>
                        <p class="card-description">
                            Organize maintenance logs, inspection results, and tracking.
                        </p>
                    </div>
                </div>

                <div class="menu-card">
                    <a href="{{ route('admin.ShowLocations') }}" class="card-link"></a>
                    <div class="card-body">
                        <div class="card-icon-container">
                            <div class="card-icon">
                                <i class="fa-solid fa-school-flag"></i>
                            </div>
                        </div>
                        <h3 class="card-title">Locations</h3>
                        <p class="card-description">
                            Manage and organize all registered locations where devices & Extinguisher are installed.

                        </p>
                    </div>
                </div>

                <!-- User Accounts Card -->
                <div class="menu-card">
                    <a href="{{ route('admin.ShowAccountsMenu') }}" class="card-link"></a>
                    <div class="card-body">
                        <div class="card-icon-container">
                            <div class="card-icon">
                                <i class="fa-solid fa-user-gear"></i>
                            </div>
                        </div>
                        <h3 class="card-title">User Accounts</h3>
                        <p class="card-description">
                            Manage user accounts with full control over access and roles.
                        </p>
                    </div>
                </div>
            @endif

            @if (Auth::user()->type === 'maintenance' || Auth::user()->type === 'guard')
                <!-- QR Scanner Card -->
                <div class="menu-card">

                    <a href="{{ route('maintenance.ShowScanner') }}" class="card-link"></a>
                    <div class="card-body">
                        <div class="card-icon-container">
                            <div class="card-icon">
                                <i class="fa-solid fa-qrcode"></i>
                            </div>
                        </div>
                        <h3 class="card-title">QR Scanner</h3>
                        <p class="card-description">
                            Scan extinguisher QR codes to view inspection history.
                        </p>
                    </div>
                </div>

                <!-- Extinguishers Card -->
                <div class="menu-card">

                    <a href="{{ route('maintenance.ShowMaintenanceExtinguishersMenu') }}" class="card-link"></a>
                    <div class="card-body">
                        <div class="card-icon-container">
                            <div class="card-icon">
                                <i class="fa-solid fa-fire-flame-curved"></i>
                            </div>
                        </div>
                        <h3 class="card-title">Extinguishers</h3>
                        <p class="card-description">
                            View extinguishers due for maintenance and access records.
                        </p>
                    </div>
                </div>

                <div class="menu-card">
                    <a href="{{ route('maintenance.ShowEmergencyPlansMenu') }}" class="card-link"></a>
                    <div class="card-body">
                        <div class="card-icon-container">
                            <div class="card-icon">
                                <i class="fa-solid fa-map"></i>
                            </div>
                        </div>
                        <h3 class="card-title">Emergency Plans</h3>
                        <p class="card-description">
                            Access and update building emergency evacuation plans, ensuring safety guidelines are always
                            clear and up to date.
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
@push('css')
    <link href="{{ asset('css/components/menu.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
