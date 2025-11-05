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
                <i class="fa-solid fa-circle-question"></i>
            </div>
            <nav class="breadcrumb-nav">
                <div class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Home</a>
                </div>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <div class="breadcrumb-item active">
                    <span>Questions</span>
                </div>
            </nav>
        </div>

        <div class="menu-grid">
            <div class="menu-card">
                <a href="{{ url('Questions/type/Extinguisher') }}" class="card-link"></a>
                <div class="card-body">
                    <div class="card-icon-container">
                        <div class="card-icon">
                            <i class="fa-solid fa-fire-extinguisher"></i>
                        </div>
                    </div>
                    <h3 class="card-title">Fire Extinguisher</h3>
                    <p class="card-description">
                        Review inspection questions for checking pressure, accessibility, labeling, and overall condition.
                    </p>
                </div>
            </div>

            <div class="menu-card">
                <a href="{{ url('Questions/type/Fire_hose') }}" class="card-link"></a>
                <div class="card-body">
                    <div class="card-icon-container">
                        <div class="card-icon">
                            <i class="fa-solid fa-water"></i>
                        </div>
                    </div>
                    <h3 class="card-title">Fire Hose</h3>
                    <p class="card-description">
                        Review inspection questions for hose condition, nozzle functionality, valve access, and storage
                        readiness.
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
