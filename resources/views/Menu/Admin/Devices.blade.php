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
                <i class="fa-solid fa-radiation"></i>
            </div>
            <nav class="breadcrumb-nav">
                <div class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Home</a>
                </div>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <div class="breadcrumb-item active">
                    <span>Devices</span>
                </div>
            </nav>
        </div>
        <div class="menu-grid">
            <div class="menu-card">
                <a href="{{ route('admin.ShowAddForm') }}" class="card-link"></a>
                <div class="card-body">
                    <div class="card-icon-container">
                        <div class="card-icon">
                            <i class="fa-solid fa-radiation"></i>
                        </div>
                    </div>
                    <h3 class="card-title">Add Device</h3>
                    <p class="card-description">
                        Register new safety devices such as smoke detectors and sprinklers, assign their details.
                    </p>
                </div>
            </div>
            <div class="menu-card">
                <a href="{{ route('admin.ShowDevices') }}" class="card-link"></a>
                <div class="card-body">
                    <div class="card-icon-container">
                        <div class="card-icon">
                            <i class="fa-solid fa-radiation"></i>
                        </div>
                    </div>
                    <h3 class="card-title">All Devices</h3>
                    <p class="card-description">
                        Register new safety devices such as smoke detectors and sprinklers, assign their details.
                    </p>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('css')
    <link href="{{ asset('css/components/menu.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
