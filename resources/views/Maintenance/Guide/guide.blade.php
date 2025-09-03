@extends('layouts.app')
@section('content')
    <div class="main-container container ">
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
                    <span>Inspection Guide</span>
                </div>
            </nav>
        </div>

        <header class="custom-bg-primary text-white text-center py-4 mb-4 rounded">
            <div class="header-icon mb-2">
                <i class="bi bi-fire-extinguisher"></i>
            </div>
            <h1 class="fw-bold">Fire Extinguisher Inspection</h1>
            <p class="lead mb-2">Complete Step-by-Step Guide</p>
            <p class="mb-0">Follow these steps ensure your fire extinguisher is in proper working condition</p>
        </header>

        <!-- Main Content -->
        <div class="card custom-card mb-4 border-0">
            <div class="card-header custom-bg-primary text-white text-center py-3">
                <h2 class="h5 mb-0 fw-bold">Monthly Inspection Checklist</h2>
            </div>
            <div class="card-body p-4">
                <!-- Checklist -->
                <div class="custom-bg-primary-light p-4 rounded mb-4">
                    <h3 class="h6 fw-bold custom-text-primary mb-3">
                        <i class="bi bi-clipboard-check"></i> Quick Checklist
                    </h3>
                    <div class="checklist-item">
                        <i class="bi bi-check-circle-fill"></i> Pressure gauge in green zone
                    </div>
                    <div class="checklist-item">
                        <i class="bi bi-check-circle-fill"></i> Seal and tamper indicator intact
                    </div>
                    <div class="checklist-item">
                        <i class="bi bi-check-circle-fill"></i> No physical damage or corrosion
                    </div>
                    <div class="checklist-item">
                        <i class="bi bi-check-circle-fill"></i> Easily accessible and visible
                    </div>
                    <div class="checklist-item">
                        <i class="bi bi-check-circle-fill"></i> Inspection tag present and updated
                    </div>
                </div>

                <!-- Steps -->
                <div class="row g-4">
                    @foreach ($contents as $step)
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="card h-100 custom-card border-0">
                                <div class="card-header custom-bg-primary-light d-flex align-items-center py-3">
                                    <div class="step-number">{{ $step->step_number }}</div>
                                    <h3 class="h6 mb-0 fw-bold custom-text-primary">{{ $step->title }}</h3>
                                </div>
                                <div class="card-body">
                                    @if ($step->image_path)
                                        <div class="step-image mb-3">
                                            <img class="step-img" src="{{ asset($step->image_path) }}"
                                                alt="{{ $step->title }}">
                                        </div>
                                    @endif
                                    <p class="card-text">{{ $step->content }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <link href="{{ asset('css/components/menu.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/components/inspectionguide.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
