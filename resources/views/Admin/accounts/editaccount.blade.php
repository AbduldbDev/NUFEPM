@extends('layouts.app')
@section('content')
    @include('layouts.components.alerts')
    <form action="{{ route('admin.UpdateUserAccount') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="main-container container">
            <div class="title">
                <span class="menu-title-icon"><i class="fa-solid fa-users"></i></span> &nbsp;
                <span class="crumb">
                    <span class="breadcrumbs"><a href="{{ route('dashboard') }}">Home</a> &gt; </span>
                </span>
                <span class="crumb">
                    <span class="breadcrumbs"><a href="{{ route('admin.ShowAccountsMenu') }}">Accounts</a> &gt; </span>
                </span>
                <span class="crumb">
                    <span class="breadcrumbs"><a href="{{ route('admin.ShowAllAccounts') }}">All Accounts</a> &gt; </span>
                </span>
                <span class="breadcrumbs">Edit Account </span>
            </div>
            <hr>
            <div class="info-header mt-2 mt-lg-5">
                <div class="row">
                    <div class="col-md-3 col-sm-4 col-xs-12">

                        @if ($details->image)
                            <img width="100%" src="{{ asset('/storage/' . $details->image) }}" alt="">
                        @else
                            <img width="100%" class="profile-pic" src="{{ asset('/Image/profile.webp') }}"
                                alt="User Image">
                        @endif
                    </div>
                    <div class="col-md-9 col-sm-8 col-xs-12">
                        <div class="fullname">{{ $details->lname }} {{ $details->suffix }},
                            {{ $details->fname }} {{ $details->mname }}<br><span class="lead">
                        </div>
                        <table class="table table-profile borderless">
                            <tbody>
                                <tr>
                                    <td class="text-success"><i class="fa fa-id-card-alt"></i> &nbsp; ID Number</td>
                                    <td>{{ $details->uid }}</td>
                                </tr>
                                <tr>
                                    <td class="text-success"><i class="fa fa-building"></i> &nbsp; &nbsp;Dept. Role</td>
                                    <td class="text-capitalize">{{ $details->type }}</td>
                                </tr>
                                <tr>
                                    <td class="text-success"><i class="fa fa-envelope"></i> &nbsp; Email Address</td>
                                    <td>{{ $details->email }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <label for="image" class="col-form-label">Change Image:</label>
                        <input type="file" id="image" name="image" class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-container shadow-sm">

                <input type="hidden" name="id" value="{{ $details->id }}">
                <h1 class="form-title mb-4"><i class="fa-solid fa-circle-info"></i> Basic Information</h1>
                <hr>
                @php
                    $string = $details->address;
                    $parts = array_map('trim', explode('|', $string));
                    $part1 = $parts[0] ?? '';
                    $part2 = $parts[1] ?? '';
                    $part3 = $parts[2] ?? '';
                    $part4 = $parts[3] ?? '';
                    $part5 = $parts[4] ?? '';
                    $part6 = $parts[5] ?? '';
                @endphp

                <div class="row mb-3">
                    <div class="col-md-12 col-lg-6  mb-3 mb-md-0">
                        <div class="row align-items-center">
                            <label for="uid" class="col-md-4 col-form-label">User ID:<span class="required">*</span>
                            </label>
                            <div class="col-md-8">
                                <input type="text" id="uid" name="uid" class="form-control" required
                                    value="{{ $details->uid }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 ">
                        <div class="row align-items-center">
                            <label for="status" class="col-md-4 col-form-label">Status:<span
                                    class="required">*</span></label>
                            <div class="col-md-8">
                                <select name="status" id="status" class="form-select" required>
                                    <option value="">-- Select --</option>
                                    <option value="active" {{ $details->status === 'active' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="inactive" {{ $details->status === 'inactive' ? 'selected' : '' }}>
                                        Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12 col-lg-6 mb-3 mb-md-0">
                        <div class="row align-items-center">
                            <label for="email" class="col-md-4 col-form-label">Email:<span
                                    class="required">*</span></label>
                            <div class="col-md-8">
                                <input type="email" id="email" name="email" class="form-control" required
                                    value="{{ $details->email }}">
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
                                    <option value="admin" {{ $details->type === 'admin' ? 'selected' : '' }}>Admin
                                    </option>
                                    <option value="maintenance" {{ $details->type === 'maintenance' ? 'selected' : '' }}>
                                        Maintenance</option>
                                </select>
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
                                <input type="text" id="fname" name="fname" class="form-control"
                                    value="{{ $details->fname }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 ">
                        <div class="row align-items-center">
                            <label for="mname" class="col-md-4 col-form-label">Middle Name:</label>
                            <div class="col-md-8">
                                <input type="text" id="mname" name="mname" class="form-control"
                                    value="{{ $details->mname }}">
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
                                <input type="text" id="lname" name="lname" class="form-control"
                                    value="{{ $details->lname }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 ">
                        <div class="row align-items-center">
                            <label for="suffix" class="col-md-4 col-form-label">Suffix: </label>
                            <div class="col-md-8">
                                <input type="text" id="suffix" name="suffix" class="form-control"
                                    value="{{ $details->suffix }}">
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
                                    <option value="male" {{ $details->gender === 'male' ? 'selected' : '' }}>Male
                                    </option>
                                    <option value="female" {{ $details->gender === 'female' ? 'selected' : '' }}>Female
                                    </option>
                                    <option value="other" {{ $details->gender === 'other' ? 'selected' : '' }}>Other
                                    </option>
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6  mb-3 mb-md-0">
                        <div class="row align-items-center">
                            <label for="phone" class="col-md-4 col-form-label">Contact No.:<span
                                    class="required">*</span></label>
                            <div class="col-md-8">
                                <input type="text" id="phone" name="phone" class="form-control"
                                    value="{{ $details->phone }}">
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
                                <input type="text" id="province" name="province" class="form-control"
                                    value="{{ $part5 }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 ">
                        <div class="row align-items-center">
                            <label for="city" class="col-md-4 col-form-label">City:<span
                                    class="required">*</span></label>
                            <div class="col-md-8">
                                <input type="text" id="city" name="city" class="form-control"
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
                                <input type="text" id="barangay" name="barangay" class="form-control"
                                    value="{{ $part3 }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 mb-3 mb-md-0">
                        <div class="row align-items-center">
                            <label for="street" class="col-md-4 col-form-label">Street:<span
                                    class="required">*</span></label>
                            <div class="col-md-8">
                                <input type="text" id="street" name="street" class="form-control"
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
                                <input type="text" id="house" name="house" class="form-control"
                                    value="{{ $part1 }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 mb-3 mb-md-0">
                        <div class="row align-items-center">
                            <label for="postal" class="col-md-4 col-form-label">Postal:<span
                                    class="required">*</span></label>
                            <div class="col-md-8">
                                <input type="text" id="postal" name="postal" class="form-control"
                                    value="{{ $part6 }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-outline-success  w-100 w-lg-50 mt-2 mt-lg-5"><i
                            class="fa-solid fa-floppy-disk"></i> Update User Account</button>
                </div>
            </div>
        </div>

    </form>
@endsection
@push('css')
    <link href="{{ asset('css/accounts.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/components/submenu.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
