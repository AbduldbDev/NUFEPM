@extends('layouts.app')
@section('content')
    <div class="container mt-5 d-flex justify-content-center align-items-center animated-container">
        <div class="p-4 mt-5 text-center">
            <div class="card-body">
                <i class="fa-solid fa-circle-check text-success mb-3" style="font-size: 3rem;"></i>
                <h3 class="text-success mb-3">Inspection Submitted!</h3>
                <p class="mb-4">The inspection was recorded successfully. You may now return to the dashboard.</p>

                <a href="{{ route('dashboard') }}" class="btn btn-primary me-2 w-100">
                    <i class="fa-solid fa-house"></i> Go to Dashboard
                </a>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <link href="{{ asset('css/custom.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/components/submenu.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
