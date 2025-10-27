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
                <i class="fa-solid  fa-school-flag"></i>
            </div>
            <nav class="breadcrumb-nav">
                <div class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Home</a>
                </div>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <div class="breadcrumb-item active">
                    <span>Locations</span>
                </div>
            </nav>
        </div>
        <div class="menu-grid">
            <div class="menu-card">
                <a href="{{ url('Locations/building/Education Building') }}" class="card-link"></a>
                <div class="card-body">
                    <div class="card-icon-container">
                        <div class="card-icon">
                            <i class="fa-solid fa-school"></i>
                        </div>
                    </div>
                    <h3 class="card-title">Education Building</h3>
                    <p class="card-description">
                        Access the evacuation plan for the Education Building, including emergency exits and assembly
                        points.
                    </p>
                </div>
            </div>

            <div class="menu-card">
                <a href="{{ url('Locations/building/Sports Academy Building') }}" class="card-link"></a>
                <div class="card-body">
                    <div class="card-icon-container">
                        <div class="card-icon">
                            <i class="fa-solid fa-dumbbell"></i>
                        </div>
                    </div>
                    <h3 class="card-title">Sports Academy Building</h3>
                    <p class="card-description">
                        View the evacuation plan for the INSPIRE Sports Academy Building with safety guidelines.
                    </p>
                </div>
            </div>

            <div class="menu-card">
                <a href="{{ url('Locations/building/Dormitel Building') }}" class="card-link"></a>
                <div class="card-body">
                    <div class="card-icon-container">
                        <div class="card-icon">
                            <i class="fa-solid fa-bed"></i>
                        </div>
                    </div>
                    <h3 class="card-title">Dormitel Building</h3>
                    <p class="card-description">
                        Access the evacuation plan for the Dormitel Building, including emergency procedures.
                    </p>
                </div>
            </div>

            <div class="menu-card">
                <a href="{{ url('Locations/building/AGETAC Building') }}" class="card-link"></a>
                <div class="card-body">
                    <div class="card-icon-container">
                        <div class="card-icon">
                            <i class="fa-solid fa-flask"></i>
                        </div>
                    </div>
                    <h3 class="card-title">AGETAC Building</h3>
                    <p class="card-description">
                        View the evacuation plan for the AGETAC Building with specialized safety instructions.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <link href="{{ asset('css/components/menu.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
