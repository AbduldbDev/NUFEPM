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
                <a href="{{ route('maintenance.ShowRecentInspected') }}" class="card-link"></a>
                <div class="card-body">
                    <div class="card-icon-container">
                        <div class="card-icon">
                            <i class="fa-solid fa-file-circle-plus"></i>
                        </div>
                    </div>
                    <h3 class="card-title">My Recent Inspections</h3>
                    <p class="card-description">
                        View the latest fire equipment inspection records conducted in the system.
                    </p>
                </div>
            </div>

            <div class="menu-card">
                <a href="{{ route('maintenance.ShowNearInspection') }}" class="card-link"></a>
                <div class="card-body">
                    <div class="card-icon-container">
                        <div class="card-icon">
                            <i class="fa-solid fa-file-circle-plus"></i>
                        </div>
                    </div>
                    <h3 class="card-title">Upcoming Inspections</h3>
                    <p class="card-description">
                        Check fire equipment scheduled for inspection soon or within the next few days.
                    </p>
                </div>
            </div>

            {{-- <div class="menu-box">
                <a href="{{ route('maintenance.ShowNearInspection') }}" class="menu-box-link"></a>
                <div class="row">
                    <div class="col-sm-12 col-md-2">
                        <div class="menu-icon"><i class="fa-solid fa-file-circle-plus"></i></div>
                    </div>
                    <div class="col-sm-12 col-md-10">
                        <div class="passport-title user-link">
                            <span class="module-name">Refill Inspections</span>
                        </div>
                        <div class="module-description small text-muted">
                            Check extinguishers that are due for inspection soon or within the next few days.
                        </div>
                    </div>
                </div>
            </div> --}}

        </div>
    </div>
@endsection
@push('css')
    <link href="{{ asset('css/components/menu.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
