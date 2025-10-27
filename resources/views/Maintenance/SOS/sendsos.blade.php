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
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <nav class="breadcrumb-nav">
                <div class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Home</a>
                </div>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>

                <div class="breadcrumb-item active">
                    <span>Accident Reports</span>
                </div>
            </nav>
        </div>

        <form action="{{ route('maintenance.SubmitSOSReport') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header text-white d-flex align-items-center py-3"
                            style="background-color: #a91d1d;">
                            <i class="fa-solid fa-circle-exclamation me-2"></i>
                            <h5 class="mb-0">Accident Details</h5>
                        </div>
                        <div class="card-body px-4">
                            <div class="form-floating mb-3">
                                <input id="location" type="text" name="location" class="form-control"
                                    placeholder="Location" required>
                                <label for="location">Location <span class="text-danger">*</span></label>
                            </div>

                            <div class="form-floating mb-3">
                                <textarea id="description" name="description" class="form-control" style="height: 120px" placeholder="Description"
                                    required></textarea>
                                <label for="description">Description <span class="text-danger">*</span></label>
                            </div>

                            <div class="form-floating mb-3">
                                <input id="image" type="file" name="image" class="form-control" accept="image/*"
                                    required>
                                <label for="image">Upload Image (Optional)</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12 col-lg-6">
                    <button type="submit" class="btn red-btn mt-2 w-100">
                        <i class="fa-solid fa-paper-plane"></i> Submit Accident Report
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('css')
    <link href="{{ asset('css/custom.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/components/submenu.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
