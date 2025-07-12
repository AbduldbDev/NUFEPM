@extends('layouts.app')
@section('content')
    <div class="pageHeaderDiv">
        <div class="pageHeaderText">Good morning, welcome to your control center!</div>
    </div>
    <div class="main-container container">
        <div class="title">
            <span class="menu-title-icon "><i class="fa-solid fa-house-chimney"></i></span> &nbsp;
            <span class="menu-title">Home</span>
        </div>

        <hr>
        <div class="menu-container">
            <div class="menu-box">
                <a href="{{ route('admin.ShowExtinguishersMenu') }}" class="menu-box-link"></a>
                <div class="row">
                    <div class="col-sm-12 col-md-2">
                        <div class="menu-icon"><i class="fa-solid fa-fire-extinguisher"></i></div>
                    </div>
                    <div class="col-sm-12 col-md-10">
                        <div class="passport-title user-link">
                            <span class="module-name"><i class="far fa-folder"></i> Fire Extinguisher</span>
                        </div>
                        <div class="module-description small text-muted">
                            Organize extinguisher entries with full control over their information.
                        </div>
                    </div>
                </div>
            </div>

            <div class="menu-box">
                <a href="/inspection-records" class="menu-box-link"></a>
                <div class="row">
                    <div class="col-sm-12 col-md-2">
                        <div class="menu-icon"><i class="fa fa-list"></i></div>
                    </div>
                    <div class="col-sm-12 col-md-10">
                        <div class="passport-title user-link">
                            <span class="module-name"><i class="far fa-folder"></i> Inspection Records</span>
                        </div>
                        <div class="module-description small text-muted">
                            Organize maintenance logs, inspection results, and predictive records for complete tracking.
                        </div>
                    </div>
                </div>
            </div>

            <div class="menu-box">
                <a href="{{ route('admin.ShowAccountsMenu') }}" class="menu-box-link"></a>
                <div class="row">
                    <div class="col-sm-12 col-md-2">
                        <div class="menu-icon"><i class="fa-solid fa-users"></i></div>
                    </div>
                    <div class="col-sm-12 col-md-10">
                        <div class="passport-title user-link">
                            <span class="module-name"><i class="far fa-folder"></i> User Accounts</span>
                        </div>
                        <div class="module-description small text-muted">
                            Organize user accounts with full control over access, roles, and credentials.
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('css')
    <link href="{{ asset('css/components/menu.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
