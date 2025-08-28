@extends('layouts.app')
@section('content')
    @include('layouts.components.alerts')
    <form class="" action="{{ route('admin.UpdateUserAccount') }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
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
                        <a href="{{ route('admin.ShowAccountsMenu') }}">Accounts</a>
                    </div>
                    <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                    <div class="breadcrumb-item">
                        <a href="{{ route('admin.ShowAllAccounts') }}">All Accounts</a>
                    </div>
                    <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                    <div class="breadcrumb-item active">
                        <span>Edit Account</span>
                    </div>
                </nav>
            </div>

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

            <div class="animated-container">

                <div class="container mt-4">
                    <div class="info-header">
                        <div class="row g-3 align-items-center">

                            <div class="col-12 col-md-4 col-lg-3 text-start ">
                                @if ($details->image)
                                    <img src="{{ asset('/storage/' . $details->image) }}"
                                        class="img-fluid rounded-circle profile-img shadow-sm " alt="User Image">
                                @else
                                    <img src="{{ asset('/Image/profile.webp') }}"
                                        class="img-fluid rounded-circle profile-img shadow-sm" alt="Default User Image">
                                @endif
                            </div>

                            <div class="col-12 col-md-8 col-lg-9 bg-white shadow-sm rounded-3 p-4">

                                <h3 class="fw-bold text-dark mb-3">
                                    {{ $details->lname }} {{ $details->suffix }}, {{ $details->fname }}
                                    {{ $details->mname }}
                                </h3>
                                <table class="table table-borderless small mb-0">
                                    <tbody>
                                        <tr>
                                            <td class="text-success"><i class="fa fa-id-card-alt me-2"></i>ID Number
                                            </td>
                                            <td>{{ $details->uid }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-success"><i class="fa fa-building me-2"></i>Dept. Role</td>
                                            <td class="text-capitalize">{{ $details->type }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-success"><i class="fa fa-envelope me-2"></i>Email Address
                                            </td>
                                            <td>{{ $details->email }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Change Image:</label>
                                    <input type="file" id="image" name="image" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-container shadow-sm p-4 mt-4 bg-white rounded-3">
                    <h4 class="form-title mb-3 form-title"><i class="fa-solid fa-circle-info me-2"></i> Basic Information
                    </h4>
                    <hr>

                    <input type="hidden" name="id" value="{{ $details->id }}">

                    <div class="row mb-3  g-lg-4 g-2">
                        <div class="col-md-6">
                            <label class="form-label">User ID <span class="text-danger">*</span></label>
                            <input type="text" name="uid" class="form-control" required value="{{ $details->uid }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-select" required>
                                <option value="">-- Select --</option>
                                <option value="active" {{ $details->status === 'active' ? 'selected' : '' }}>Active
                                </option>
                                <option value="inactive" {{ $details->status === 'inactive' ? 'selected' : '' }}>Inactive
                                </option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" required
                                value="{{ $details->email }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">User Type <span class="text-danger">*</span></label>
                            <select name="type" class="form-select" required>
                                <option value="">-- Select --</option>
                                <option value="admin" {{ $details->type === 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="engineer" {{ $details->type == 'engineer' ? 'selected' : '' }}>
                                    Engineer</option>
                                <option value="guard" {{ $details->type == 'guard' ? 'selected' : '' }}>
                                    Guard</option>
                                <option value="maintenance" {{ $details->type === 'maintenance' ? 'selected' : '' }}>
                                    Maintenance</option>

                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">First Name <span class="text-danger">*</span></label>
                            <input type="text" name="fname" class="form-control" value="{{ $details->fname }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Middle Name</label>
                            <input type="text" name="mname" class="form-control" value="{{ $details->mname }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Last Name <span class="text-danger">*</span></label>
                            <input type="text" name="lname" class="form-control" value="{{ $details->lname }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Suffix</label>
                            <input type="text" name="suffix" class="form-control" value="{{ $details->suffix }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Gender <span class="text-danger">*</span></label>
                            <select name="gender" class="form-select" required>
                                <option value="">-- Select --</option>
                                <option value="male" {{ $details->gender === 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ $details->gender === 'female' ? 'selected' : '' }}>Female
                                </option>
                                <option value="other" {{ $details->gender === 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Contact No. <span class="text-danger">*</span></label>
                            <input type="text" name="phone" class="form-control" value="{{ $details->phone }}">
                        </div>
                    </div>

                    <h4 class="form-title mb-3 form-title mt-4"><i class="fa-solid fa-map-location-dot me-2"></i>
                        Address Information</h4>
                    <hr>

                    <div class="row mb-3  g-lg-4 g-2">
                        <div class="col-md-6">
                            <label class="form-label">State/Province <span class="text-danger">*</span></label>
                            <input type="text" name="province" class="form-control" value="{{ $part5 }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">City <span class="text-danger">*</span></label>
                            <input type="text" name="city" class="form-control" value="{{ $part4 }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Barangay <span class="text-danger">*</span></label>
                            <input type="text" name="barangay" class="form-control" value="{{ $part3 }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Street <span class="text-danger">*</span></label>
                            <input type="text" name="street" class="form-control" value="{{ $part2 }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">House No. <span class="text-danger">*</span></label>
                            <input type="text" name="house" class="form-control" value="{{ $part1 }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Postal <span class="text-danger">*</span></label>
                            <input type="text" name="postal" class="form-control" value="{{ $part6 }}">
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn save-btn w-100 w-lg-50 mt-4">
                            <i class="fa-solid fa-floppy-disk me-2"></i> Update User Account
                        </button>
                    </div>
                </div>
            </div>

        </div>

    </form>
@endsection
@push('css')
    <link href="{{ asset('css/custom.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/components/submenu.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
