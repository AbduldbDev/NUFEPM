@extends('layouts.app')
@section('content')
    <div class="main-container container">
        <div class="title">
            <span class="menu-title-icon"><i class="fa-solid fa-users"></i></span> &nbsp;
            <span class="crumb">
                <span class="breadcrumbs"><a href="{{ route('dashboard') }}">Home</a> &gt; </span>
            </span>
            <span class="crumb">
                <span class="breadcrumbs"><a href="{{ route('admin.ShowAccountsMenu') }}">Accounts</a> &gt; </span>
            </span>
            <span class="breadcrumbs">My Profile </span>
        </div>
        <hr>

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
            <div class="info-header mt-2 mt-lg-5">
                <div class="row">
                    <div class="col-md-3 col-sm-4 col-xs-12  text-center">
                        @if (Auth::user()->image)
                            <img class="w-100" src="{{ asset('/storage/' . Auth::user()->image) }}" alt="">
                        @else
                            <img class="w-100 " class="profile-pic" src="{{ asset('/Image/profile.webp') }}"
                                alt="User Image">
                        @endif

                    </div>
                    <div class="col-md-9 col-sm-8 col-xs-12">
                        <div class="fullname">{{ Auth::user()->lname }} {{ Auth::user()->suffix }},
                            {{ Auth::user()->fname }} {{ Auth::user()->mname }}<br><span class="lead">
                        </div>
                        <table class="table table-profile borderless">
                            <tbody>
                                <tr>
                                    <td class="text-success"><i class="fa fa-id-card-alt"></i> &nbsp; ID Number</td>
                                    <td>{{ Auth::user()->uid }}</td>
                                </tr>
                                <tr>
                                    <td class="text-success"><i class="fa fa-building"></i> &nbsp; &nbsp;Dept. Role</td>
                                    <td class="text-capitalize">{{ Auth::user()->type }}</td>
                                </tr>
                                <tr>
                                    <td class="text-success"><i class="fa fa-envelope"></i> &nbsp; Email Address</td>
                                    <td>{{ Auth::user()->email }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="form-container shadow-sm">
                <h1 class="form-title mb-4"><i class="fa-solid fa-circle-info"></i> Basic Information</h1>
                <hr>

                <div class="row mb-3">
                    <div class="col-md-12 col-lg-6  mb-3 mb-md-0">
                        <div class="row align-items-center">
                            <label for="fname" class="col-md-4 col-form-label">First Name:<span
                                    class="required">*</span></label>
                            <div class="col-md-8">
                                <input type="text" id="fname" name="fname" class="form-control" readonly
                                    value="{{ Auth::user()->fname }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 ">
                        <div class="row align-items-center">
                            <label for="mname" class="col-md-4 col-form-label">Middle Name:</label>
                            <div class="col-md-8">
                                <input type="text" id="mname" name="mname" class="form-control" readonly
                                    value="{{ Auth::user()->mname }}">
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
                                <input type="text" id="lname" name="lname" class="form-control" readonly
                                    value="{{ Auth::user()->lname }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 ">
                        <div class="row align-items-center">
                            <label for="suffix" class="col-md-4 col-form-label">Suffix: </label>
                            <div class="col-md-8">
                                <input type="text" id="suffix" name="suffix" class="form-control"
                                    value="{{ Auth::user()->suffix }}" readonly>
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
                                <input type="text" id="gender" name="gender" class="form-control text-capitalize"
                                    readonly value="{{ Auth::user()->gender }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6  mb-3 mb-md-0">
                        <div class="row align-items-center">
                            <label for="phone" class="col-md-4 col-form-label">Contact No.:<span
                                    class="required">*</span></label>
                            <div class="col-md-8">
                                <input type="text" id="phone" name="phone" class="form-control" readonly
                                    value="{{ Auth::user()->phone }}">
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
                                <input type="text" id="province" name="province" class="form-control" readonly
                                    value="{{ $part5 }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 ">
                        <div class="row align-items-center">
                            <label for="city" class="col-md-4 col-form-label">City:<span
                                    class="required">*</span></label>
                            <div class="col-md-8">
                                <input type="text" id="city" name="city" class="form-control" readonly
                                    value="{{ $part4 }}">
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
                                <input type="text" id="barangay" name="barangay" class="form-control" readonly
                                    value="{{ $part3 }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 mb-3 mb-md-0">
                        <div class="row align-items-center">
                            <label for="street" class="col-md-4 col-form-label">Street:<span
                                    class="required">*</span></label>
                            <div class="col-md-8">
                                <input type="text" id="street" name="street" class="form-control" readonly
                                    value="{{ $part2 }}">
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
                                <input type="text" id="house" name="house" class="form-control" readonly
                                    value="{{ $part1 }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 mb-3 mb-md-0">
                        <div class="row align-items-center">
                            <label for="postal" class="col-md-4 col-form-label">Postal:<span
                                    class="required">*</span></label>
                            <div class="col-md-8">
                                <input type="text" id="postal" name="postal" class="form-control" readonly
                                    value="{{ $part6 }}">
                            </div>
                        </div>
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
