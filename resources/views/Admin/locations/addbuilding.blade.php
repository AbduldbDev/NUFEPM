@extends('layouts.app')
@section('content')
    <div class="main-container container ">
        <div class="breadcrumb-container">
            <div class="breadcrumb-back">
                <a href="javascript:history.back()" class="back-button">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
            </div>
            <div class="breadcrumb-icon">
                <i class="fa-solid fa-school-flag"></i>
            </div>
            <nav class="breadcrumb-nav">
                <div class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Home</a>
                </div>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <div class="breadcrumb-item ">
                    <a href="{{ url('Locations') }}">Locations</a>
                </div>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <div class="breadcrumb-item active">
                    <span>Add New Building</span>
                </div>

            </nav>
        </div>
        <form action="{{ route('admin.SubmitNewBuilding') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-6 col-md-12 mb-4 ">
                    <div class="card shadow-sm h-100">
                        <div class="card-header text-white d-flex align-items-center py-3"
                            style="background-color: #35408e;">
                            <i class="fa-solid fa-building me-2"></i>
                            <h5 class="mb-0">Building Details</h5>
                        </div>
                        <div class="card-body px-4">
                            <div class="form-floating mb-3">
                                <input id="building_name" type="text" name="name" class="form-control"
                                    placeholder="Building Name" required>
                                <label for="building_name">Building Name <span class="text-danger">*</span></label>
                            </div>
                            <div class="form-floating mb-3">
                                <select name="icon" id="Icon" class="form-control">
                                    <option value="" disabled selected>Select an icon</option>

                                    <option value="fa-solid fa-building">Building</option>
                                    <option value="fa-solid fa-city">City / Complex</option>
                                    <option value="fa-solid fa-landmark">Landmark</option>
                                    <option value="fa-solid fa-warehouse">Warehouse</option>

                                    <!-- School -->
                                    <option value="fa-solid fa-school">School / Campus</option>
                                    <option value="fa-solid fa-graduation-cap">Graduation / Education</option>
                                    <option value="fa-solid fa-chalkboard-teacher">Classroom / Teaching</option>

                                    <!-- Rooms -->
                                    <option value="fa-solid fa-door-open">Door / Room</option>
                                    <option value="fa-solid fa-bed">Bedroom</option>
                                    <option value="fa-solid fa-couch">Lounge / Common Room</option>

                                    <!-- Lab -->
                                    <option value="fa-solid fa-flask">Laboratory</option>
                                    <option value="fa-solid fa-vials">Test Tubes / Lab</option>
                                    <option value="fa-solid fa-microscope">Microscope</option>

                                    <!-- Hotel -->
                                    <option value="fa-solid fa-hotel">Hotel / Building</option>
                                    <option value="fa-solid fa-bath">Bathroom</option>
                                    <option value="fa-solid fa-concierge-bell">Hotel Reception</option>
                                </select>
                                <label for="Icon">Icon <span class="text-danger">*</span></label>
                            </div>

                            <div class=" mb-3">
                                <label for="description">Description <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="description" id="description" cols="10" rows="5"></textarea>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Save Button Row -->
            <div class="row mb-3">
                <div class="col-12 col-lg-6">
                    <button id="submit-button" type="submit" class="btn add-new-btn mt-2 w-100">
                        <i class="fa-solid fa-floppy-disk"></i> Add Building
                    </button>
                </div>
            </div>

        </form>

    </div>
@endsection
@push('css')
    <link href="{{ asset('css/custom.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/components/submenu.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
