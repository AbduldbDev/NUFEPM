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
                <i class="fa-solid fa-qrcode"></i>
            </div>
            <nav class="breadcrumb-nav">
                <div class="breadcrumb-item">
                    <span class="breadcrumbs"><a href="{{ route('dashboard') }}">Home</a> </span>
                </div>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <div class="breadcrumb-item active">
                    Scanner
                </div>
            </nav>
        </div>
        <div class="scanner-container">
            <div class="scanner-box">
                <div id="reader" class="animated-container">
                    <div class="scan-animation">
                        <div class="corner corner-tl"></div>
                        <div class="corner corner-tr"></div>
                        <div class="corner corner-bl"></div>
                        <div class="corner corner-br"></div>
                        <div class="scan-line"></div>
                    </div>

                    <div id="loadingSpinner">
                        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                            <span class="visually-hidden">Loading camera...</span>
                        </div>
                        <p class="spinner-text">Initializing camera...</p>
                    </div>
                </div>
            </div>
        </div>

        <div id="error" class="status-card" style="display: none;">
            <div class="status-header">
                <div class="status-icon error">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <h3 class="status-title">Scanner Error</h3>
            </div>
            <div class="status-content">
                <p id="errorMessage"></p>
                <div class="permission-help">
                    <h5>Need help with camera permissions?</h5>
                    <ul>
                        <li>Check if your browser has camera access permissions</li>
                        <li>Make sure no other application is using your camera</li>
                        <li>Try refreshing the page and allowing camera access when prompted</li>
                    </ul>
                </div>
            </div>
        </div>

        <div id="scannerStatus" class="status-card">
            <div class="status-header">
                <div class="status-icon info">
                    <i class="fa-solid fa-info-circle"></i>
                </div>
                <h3 class="status-title">Scanner Ready</h3>
            </div>
            <div class="status-content">
                <p>Scanner will start automatically. Position the QR code within the frame for automatic detection.</p>
            </div>
        </div>

        <div class="instructions">
            <h4>How to scan</h4>
            <p>1. Position the QR code in the center of the frame</p>
            <p>2. Keep the code steady until it's recognized</p>
            <p>3. The scanner will automatically redirect you after scanning</p>
        </div>
    </div>

    <script src="{{ asset('js/Scanner/scanner.js') }}"></script>
@endsection
@push('css')
    <link href="{{ asset('css/components/submenu.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/components/scanner.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
