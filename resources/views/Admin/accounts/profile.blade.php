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
                <div class="breadcrumb-item">
                    <a href="{{ route('admin.ShowAccountsMenu') }}">Accounts</a>
                </div>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <div class="breadcrumb-item active">
                    <span>My Profile</span>
                </div>
            </nav>
        </div>

        @php
            $string = Auth::user()->address;
            $parts = array_map('trim', explode('|', $string));
            $part1 = $parts[0] ?? '';
            $part2 = $parts[1] ?? '';
            $part3 = $parts[2] ?? '';
            $part4 = $parts[3] ?? '';
            $part5 = $parts[4] ?? '';
            $part6 = $parts[5] ?? '';
        @endphp

        <div class="animated-container">
            <div class="container mt-4">
                <div class="info-header">
                    <div class="row g-4 align-items-center">

                        <div class="col-12 col-md-4 col-lg-3 text-center">
                            @if (Auth::user()->image)
                                <img src="{{ asset('/storage/' . Auth::user()->image) }}"
                                    class="img-fluid rounded-circle profile-img shadow-sm" alt="User Image">
                            @else
                                <img src="{{ asset('/Image/profile.webp') }}" class="img-fluid  profile-img shadow-sm"
                                    alt="Default User Image">
                            @endif
                        </div>

                        <div class="col-12 col-md-8 col-lg-9 bg-white shadow-sm rounded-3 p-4">

                            <h3 class="fw-bold text-dark mb-3">
                                {{ Auth::user()->lname }} {{ Auth::user()->suffix }}, {{ Auth::user()->fname }}
                                {{ Auth::user()->mname }}
                            </h3>
                            <table class="table table-borderless small mb-0">
                                <tbody>
                                    <tr>
                                        <td class="text-success"><i class="fa fa-id-card-alt me-2"></i>ID Number</td>
                                        <td>{{ Auth::user()->uid }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-success"><i class="fa fa-building me-2"></i>Dept. Role</td>
                                        <td class="text-capitalize">{{ Auth::user()->type }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-success"><i class="fa fa-envelope me-2"></i>Email Address</td>
                                        <td>{{ Auth::user()->email }}</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

            <div class="form-container shadow-sm mt-4 p-4 bg-white rounded-3">
                <h4 class="form-title mb-3 form-title"><i class="fa-solid fa-circle-info me-2"></i> Basic Information</h4>
                <hr>

                <div class="row mb-3  g-lg-4 g-2">
                    <div class="col-md-6">
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-control" value="{{ Auth::user()->fname }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Middle Name</label>
                        <input type="text" class="form-control" value="{{ Auth::user()->mname }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-control" value="{{ Auth::user()->lname }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Suffix</label>
                        <input type="text" class="form-control" value="{{ Auth::user()->suffix }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Gender</label>
                        <input type="text" class="form-control text-capitalize" value="{{ Auth::user()->gender }}"
                            readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Contact No.</label>
                        <input type="text" class="form-control" value="{{ Auth::user()->phone }}" readonly>
                    </div>
                </div>

                <h4 class="form-title mb-3 form-title mt-4"><i class="fa-solid fa-map-location-dot me-2"></i> Address
                    Information</h4>
                <hr>

                <div class="row mb-3  g-lg-4 g-2">
                    <div class="col-md-6">
                        <label class="form-label">State/Province</label>
                        <input type="text" class="form-control" value="{{ $part5 }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">City</label>
                        <input type="text" class="form-control" value="{{ $part4 }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Barangay</label>
                        <input type="text" class="form-control" value="{{ $part3 }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Street</label>
                        <input type="text" class="form-control" value="{{ $part2 }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">House No.</label>
                        <input type="text" class="form-control" value="{{ $part1 }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Postal</label>
                        <input type="text" class="form-control" value="{{ $part6 }}" readonly>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('css')
    <link href="{{ asset('css/custom.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/components/submenu.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
