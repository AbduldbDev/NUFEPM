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
                        <h3 class="card-title">Fire Equipment Management</h3>
                        <p class="card-description">
                            Manage all fire equipment with complete control over their details, status, and records.
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

                <!-- Tickets Card -->
                <div class="menu-card">
                    <a href="{{ route('admin.ShowAdminInspectionMenu') }}" class="card-link"></a>
                    <div class="card-body">
                        <div class="card-icon-container">
                            <div class="card-icon">
                                <i class="fa-solid fa-ticket"></i> <!-- Changed Icon -->
                            </div>
                        </div>
                        <h3 class="card-title">Tickets</h3>
                        <p class="card-description">
                            View and manage issue tickets, reports, and follow-up actions.
                        </p>
                    </div>
                </div>

                <div class="menu-card">
                    <a class="card-link" href="{{ route('admin.ShowSOSReports') }}"></a>
                    <div class="card-body">
                        <div class="card-icon-container">
                            <div class="card-icon ">
                                <i class="fa-solid fa-triangle-exclamation"></i>
                            </div>
                        </div>
                        <h3 class="card-title">Incident Reports</h3>
                        <p class="card-description">
                            View and manage Incident reports submitted by users, including location details and
                            attachments for
                            immediate action.
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

                <div class="menu-card">
                    <a href="{{ route('admin.ShowAllQuestions') }}" class="card-link"></a>
                    <div class="card-body">
                        <div class="card-icon-container">
                            <div class="card-icon">
                                <i class="fa-solid fa-circle-question"></i>
                            </div>
                        </div>
                        <h3 class="card-title">Inspection Questions</h3>
                        <p class="card-description">
                            Manage and customize inspection questions for evaluating equipment and safety compliance.
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

                <div class="menu-card">
                    <a href="{{ route('admin.ShowGuideTable') }}" class="card-link"></a>
                    <div class="card-body">
                        <div class="card-icon-container">
                            <div class="card-icon">
                                <i class="fa-solid fa-circle-question"></i>
                            </div>
                        </div>
                        <h3 class="card-title">Extinguisher Inspection Guide</h3>
                        <p class="card-description">
                            Manage inspection guide content to ensure updated and accessible safety
                            procedures.
                        </p>
                    </div>
                </div>

                <div class="menu-card">
                    <a href="{{ route('admin.ManageEmergencyPlans') }}" class="card-link"></a>
                    <div class="card-body">
                        <div class="card-icon-container">
                            <div class="card-icon ">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </div>
                        </div>
                        <h3 class="card-title">Manage Emergency Plans</h3>
                        <p class="card-description">
                            Manage emergency evacuation plans to keep safety procedures accurate and ready
                            for anysituation.
                        </p>
                    </div>
                </div>

                <div class="menu-card">
                    <a href="{{ route('admin.ManageEmergencyHotlines') }}" class="card-link"></a>
                    <div class="card-body">
                        <div class="card-icon-container">
                            <div class="card-icon">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                        </div>
                        <h3 class="card-title">Manage Emergency Hotlines</h3>
                        <p class="card-description">
                            Add, update, or organize emergency contact numbers by location to ensure quick access during
                            urgent situations.
                        </p>
                    </div>
                </div>
            @endif

            @if (Auth::user()->type === 'maintenance' || Auth::user()->type === 'guard')
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

                <div class="menu-card">
                    <a href="{{ route('maintenance.CreateSOSReport') }}" class="card-link"></a>
                    <div class="card-body">
                        <div class="card-icon-container">
                            <div class="card-icon ">
                                <i class="fa-solid fa-bullhorn"></i>
                            </div>
                        </div>
                        <h3 class="card-title">Submit Incident Report</h3>
                        <p class="card-description">
                            Quickly submit an Incident report with location details, description for immediate
                            response.
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
                        <h3 class="card-title">Fire Equipment</h3>
                        <p class="card-description">
                            View fire equipment scheduled for maintenance and review their service records.
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

                <div class="menu-card">
                    <a href="{{ route('maintenance.ShowInspectionGuide') }}" class="card-link"></a>
                    <div class="card-body">
                        <div class="card-icon-container">
                            <div class="card-icon">
                                <i class="fa-solid fa-circle-question"></i>
                            </div>
                        </div>
                        <h3 class="card-title">Inspection Guide</h3>
                        <p class="card-description">
                            Review step-by-step guidelines for inspecting fire safety equipment to ensure readiness and
                            compliance.

                        </p>
                    </div>
                </div>

                <div class="menu-card">
                    <a href="{{ route('maintenance.ShowHotlinesGuide') }}" class="card-link"></a>
                    <div class="card-body">
                        <div class="card-icon-container">
                            <div class="card-icon">
                                <i class="fa-solid fa-phone-volume"></i>
                            </div>
                        </div>
                        <h3 class="card-title">Emergency Hotlines Guide</h3>
                        <p class="card-description">
                            Access a list of important emergency contact numbers by location for quick response during
                            urgent situations.
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
