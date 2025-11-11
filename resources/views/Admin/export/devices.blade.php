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
                <i class="fa-solid fa-file-export"></i>
            </div>
            <div class="breadcrumb-nav">
                <div class="breadcrumb-item">
                    <a href="{{ route('admin.ShowAdminInspectionMenu') }}">Inspections</a>
                </div>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <div class="breadcrumb-item">
                    <a href="{{ url('/Export/Menu/Logs') }}">Export Logs</a>
                </div>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <div class="breadcrumb-item active">
                    <span>Extinguishers</span>
                </div>
            </div>
        </div>
    </div>
    <div class="container my-5">
        <div class="row">
            <div class="col-12 col-lg-6 p-4 rounded shadow bg-white">
                <h5 class="mb-4 fw-semibold text-center">
                    <i class="fas fa-file-export me-2 " style="color: #35408e"></i> Export Devices Logs
                </h5>

                <!-- Export by Date -->
                <div class="border rounded p-3 mb-4 bg-light">
                    <h6 class="fw-semibold mb-3">
                        <i class="bi bi-calendar-date text-dark me-2"></i> Export by Date Range
                    </h6>
                    <form action="{{ route('export.exportNearExpiryCertificates') }}" method="GET"
                        class="row g-3 align-items-end">
                        <div class="col-12 col-md-6">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" id="start_date" name="start_date" class="form-control" required>
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" id="end_date" name="end_date" class="form-control" required>
                        </div>

                        <div class="col-12 d-grid">
                            <button type="submit" class="btn add-new-btn">
                                <i class="fas fa-file-excel me-2"></i> Export to Excel
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Export Near Expiration -->
                <div class="border rounded p-3 mb-4 bg-light">
                    <h6 class="fw-semibold mb-3">
                        <i class="bi bi-exclamation-triangle-fill text-warning me-2"></i> All Equipments
                    </h6>
                    <form action="{{ route('export.exportAllEquipment') }}" method="GET">
                        <button type="submit" class="btn save-btn w-100 text-white fw-semibold">
                            <i class="fas fa-file-export me-2"></i> Export All Equipments
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
@push('css')
    <link href="{{ asset('css/custom.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/components/submenu.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
