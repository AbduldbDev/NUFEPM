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
                    <span>Inspection Guide</span>
                </div>
            </nav>
        </div>
        <div class="menu-grid">
            <div class="menu-card">
                <a href="{{ url('Guide/Management/type/Fire_Hose') }}" class="card-link"></a>
                <div class="card-body">
                    <div class="card-icon-container">
                        <div class="card-icon">
                            <i class="fa-solid fa-fire-extinguisher"></i>
                        </div>
                    </div>
                    <h3 class="card-title">Fire Hose</h3>
                    <p class="card-description">
                        Locate fire hoses and learn proper usage for quick fire response.
                    </p>
                </div>
            </div>

            <div class="menu-card">
                <a href="{{ url('Guide/Management/type/Extinguisher') }}" class="card-link"></a>
                <div class="card-body">
                    <div class="card-icon-container">
                        <div class="card-icon">
                            <i class="fa-solid fa-fire-extinguisher"></i>
                        </div>
                    </div>
                    <h3 class="card-title">Fire Extinguisher</h3>
                    <p class="card-description">
                        Access information about fire extinguisher locations and proper operation techniques.
                    </p>
                </div>
            </div>

            <div class="menu-card">
                <a href="{{ url('Guide/Management/type/Emergency_Lights') }}" class="card-link"></a>
                <div class="card-body">
                    <div class="card-icon-container">
                        <div class="card-icon">
                            <i class="fa-solid fa-lightbulb"></i>
                        </div>
                    </div>
                    <h3 class="card-title">Emergency Lights</h3>
                    <p class="card-description">
                        Check the placement and function of emergency lighting during power outages.
                    </p>
                </div>
            </div>

            <div class="menu-card">
                <a href="{{ url('Guide/Management/type/Sprinklers') }}" class="card-link"></a>
                <div class="card-body">
                    <div class="card-icon-container">
                        <div class="card-icon">
                            <i class="fa-solid fa-shower"></i>
                        </div>
                    </div>
                    <h3 class="card-title">Sprinklers</h3>
                    <p class="card-description">
                        Review sprinkler system layouts and automatic activation guidelines.
                    </p>
                </div>
            </div>

            <div class="menu-card">
                <a href="{{ url('Guide/Management/type/Smoke_Detector') }}" class="card-link"></a>
                <div class="card-body">
                    <div class="card-icon-container">
                        <div class="card-icon">
                            <i class="fa-solid fa-smog"></i>
                        </div>
                    </div>
                    <h3 class="card-title">Smoke Detector</h3>
                    <p class="card-description">
                        Learn about smoke detector maintenance and testing schedules.
                    </p>
                </div>
            </div>

            <div class="menu-card">
                <a href="{{ url('Guide/Management/type/Fire_Alarm') }}" class="card-link"></a>
                <div class="card-body">
                    <div class="card-icon-container">
                        <div class="card-icon">
                            <i class="fa-solid fa-bell"></i>
                        </div>
                    </div>
                    <h3 class="card-title">Fire Alarm</h3>
                    <p class="card-description">
                        Locate fire alarms and understand the procedure when an alarm is activated.
                    </p>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('css')
    <link href="{{ asset('css/components/menu.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
