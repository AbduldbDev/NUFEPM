@extends('layouts.app')
@section('content')
    <div class="container main-container">
        <div class="breadcrumb-container">
            <div class="breadcrumb-back">
                <a href="javascript:history.back()" class="back-button">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
            </div>
            <div class="breadcrumb-icon">
                <i class="fa-solid fa-file-export"></i>
            </div>
            <nav class="breadcrumb-nav">
                <div class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Home</a>
                </div>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <div class="breadcrumb-item active">
                    <span>Export Logs</span>
                </div>
            </nav>
        </div>
        <div class="menu-grid">

            <div class="menu-card">
                <a href="{{ route('admin.ShowExportExtinguisher') }}" class="card-link"></a>
                <div class="card-body">
                    <div class="card-icon-container">
                        <div class="card-icon">
                            <i class="fa-solid fa-fire-extinguisher"></i>
                        </div>
                    </div>
                    <h3 class="card-title">Extinguishers</h3>
                    <p class="card-description">
                        Export inspection and expiration logs for all fire extinguishers.
                    </p>
                </div>
            </div>

            <div class="menu-card">
                <a href="{{ route('admin.ShowExportDevices') }}" class="card-link"></a>
                <div class="card-body">
                    <div class="card-icon-container">
                        <div class="card-icon">
                            <i class="fa-solid fa-microchip"></i>
                        </div>
                    </div>
                    <h3 class="card-title">Devices</h3>
                    <p class="card-description">
                        Generate logs for fire safety devices maintenance records.
                    </p>
                </div>
            </div>

            <div class="menu-card">
                <a href="{{ route('admin.ShowExportIncident') }}" class="card-link"></a>
                <div class="card-body">
                    <div class="card-icon-container">
                        <div class="card-icon">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                        </div>
                    </div>
                    <h3 class="card-title">Incident Reports</h3>
                    <p class="card-description">
                        Export emergency incident reports submitted by users for quick action.
                    </p>
                </div>
            </div>

            <div class="menu-card">
                <a href="{{ route('admin.ShowExportRefill') }}" class="card-link"></a>
                <div class="card-body">
                    <div class="card-icon-container">
                        <div class="card-icon">
                            <i class="fa-solid fa-sync-alt"></i>
                        </div>
                    </div>
                    <h3 class="card-title">Refill Logs</h3>
                    <p class="card-description">
                        View and export refill Logs records for safety equipment.
                    </p>
                </div>
            </div>

        </div>

    </div>
@endsection
@push('css')
    <link href="{{ asset('css/components/menu.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
