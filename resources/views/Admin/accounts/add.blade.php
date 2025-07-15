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
        <h1 class="text-md">Add New User Account</h1>
        <div class="form-container animated-container shadow-sm">
            <form action="{{ route('admin.CreateUser') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h1 class="form-title mb-4"><i class="fa-solid fa-circle-info"></i> Basic Information</h1>
                <hr>
                <div class="row mb-3">
                    <div class="col-md-12 col-lg-6  mb-3 mb-md-0">
                        <div class="row align-items-center">
                            <label for="uid" class="col-md-4 col-form-label">User ID:<span class="required">*</span>
                            </label>
                            <div class="col-md-8">
                                <input type="text" id="uid" name="uid" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 ">
                        <div class="row align-items-center">
                            <label for="image" class="col-md-4 col-form-label">Profile Image:<span
                                    class="required">*</span></label>
                            <div class="col-md-8">
                                <input type="file" id="image" name="image" class="form-control">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row mb-3">
                    <div class="col-md-12 col-lg-6  mb-3 mb-md-0">
                        <div class="row align-items-center">
                            <label for="fname" class="col-md-4 col-form-label">First Name:<span
                                    class="required">*</span></label>
                            <div class="col-md-8">
                                <input type="text" id="fname" name="fname" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 ">
                        <div class="row align-items-center">
                            <label for="mname" class="col-md-4 col-form-label">Middle Name:</label>
                            <div class="col-md-8">
                                <input type="text" id="mname" name="mname" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12 col-lg-6  mb-3 mb-md-0">
                        <div class="row align-items-center">
                            <label for="lname" class="col-md-4 col-form-label">Last Name: <span
                                    class="required">*</span></label>
                            <div class="col-md-8">
                                <input type="text" id="lname" name="lname" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 ">
                        <div class="row align-items-center">
                            <label for="suffix" class="col-md-4 col-form-label">Suffix: </label>
                            <div class="col-md-8">
                                <input type="text" id="suffix" name="suffix" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12 col-lg-6  mb-3 mb-md-0">
                        <div class="row align-items-center">
                            <label for="gender" class="col-md-4 col-form-label">Gender:<span
                                    class="required">*</span></label>
                            <div class="col-md-8">
                                <select name="gender" id="gender" class="form-select" required>
                                    <option value="">-- Select --</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6  mb-3 mb-md-0">
                        <div class="row align-items-center">
                            <label for="phone" class="col-md-4 col-form-label">Contact No.:<span
                                    class="required">*</span></label>
                            <div class="col-md-8">
                                <input type="text" id="phone" name="phone" class="form-control" required>
                                {{-- <select name="civil" id="civil" class="form-select" required>
                                    <option value="">-- Select --</option>
                                    <option value="single">Single</option>
                                    <option value="married">Married</option>
                                    <option value="widowed">Widowed</option>
                                </select> --}}
                            </div>
                        </div>
                    </div>

                </div>
                <h1 class="form-title mb-4"><i class="fa-solid fa-map-location-dot"></i> Address Information:</h1>
                <hr>

                <div class="row mb-3">
                    <div class="col-md-12 col-lg-6  mb-3 mb-md-0">
                        <div class="row align-items-center">
                            <label for="province" class="col-md-4 col-form-label">State/Province:<span
                                    class="required">*</span></label>
                            <div class="col-md-8">
                                <input type="text" id="province" name="province" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 ">
                        <div class="row align-items-center">
                            <label for="city" class="col-md-4 col-form-label">City:<span
                                    class="required">*</span></label>
                            <div class="col-md-8">
                                <input type="text" id="city" name="city" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12 col-lg-6">
                        <div class="row align-items-center">
                            <label for="barangay" class="col-md-4 col-form-label">Barangay:<span
                                    class="required">*</span></label>
                            <div class="col-md-8">
                                <input type="text" id="barangay" name="barangay" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 mb-3 mb-md-0">
                        <div class="row align-items-center">
                            <label for="street" class="col-md-4 col-form-label">Street:<span
                                    class="required">*</span></label>
                            <div class="col-md-8">
                                <input type="text" id="street" name="street" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12 col-lg-6">
                        <div class="row align-items-center">
                            <label for="house" class="col-md-4 col-form-label">House No.:<span
                                    class="required">*</span></label>
                            <div class="col-md-8">
                                <input type="text" id="house" name="house" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 mb-3 mb-md-0">
                        <div class="row align-items-center">
                            <label for="postal" class="col-md-4 col-form-label">Postal:<span
                                    class="required">*</span></label>
                            <div class="col-md-8">
                                <input type="text" id="postal" name="postal" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <h1 class="form-title mb-4"><i class="fa-solid fa-key"></i> Login Credentials:</h1>
                <hr>
                <div class="row mb-3">
                    <div class="col-md-12 col-lg-6 mb-3 mb-md-0">
                        <div class="row align-items-center">
                            <label for="email" class="col-md-4 col-form-label">Email:<span
                                    class="required">*</span></label>
                            <div class="col-md-8">
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="row align-items-center">
                            <label for="type" class="col-md-4 col-form-label">User Type:<span
                                    class="required">*</span></label>
                            <div class="col-md-8">
                                <select name="type" id="type" class="form-select" required>
                                    <option value="">-- Select --</option>
                                    <option value="admin">Admin</option>
                                    <option value="maintenance">Maintenance</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12 col-lg-6 mb-3 mb-md-0">
                        <div class="row align-items-center">
                            <label for="password" class="col-md-4 col-form-label">Password:<span
                                    class="required">*</span></label>
                            <div class="col-md-8">
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="row align-items-center">
                            <label for="password_confirmation" class="col-md-4 col-form-label">Confirm Password:<span
                                    class="required">*</span></label>
                            <div class="col-md-8">
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-outline-success w-100 w-lg-50 mt-2 mt-lg-5"><i
                            class="fa-solid fa-user-plus"></i> Register User</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('css')
    <link href="{{ asset('css/custom.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/components/submenu.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
