@extends('layouts.app')
@section('content')
    @include('layouts.components.alerts')
    <div class="main-container container ">
        <div class="title">
            <span class="menu-title-icon"><i class="fa-solid fa-fire-extinguisher"></i></span> &nbsp;
            <span class="crumb">
                <span class="breadcrumbs"><a href="{{ route('dashboard') }}">Home</a> &gt; </span>
            </span>
            <span class="crumb">
                <span class="breadcrumbs"><a href="{{ route('admin.ShowExtinguishersMenu') }}">Extinguishers</a> &gt; </span>
            </span>
            <span class="breadcrumbs">Add New </span>
        </div>
        <hr>

        <div class="card shadow-sm border-0 rounded-4 p-4 animated-container">
            <form action="{{ route('SubmitNewTank') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <h1 class="text-lg addnew-title"><i class="fa-solid fa-file-circle-plus"></i> Extinguishers Details
                        </h1>
                        <div class="mb-3">
                            <label for="serial_number" class="form-label">Serial Number: <span
                                    class="text-danger">*</span></label>
                            <input id="serial_number" type="text" name="serial_number" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">Type: <span class="text-danger">*</span></label>
                            <select id="type" name="type" class="form-control" required>
                                <option value="">-- SELECT TYPE --</option>
                                @foreach ($types as $item)
                                    <option value="{{ $item->id }}" style="color: {{ $item->color }}">
                                        {{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="capacity" class="form-label">Capacity: <span class="text-danger">*</span></label>
                            <input id="capacity" type="text" name="capacity" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="installation_date" class="form-label">Installation Date: <span
                                    class="text-danger">*</span></label>
                            <input id="installation_date" type="date" name="installation_date" class="form-control"
                                required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <h1 class="text-lg addnew-title"><i class="fa-solid fa-building"></i> Extinguisher Location
                        </h1>
                        <input type="hidden" name="loc_id" id="location_id_display" class="form-control" readonly>
                        <div class="form-group mb-3">
                            <label for="building" class="form-label">Building: <span class="text-danger">*</span></label>
                            <select id="building" class="form-control" name="building" required>
                                <option value="">-- SELECT BUILDING --</option>
                                @foreach ($buildings as $building)
                                    <option value="{{ $building }}">{{ $building }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3" id="floor-group" style="display: none;">
                            <label for="floor" class="form-label">Floor: </label>
                            <select id="floor" class="form-control" name="floor">
                                <option value="">-- SELECT FLOOR --</option>
                            </select>
                        </div>

                        <div class="form-group mb-3" id="room-group" style="display: none;">
                            <label for="room" class="form-label">Room: </label>
                            <select id="room" class="form-control" name="room">
                                <option value="">-- SELECT ROOM --</option>
                            </select>
                        </div>

                        <div class="form-group mb-3" id="spot-group" style="display: none;">
                            <label for="spot" class="form-label">Spot: </label>
                            <select id="spot" class="form-control" name="spot">
                                <option value="">-- SELECT SPOT --</option>
                            </select>
                        </div>
                        <h1 id="location-status" class="validation-title"></h1>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12 col-lg-3">
                        <button id="submit-button" type="submit" class="btn add-new-btn mt-2 w-100" disabled>
                            <i class="fa-solid fa-floppy-disk"></i> Save Extinguisher
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <script src="{{ asset('/js/extinguishers/locationdropdown.js') }}"></script>
@endsection
@push('css')
    <link href="{{ asset('css/custom.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/components/submenu.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
