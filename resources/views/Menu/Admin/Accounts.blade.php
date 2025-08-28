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
                <i class="fa-solid fa-users"></i>
            </div>
            <nav class="breadcrumb-nav">
                <div class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Home</a>
                </div>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <div class="breadcrumb-item active">
                    <span>Accounts</span>
                </div>
            </nav>
        </div>

        <div class="menu-grid">
            <div class="menu-card">

                <a href="{{ route('admin.ShowAddUserForm') }}" class="card-link"></a>
                <div class="card-body">
                    <div class="card-icon-container">
                        <div class="card-icon">
                            <i class="fa-solid fa-user-plus"></i>
                        </div>
                    </div>
                    <h3 class="card-title">Add User</h3>
                    <p class="card-description">
                        Add new user accounts and assign roles or permissions as needed.
                    </p>
                </div>
            </div>
            <div class="menu-card">

                <a href="{{ route('admin.ShowAllAccounts') }}" class="card-link"></a>
                <div class="card-body">
                    <div class="card-icon-container">
                        <div class="card-icon">
                            <i class="fa-solid fa-user-plus"></i>
                        </div>
                    </div>
                    <h3 class="card-title">Account Management</h3>
                    <p class="card-description">
                        Manage other user accounts by updating their information or removing access as needed.
                    </p>
                </div>
            </div>

            <div class="menu-card">

                <a href="{{ route('admin.ShowProfile') }}" class="card-link"></a>
                <div class="card-body">
                    <div class="card-icon-container">
                        <div class="card-icon">
                            <i class="fa-solid fa-user"></i>
                        </div>
                    </div>
                    <h3 class="card-title">My Account</h3>
                    <p class="card-description">
                        Access your personal account settings to update your details and change your password.
                    </p>
                </div>
            </div>

            <div class="menu-card">

                <a href="{{ route('admin.ShowChangePassword') }}" class="card-link"></a>
                <div class="card-body">
                    <div class="card-icon-container">
                        <div class="card-icon">
                            <i class="bi bi-person-fill-lock"></i>
                        </div>
                    </div>
                    <h3 class="card-title">Change Password</h3>
                    <p class="card-description">
                        Secure your account by updating your current password. Use a strong, unique password for better
                        protection.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <link href="{{ asset('css/components/menu.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
