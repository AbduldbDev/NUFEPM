@extends('layouts.app')

@section('content')
    <div class="container mt-5 d-flex justify-content-center align-items-center animated-container">
        <div class="card shadow-lg border-0 rounded-4 p-3 text-center w-100" style="max-width: 500px;">
            <div class="card-body">

                <!-- Animated Check Icon -->
                <div class="mb-4">
                    <i class="fa-solid fa-circle-check text-success display-3 bounce-icon"></i>
                </div>

                <!-- Message -->
                <h3 class="text-success fw-bold mb-3">Inspection Submitted!</h3>
                <p class="text-muted mb-4">
                    The inspection was recorded successfully. You may now return to the dashboard.
                </p>

                <!-- Button -->
                <a href="{{ route('dashboard') }}" class="btn add-new-btn w-100">
                    <i class="fa-solid fa-house me-2"></i> Go to Dashboard
                </a>

            </div>
        </div>
    </div>
@endsection

@push('css')
    <link href="{{ asset('css/custom.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/components/submenu.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
