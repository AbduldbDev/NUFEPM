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
                <a href="{{ route('admin.ShowAddTankForm') }}" class="menu-box-link"></a>
                <div class="row">
                    <div class="col-sm-12 col-md-2">
                        <div class="menu-icon"><i class="fa-solid fa-file-circle-plus"></i></div>
                    </div>
                    <div class="col-sm-12 col-md-10">
                        <div class="passport-title user-link">
                            <span class="module-name">Add Extinguishers</span>
                        </div>
                        <div class="module-description small text-muted">
                            Register new fire extinguishers and assign QR codes along with their maintenance details and
                            location.
                        </div>
                    </div>
                </div>
            </div>

            <div class="menu-box">
                <a href="{{ route('admin.ShowActiveExtinguishers') }}" class="menu-box-link"></a>
                <div class="row">
                    <div class="col-sm-12 col-md-2">
                        <div class="menu-icon"><i class="fa-solid fa-chart-line"></i></div>
                    </div>
                    <div class="col-sm-12 col-md-10">
                        <div class="passport-title user-link">
                            <span class="module-name">Active Extinguishers</span>
                        </div>
                        <div class="module-description small text-muted">
                            View and manage all currently active fire extinguishers, including their maintenance status and
                            locations.
                        </div>
                    </div>
                </div>
            </div>

            <div class="menu-box">
                <a href="{{ route('admin.ShowActiveExtinguishers') }}" class="menu-box-link"></a>
                <div class="row">
                    <div class="col-sm-12 col-md-2">
                        <div class="menu-icon"><i class="fa-solid fa-box-archive"></i></div>
                    </div>
                    <div class="col-sm-12 col-md-10">
                        <div class="passport-title user-link">
                            <span class="module-name">Retired Extinguishers</span>
                        </div>
                        <div class="module-description small text-muted">
                            Review and track extinguishers that have been decommissioned, replaced, or are no longer in use.
                        </div>
                    </div>
                </div>
            </div>

            <div class="menu-box">
                <a href="{{ route('admin.ShowAllQuestions') }}" class="menu-box-link"></a>
                <div class="row">
                    <div class="col-sm-12 col-md-2">
                        <div class="menu-icon"><i class="fa-solid fa-circle-question"></i></div>
                    </div>
                    <div class="col-sm-12 col-md-10">
                        <div class="passport-title user-link">
                            <span class="module-name">Inspection Questions</span>
                        </div>
                        <div class="module-description small text-muted">
                            Manage and customize inspection questions used for evaluating extinguisher and safety
                            compliance.
                        </div>
                    </div>
                </div>
            </div>

            <div class="menu-box">
                <a href="{{ route('admin.ShowLocations') }}" class="menu-box-link"></a>
                <div class="row">
                    <div class="col-sm-12 col-md-2">
                        <div class="menu-icon"><i class="fa-solid fa-school-flag"></i></div>
                    </div>
                    <div class="col-sm-12 col-md-10">
                        <div class="passport-title user-link">
                            <span class="module-name">Extinguisher Locations</span>
                        </div>
                        <div class="module-description small text-muted">
                            Access your personal account settings to update your details and change your password.
                        </div>
                    </div>
                </div>
            </div>

            <div class="menu-box">
                <a href="{{ route('admin.ShowTypes') }}" class="menu-box-link"></a>
                <div class="row">
                    <div class="col-sm-12 col-md-2">
                        <div class="menu-icon"><i class="fa-solid fa-fire-extinguisher"></i></div>
                    </div>
                    <div class="col-sm-12 col-md-10">
                        <div class="passport-title user-link">
                            <span class="module-name">Extinguisher Types</span>
                        </div>
                        <div class="module-description small text-muted">
                            Access your personal account settings to update your details and change your password.
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
