@extends('layouts.app')
@section('content')
    @include('layouts.components.alerts')
    <div class="main-container container">
        <div class="title">
            <span class="menu-title-icon"><i class="fa-solid fa-file-export"></i></span> &nbsp;
            <span class="crumb">
                <span class="breadcrumbs"><a href="{{ route('admin.ShowAdminInspectionMenu') }}">Inspections</a> &gt;
                </span>
            </span>
            <span class="breadcrumbs">Export</span>
        </div>
        <hr>
    </div>
    <div class="container my-4">
        <div class="row ">
            <div class="col-12 col-lg-6 p-4 rounded shadow bg-white">
                <h5 class="mb-4 fw-semibold ">Export Inspection Logs by Date</h5>

                <form action="{{ route('inspections.export') }}" method="GET" class="row g-3 align-items-end">
                    <div class="col-12 ">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" id="start_date" name="start_date" class="form-control" required>
                    </div>

                    <div class="col-12 ">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" id="end_date" name="end_date" class="form-control" required>
                    </div>

                    <div class="col-12 d-grid">
                        <button type="submit" class="btn add-new-btn">
                            <i class="fas fa-file-export me-2"></i> Export to Excel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <link href="{{ asset('css/custom.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/components/submenu.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
