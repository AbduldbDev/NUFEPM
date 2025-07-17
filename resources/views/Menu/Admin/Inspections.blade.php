@extends('layouts.app')
@section('content')
    <div class="main-container container">
        <div class="title">
            <span class="menu-title-icon"><i class="fa fa-list"></i></span> &nbsp;
            <span class="crumb"><span class="breadcrumbs"><a href="{{ route('dashboard') }}">Home</a> &gt;
                </span><span class="breadcrumbs">Inspection Records</span></span>
        </div>
        <hr>
        <div class="menu-container">
            <div class="menu-box">
                <a href="{{ route('admin.ShowRecentLogs') }}" class="menu-box-link"></a>
                <div class="row">
                    <div class="col-sm-12 col-md-2">
                        <div class="menu-icon"><i class="fa-solid fa-clock-rotate-left"></i></div>
                    </div>
                    <div class="col-sm-12 col-md-10">
                        <div class="passport-title user-link">
                            <span class="module-name">Recent Logs</span>
                        </div>
                        <div class="module-description small text-muted">
                            View the most recent fire extinguisher inspections and activity.

                        </div>
                    </div>
                </div>
            </div>

            <div class="menu-box">
                <a href="{{ route('admin.ShowInspectionExtinguishers') }}" class="menu-box-link"></a>
                <div class="row">
                    <div class="col-sm-12 col-md-2">
                        <div class="menu-icon"><i class="fa-solid fa-fire-extinguisher"></i></div>
                    </div>
                    <div class="col-sm-12 col-md-10">
                        <div class="passport-title user-link">
                            <span class="module-name">Extinguisher Inspections </span>
                        </div>
                        <div class="module-description small text-muted">
                            View each fire extinguisher with its inspection logs.

                        </div>
                    </div>
                </div>
            </div>

            <div class="menu-box">
                <a href="{{ route('admin.ShowExportForm') }}" class="menu-box-link"></a>
                <div class="row">
                    <div class="col-sm-12 col-md-2">
                        <div class="menu-icon"><i class="fa-solid fa-file-export"></i></div>
                    </div>
                    <div class="col-sm-12 col-md-10">
                        <div class="passport-title user-link">
                            <span class="module-name">Export Logs</span>
                        </div>
                        <div class="module-description small text-muted">
                            Download fire extinguisher logs for reporting or backup purposes.
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('css')
    <link href="{{ asset('css/components/submenu.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
