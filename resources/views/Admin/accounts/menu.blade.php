@extends('layouts.app')
@section('content')
    <div class="main-container container">
        <div class="title">
            <span class="menu-title-icon"><i class="fa-solid fa-users"></i></span> &nbsp;
            <span class="crumb"><span class="breadcrumbs"><a href="{{ route('dashboard') }}">Home</a> &gt;
                </span><span class="breadcrumbs">Accounts</span></span>
        </div>
        <hr>
        <div class="menu-container">
            <div class="menu-box">
                <a href="{{ route('admin.ShowAddUserForm') }}" class="menu-box-link"></a>
                <div class="row">
                    <div class="col-sm-12 col-md-2">
                        <div class="menu-icon"><i class="fa-solid fa-user-plus"></i></div>
                    </div>
                    <div class="col-sm-12 col-md-10">
                        <div class="passport-title user-link">
                            <span class="module-name">Add User</span>
                        </div>
                        <div class="module-description small text-muted">
                            Add new user accounts and assign roles or permissions as needed.

                        </div>
                    </div>
                </div>
            </div>

            <div class="menu-box">
                <a href="{{ route('admin.ShowAllAccounts') }}" class="menu-box-link"></a>
                <div class="row">
                    <div class="col-sm-12 col-md-2">
                        <div class="menu-icon"><i class="fa-solid fa-users-gear"></i></div>
                    </div>
                    <div class="col-sm-12 col-md-10">
                        <div class="passport-title user-link">
                            <span class="module-name">Account Management </span>
                        </div>
                        <div class="module-description small text-muted">
                            Manage other user accounts by updating their information or removing access as needed.

                        </div>
                    </div>
                </div>
            </div>

            <div class="menu-box">
                <a href="{{ route('admin.ShowProfile') }}" class="menu-box-link"></a>
                <div class="row">
                    <div class="col-sm-12 col-md-2">
                        <div class="menu-icon"><i class="fa-solid fa-user"></i></div>
                    </div>
                    <div class="col-sm-12 col-md-10">
                        <div class="passport-title user-link">
                            <span class="module-name">My Account</span>
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
