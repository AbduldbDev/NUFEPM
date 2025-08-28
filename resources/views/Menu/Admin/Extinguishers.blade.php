@extends('layouts.app')
@section('content')
    <div class="main-container container">
        <div class="breadcrumb-container">
            <div class="breadcrumb-back">
                <a href="javascript:history.back()" class="back-button">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
            </div>
            <div class="breadcrumb-icon">
                <i class="fa-solid fa-fire-extinguisher"></i>
            </div>
            <nav class="breadcrumb-nav">
                <div class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Home</a>
                </div>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <div class="breadcrumb-item active">
                    <span>Extinguishers</span>
                </div>
            </nav>
        </div>
        <div class="menu-grid">

            <div class="menu-card">

                <a href="{{ route('admin.ShowAddTankForm') }}" class="card-link"></a>
                <div class="card-body">
                    <div class="card-icon-container">
                        <div class="card-icon">
                            <i class="fa-solid fa-fire-extinguisher"></i>
                        </div>
                    </div>
                    <h3 class="card-title">Add Extinguishers</h3>
                    <p class="card-description">
                        Register new fire extinguishers and assign QR codes along with their maintenance details and
                        location.
                    </p>
                </div>
            </div>

            <div class="menu-card">

                <a href="{{ route('admin.ShowActiveExtinguishers') }}" class="card-link"></a>
                <div class="card-body">
                    <div class="card-icon-container">
                        <div class="card-icon">
                            <i class="fa-solid fa-chart-line"></i>
                        </div>
                    </div>
                    <h3 class="card-title">Active Extinguishers</h3>
                    <p class="card-description">
                        View and manage all currently active fire extinguishers, including their maintenance status and
                        locations.
                    </p>
                </div>
            </div>

            <div class="menu-card">

                <a href="{{ route('admin.ShowRetiredExtinguishers') }}" class="card-link"></a>
                <div class="card-body">
                    <div class="card-icon-container">
                        <div class="card-icon">
                            <i class="fa-solid fa-box-archive"></i>
                        </div>
                    </div>
                    <h3 class="card-title">Retired Extinguishers</h3>
                    <p class="card-description">
                        Review and track extinguishers that have been decommissioned, replaced, or are no longer in use.
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
                        Manage and customize inspection questions used for evaluating extinguisher and safety
                        compliance.
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
                    <h3 class="card-title">Extinguisher Locations</h3>
                    <p class="card-description">
                        Access your personal account settings to update your details and change your password.
                    </p>
                </div>
            </div>

            {{-- <div class="menu-card">

                <a href="{{ route('admin.ShowTypes') }}" class="card-link"></a>
                <div class="card-body">
                    <div class="card-icon-container">
                        <div class="card-icon">
                            <i class="fa-solid fa-fire-extinguisher"></i>
                        </div>
                    </div>
                    <h3 class="card-title">Extinguisher Types</h3>
                    <p class="card-description">
                        Access your personal account settings to update your details and change your password.
                    </p>
                </div>
            </div> --}}

        </div>
    </div>
@endsection
@push('css')
    <link href="{{ asset('css/components/menu.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
