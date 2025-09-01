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
                    <span>Fire Equipments</span>
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
                    <h3 class="card-title">Add Fire Equipment</h3>
                    <p class="card-description">
                        Add new fire equipment, assign QR codes, and record maintenance details with location.
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
                    <h3 class="card-title">Active Fire Equipment</h3>
                    <p class="card-description">
                        View and manage all currently active fire equipment with their status and assigned locations.
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
                    <h3 class="card-title">Retired Fire Equipment</h3>
                    <p class="card-description">
                        Review fire equipment that has been retired, replaced, or decommissioned from service.
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
