@extends('layouts.app')
@section('content')
    @include('layouts.components.alerts')
    <div class="main-container container">
        <div class="title">
            <span class="menu-title-icon"><i class="fa-solid fa-users"></i></span> &nbsp;
            <span class="crumb">
                <span class="breadcrumbs"><a href="{{ route('dashboard') }}">Home</a> &gt; </span>
            </span>
            <span class="crumb">
                <span class="breadcrumbs"><a href="{{ route('admin.ShowAccountsMenu') }}">Accounts</a> &gt; </span>
            </span>
            <span class="breadcrumbs">Add New </span>
        </div>
        <hr>

        <div class="container animated-container form-container">
            <!-- Add User Title -->
            {{-- <h2 class="fw-bold text-dark mb-4">
                <i class="fa-solid fa-user-plus me-2 text-primary"></i> Add New User Account
            </h2> --}}

            <div class="card border-0 shadow-sm rounded-4 p-4">
                <form action="{{ route('admin.CreateUser') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <h4 class="fw-bold form-title mb-3"><i class="fa-solid fa-circle-info me-2"></i> Basic Information</h4>
                    <hr class="mb-4">

                    <div class="row  g-lg-3 g-2 mb-4">
                        <div class="col-md-6">
                            <label for="uid" class="form-label">User ID <span class="text-danger">*</span></label>
                            <input type="text" id="uid" name="uid" class="form-control" required
                                value="{{ old('uid') }}">
                        </div>

                        <div class="col-md-6">
                            <label for="image" class="form-label">Profile Image <span
                                    class="text-danger">*</span></label>
                            <input type="file" id="image" name="image" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label for="fname" class="form-label">First Name <span class="text-danger">*</span></label>
                            <input type="text" id="fname" name="fname" class="form-control" required
                                value="{{ old('fname') }}">
                        </div>

                        <div class="col-md-6">
                            <label for="mname" class="form-label">Middle Name</label>
                            <input type="text" id="mname" name="mname" class="form-control"
                                value="{{ old('mname') }}">
                        </div>

                        <div class="col-md-6">
                            <label for="lname" class="form-label">Last Name <span class="text-danger">*</span></label>
                            <input type="text" id="lname" name="lname" class="form-control" required
                                value="{{ old('lname') }}">
                        </div>

                        <div class="col-md-6">
                            <label for="suffix" class="form-label">Suffix</label>
                            <input type="text" id="suffix" name="suffix" class="form-control"
                                value="{{ old('suffix') }}">
                        </div>

                        <div class="col-md-6">
                            <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
                            <select name="gender" id="gender" class="form-select" required>
                                <option value="">-- Select --</option>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="phone" class="form-label">Contact No. <span class="text-danger">*</span></label>
                            <input type="text" id="phone" name="phone" class="form-control" required
                                value="{{ old('phone') }}">
                        </div>
                    </div>

                    <h4 class="fw-bold form-title mb-3"><i class="fa-solid fa-map-location-dot me-2"></i> Address
                        Information</h4>
                    <hr class="mb-4">

                    <div class="row  g-lg-3 g-2 mb-4">
                        <div class="col-md-6">
                            <label for="province" class="form-label">State/Province <span
                                    class="text-danger">*</span></label>
                            <input type="text" id="province" name="province" class="form-control" required
                                value="{{ old('province') }}">
                        </div>

                        <div class="col-md-6">
                            <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                            <input type="text" id="city" name="city" class="form-control" required
                                value="{{ old('city') }}">
                        </div>

                        <div class="col-md-6">
                            <label for="barangay" class="form-label">Barangay <span class="text-danger">*</span></label>
                            <input type="text" id="barangay" name="barangay" class="form-control" required
                                value="{{ old('barangay') }}">
                        </div>

                        <div class="col-md-6">
                            <label for="street" class="form-label">Street <span class="text-danger">*</span></label>
                            <input type="text" id="street" name="street" class="form-control" required
                                value="{{ old('street') }}">
                        </div>

                        <div class="col-md-6">
                            <label for="house" class="form-label">House No. <span class="text-danger">*</span></label>
                            <input type="text" id="house" name="house" class="form-control" required
                                value="{{ old('house') }}">
                        </div>

                        <div class="col-md-6">
                            <label for="postal" class="form-label">Postal Code <span
                                    class="text-danger">*</span></label>
                            <input type="text" id="postal" name="postal" class="form-control" required
                                value="{{ old('postal') }}">
                        </div>
                    </div>

                    <h4 class="fw-bold form-title  mb-3"><i class="fa-solid fa-key me-2"></i> Login Credentials</h4>
                    <hr class="mb-4">

                    <div class="row  g-lg-3 g-2 mb-4">
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" id="email" name="email" class="form-control" required
                                value="{{ old('email') }}">
                        </div>

                        <div class="col-md-6">
                            <label for="type" class="form-label">User Type <span class="text-danger">*</span></label>
                            <select name="type" id="type" class="form-select" required>
                                <option value="">-- Select --</option>
                                <option value="admin" {{ old('type') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="maintenance" {{ old('type') == 'maintenance' ? 'selected' : '' }}>
                                    Maintenance</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label">Confirm Password <span
                                    class="text-danger">*</span></label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="form-control" required>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn add-new-btn px-4 py-2 ">
                            <i class="fa-solid fa-user-plus me-1"></i> Register User
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
