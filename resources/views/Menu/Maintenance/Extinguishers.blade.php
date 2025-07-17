@extends('layouts.app')
@section('content')
    <div class="main-container container">
        <div class="title">
            <span class="menu-title-icon"><i class="fa-solid fa-fire-extinguisher"></i></span> &nbsp;
            <span class="crumb"><span class="breadcrumbs"><a href="{{ route('dashboard') }}">Home</a> &gt;
                </span><span class="breadcrumbs">Extinguishers</span></span>
        </div>
        <hr>
        <div class="menu-container">

            <div class="menu-box">
                <a href="{{ route('maintenance.ShowRecentInspected') }}" class="menu-box-link"></a>
                <div class="row">
                    <div class="col-sm-12 col-md-2">
                        <div class="menu-icon"><i class="fa-solid fa-file-circle-plus"></i></div>
                    </div>
                    <div class="col-sm-12 col-md-10">
                        <div class="passport-title user-link">
                            <span class="module-name">My Recent Inspections</span>
                        </div>
                        <div class="module-description small text-muted">
                            View the latest fire extinguisher inspection records conducted in the system.
                        </div>
                    </div>
                </div>
            </div>

            <div class="menu-box">
                <a href="{{ route('maintenance.ShowNearInspection') }}" class="menu-box-link"></a>
                <div class="row">
                    <div class="col-sm-12 col-md-2">
                        <div class="menu-icon"><i class="fa-solid fa-file-circle-plus"></i></div>
                    </div>
                    <div class="col-sm-12 col-md-10">
                        <div class="passport-title user-link">
                            <span class="module-name">Upcoming Inspections</span>
                        </div>
                        <div class="module-description small text-muted">
                            Check extinguishers that are due for inspection soon or within the next few days.
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="menu-box">
                <a href="{{ route('maintenance.ShowNearInspection') }}" class="menu-box-link"></a>
                <div class="row">
                    <div class="col-sm-12 col-md-2">
                        <div class="menu-icon"><i class="fa-solid fa-file-circle-plus"></i></div>
                    </div>
                    <div class="col-sm-12 col-md-10">
                        <div class="passport-title user-link">
                            <span class="module-name">Refill Inspections</span>
                        </div>
                        <div class="module-description small text-muted">
                            Check extinguishers that are due for inspection soon or within the next few days.
                        </div>
                    </div>
                </div>
            </div> --}}

        </div>
    </div>
@endsection
@push('css')
    <link href="{{ asset('css/components/submenu.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
