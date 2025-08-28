@extends('layouts.app')
@section('content')
    <div class="main-container container">
        <div class="breadcrumb-container">
            <div class="breadcrumb-icon">
                <i class="fa fa-list"></i>
            </div>
            <nav class="breadcrumb-nav">
                <div class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Home</a>
                </div>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <div class="breadcrumb-item active">
                    <span>Inspection Records</span>
                </div>
            </nav>
        </div>

        <div class="menu-grid">
            <div class="menu-card">
                <a href="{{ route('admin.ShowRecentLogs') }}" class="card-link"></a>
                <div class="card-body">
                    <div class="card-icon-container">
                        <div class="card-icon">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                        </div>
                    </div>
                    <h3 class="card-title">Recent Logs</h3>
                    <p class="card-description">
                        View the most recent fire extinguisher inspections and activity.

                    </p>
                </div>
            </div>

            <div class="menu-card">

                <a href="{{ route('admin.ShowInspectionExtinguishers') }}" class="card-link"></a>
                <div class="card-body">
                    <div class="card-icon-container">
                        <div class="card-icon">
                            <i class="fa-solid fa-fire-extinguisher"></i>
                        </div>
                    </div>
                    <h3 class="card-title">Extinguisher Inspections</h3>
                    <p class="card-description">
                        View each fire extinguisher with its inspection logs.
                    </p>
                </div>
            </div>

            <div class="menu-card">

                <a href="{{ route('admin.ShowAllRefills') }}" class="card-link"></a>
                <div class="card-body">
                    <div class="card-icon-container">
                        <div class="card-icon">
                            <i class="fa-solid fa-fire-extinguisher"></i>
                        </div>
                    </div>
                    <h3 class="card-title">Refill Logs </h3>
                    <p class="card-description">
                        Track and review the refill history of each fire extinguisher, including dates, personnel, and
                        remarks.
                    </p>
                </div>
            </div>

            <div class="menu-card">

                <a href="{{ route('admin.ShowExportForm') }}" class="card-link"></a>
                <div class="card-body">
                    <div class="card-icon-container">
                        <div class="card-icon">
                            <i class="fa-solid fa-file-export"></i>
                        </div>
                    </div>
                    <h3 class="card-title">Export Logs</h3>
                    <p class="card-description">
                        Download fire extinguisher logs for reporting or backup purposes.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <link href="{{ asset('css/components/menu.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
