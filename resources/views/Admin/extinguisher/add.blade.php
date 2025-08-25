@extends('layouts.app')
@section('content')
    @include('layouts.components.alerts')
    <div class="main-container container ">
        <div class="breadcrumb-container">
            <div class="breadcrumb-icon">
                <i class="fa-solid fa-fire-extinguisher"></i>
            </div>
            <nav class="breadcrumb-nav">
                <div class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Home</a>
                </div>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <div class="breadcrumb-item">
                    <a href="{{ route('admin.ShowExtinguishersMenu') }}">Extinguishers</a>
                </div>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <div class="breadcrumb-item active">
                    <span>>Add New</span>
                </div>
            </nav>
        </div>
        <form action="{{ route('SubmitNewTank') }}" method="POST">
            @csrf
            <div class="row">
                <!-- Extinguisher Details Card -->
                <div class="col-lg-6 col-md-12 mb-4 ">
                    <div class="card shadow-sm h-100">
                        <div class="card-header text-white d-flex align-items-center py-3"
                            style="background-color: #35408e;">
                            <i class="fa-solid fa-fire-extinguisher me-2"></i>
                            <h5 class="mb-0">Extinguisher Details</h5>
                        </div>
                        <div class="card-body px-4">
                            <div class="form-floating mb-3">
                                <input id="serial_number" type="text" name="serial_number" class="form-control"
                                    placeholder="Serial Number" required>
                                <label for="serial_number">Serial Number <span class="text-danger">*</span></label>
                            </div>

                            <div class="form-floating mb-3">
                                <select id="type" name="type" class="form-select" required>
                                    <option value="" disabled selected hidden>-- SELECT TYPE --</option>
                                    @foreach ($types as $item)
                                        <option value="{{ $item->id }}" style="color: {{ $item->color }}">
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <label for="type">Type <span class="text-danger">*</span></label>
                            </div>

                            <div class="form-floating mb-3">
                                <input id="capacity" type="text" name="capacity" class="form-control"
                                    placeholder="Capacity" required>
                                <label for="capacity">Capacity <span class="text-danger">*</span></label>
                            </div>

                            <div class="form-floating mb-3">
                                <input id="installation_date" type="date" name="installation_date" class="form-control"
                                    placeholder="Installation Date" required>
                                <label for="installation_date">Installation Date <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Extinguisher Location Card -->
                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header text-white d-flex align-items-center py-3"
                            style="background-color: #35408e;">
                            <i class="fa-solid fa-building me-2"></i>
                            <h5 class="mb-0">Extinguisher Location</h5>
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="loc_id" id="location_id_display" class="form-control" readonly>

                            <div class="form-floating mb-3">
                                <select id="building" class="form-select" name="building" required>
                                    <option value="" disabled selected hidden>-- SELECT BUILDING --</option>
                                    @foreach ($buildings as $building)
                                        <option value="{{ $building }}">{{ $building }}</option>
                                    @endforeach
                                </select>
                                <label for="building">Building <span class="text-danger">*</span></label>
                            </div>

                            <div class="form-floating mb-3" id="floor-group" style="display: none;">
                                <select id="floor" class="form-select" name="floor">
                                    <option value="">-- SELECT FLOOR --</option>
                                </select>
                                <label for="floor">Floor</label>
                            </div>

                            <div class="form-floating mb-3" id="room-group" style="display: none;">
                                <select id="room" class="form-select" name="room">
                                    <option value="">-- SELECT ROOM --</option>
                                </select>
                                <label for="room">Room</label>
                            </div>

                            <div class="form-floating mb-3" id="spot-group" style="display: none;">
                                <select id="spot" class="form-select" name="spot">
                                    <option value="">-- SELECT SPOT --</option>
                                </select>
                                <label for="spot">Spot</label>
                            </div>

                            <h1 id="location-status" class="validation-title"></h1>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Save Button Row -->
            <div class="row mb-3">
                <div class="col-12 col-lg-3">
                    <button id="submit-button" type="submit" class="btn add-new-btn mt-2 w-100" disabled>
                        <i class="fa-solid fa-floppy-disk"></i> Save Extinguisher
                    </button>
                </div>
            </div>

        </form>
    </div>
    <script src="{{ asset('/js/extinguishers/locationdropdown.js') }}"></script>
@endsection
@push('css')
    <link href="{{ asset('css/custom.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/components/submenu.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
