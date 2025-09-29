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
                <i class="bi bi-telephone-fill"></i>
            </div>
            <nav class="breadcrumb-nav">
                <div class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Home</a>
                </div>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <div class="breadcrumb-item active">
                    <span>Emergency Hotlines</span>
                </div>
            </nav>
        </div>

        <header class="custom-bg-primary text-white text-center py-4 py-md-5 mb-4 rounded">

            <h1 class="fw-bold display-6 mb-2 mb-md-3">Emergency Hotlines</h1>
            <p class="lead mb-2 mb-md-3">Important Contact Numbers for Emergency Situations</p>
            <p class="mb-0">Save these numbers for quick access during emergencies</p>
        </header>

        <div class="card custom-card mb-4 border-0">
            <div class="card-header custom-bg-primary text-white text-center py-3 py-md-4">
                <h3 class="h4 mb-0 fw-bold">Emergency Contact Numbers</h3>
            </div>
            <div class="card-body p-4 p-md-5">

                @foreach ($contents as $location => $hotlines)
                    <div class="hotline-section mb-5">
                        <h3 class="h3 fw-bold custom-text-primary mb-4 pb-2 border-bottom">
                            <i class="bi bi-geo-alt-fill me-2"></i>{{ strtoupper($location) }}
                        </h3>
                        <div class="row g-3 g-md-4">
                            @foreach ($hotlines as $hotline)
                                <div class="col-12 col-sm-6 col-lg-4">
                                    <a href="tel:{{ $hotline->number }}" class="hotline-link">
                                        <div class="hotline-item custom-bg-primary-light p-3 rounded">
                                            <div class="hotline-number fw-bold custom-text-primary">{{ $hotline->number }}
                                            </div>
                                            <div class="hotline-label">{{ $hotline->label }}</div>
                                            <div class="hotline-call-hint">Tap to call</div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                <div class="custom-bg-primary-light p-3 rounded">
                    <h3 class="h6 fw-bold custom-text-primary mb-2">
                        <i class="bi bi-info-circle me-2"></i>Emergency Tips
                    </h3>
                    <div class="checklist-item  py-1">
                        <i class="bi bi-check-circle-fill me-2"></i> Stay calm and speak clearly when calling
                    </div>
                    <div class="checklist-item  py-1">
                        <i class="bi bi-check-circle-fill me-2"></i> Provide your exact location and nature of emergency
                    </div>
                    <div class="checklist-item  py-1">
                        <i class="bi bi-check-circle-fill me-2"></i> Keep these numbers saved in your phone
                    </div>
                    <div class="checklist-item  py-1">
                        <i class="bi bi-check-circle-fill me-2"></i> Post these numbers in visible areas at home/work
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link href="{{ asset('css/components/menu.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/components/inspectionguide.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/components/hotlines.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
