@extends('layouts.app')
@section('content')
    @include('layouts.components.alerts')
    <div class="main-container container ">
        <div class="breadcrumb-container">
            <div class="breadcrumb-back">
                <a href="javascript:history.back()" class="back-button">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
            </div>
            <div class="breadcrumb-icon">
                <i class="fa-solid fa-radiation"></i>
            </div>
            <nav class="breadcrumb-nav">
                <div class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Home</a>
                </div>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <div class="breadcrumb-item">
                    <a href="{{ route('admin.ShowAdminDeviceMenu') }}">Devices</a>
                </div>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <div class="breadcrumb-item active">
                    <span>Edit</span>
                </div>
            </nav>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-header  text-white d-flex align-items-center py-3" style="background-color: #35408e">
                <i class="fa-solid fa-fire-extinguisher me-2"></i>
                <h5 class="mb-0">Update Device: {{ $details->serial_number }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.UpdateDevice') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $details->id }}">

                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <select id="type" name="type" class="form-select" required>
                                    <option value="" disabled selected hidden>-- SELECT TYPE --</option>
                                    <option value="smoke_detector"
                                        {{ $details->type == 'smoke_detector' ? 'selected' : '' }}>
                                        Smoke Detector</option>
                                    <option value="sprinkler" {{ $details->type == 'sprinkler' ? 'selected' : '' }}>
                                        Sprinkler</option>

                                </select>
                                <label for="type">Type <span class="text-danger">*</span></label>
                            </div>
                            <div class="form-floating mb-3">
                                <input id="model" type="text" name="model" class="form-control" placeholder="Model"
                                    value="{{ $details->model }}" required>
                                <label for="model">Model <span class="text-danger">*</span></label>
                            </div>
                            <div class="form-floating mb-3">
                                <input id="serial_number" type="text" name="serial_number" class="form-control"
                                    placeholder="Serial Number" required value="{{ $details->serial_number }}">
                                <label for="serial_number">Serial Number <span class="text-danger">*</span></label>
                            </div>

                            <div class="form-floating mt-3">
                                <select name="status" id="status" class="form-select" required>
                                    <option value="Good" {{ $details->status == 'Good' ? 'selected' : '' }}>Good
                                    </option>
                                    <option value="active" {{ $details->status == 'active' ? 'selected' : '' }}>
                                        Active</option>
                                    <option value="inactive" {{ $details->status == 'inactive' ? 'selected' : '' }}>
                                        Inactive</option>
                                </select>
                                <label for="status">Status</label>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <input type="hidden" name="loc_id" id="location_id" value="{{ $details->loc_id }}">

                            <div class="form-floating mb-3">
                                <select id="building" class="form-select" name="building" required>
                                    <option value="">Select Building</option>
                                    @foreach ($buildings as $building)
                                        <option value="{{ $building }}">{{ $building }}</option>
                                    @endforeach
                                </select>
                                <label for="building">Building</label>
                            </div>

                            <div class="form-floating mb-3" id="floor-group" style="display: none;">
                                <select id="floor" class="form-select"></select>
                                <label for="floor">Floor</label>
                            </div>

                            <div class="form-floating mb-3" id="room-group" style="display: none;">
                                <select id="room" class="form-select"></select>
                                <label for="room">Room</label>
                            </div>

                            <div class="form-floating mb-3" id="spot-group" style="display: none;">
                                <select id="spot" class="form-select"></select>
                                <label for="spot">Spot</label>
                            </div>
                            <h1 id="location-status" style="display: none;" class="validation-title"></h1>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12 col-lg-3  ms-auto text-end">
                            <button id="submit-button" type="submit" class="btn save-btn w-100">
                                <i class="fa-solid fa-floppy-disk"></i> Update Device
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- <div class="card shadow-sm">
            <div class="card-header  text-white d-flex align-items-center py-3" style="background-color: #35408e">
                <i class="fa-solid fa-clipboard-check me-2"></i>
                <h5 class="mb-0">Assign Inspection Questions to ({{ $details->extinguisher_id }})</h5>
            </div>
            <div class="">
                <form method="POST" action="{{ route('admin.AssignInspectionQuestion') }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $details->id }}">

                    <div class="bordered">
                        @foreach ($allQuestions as $question)
                            <label class="list-group-item d-flex align-items-center gap-2 px-3 mt-3">
                                <input class="form-check-input me-2 mt-1" type="checkbox" name="question_ids[]"
                                    value="{{ $question->id }}"
                                    {{ in_array($question->id, $assignedQuestionIds) ? 'checked' : '' }}>
                                <div>
                                    <strong>{{ $question->question }}</strong><br>
                                    <small>
                                        Maintenance Interval:
                                        <span class="text-primary">{{ $question->maintenance_interval }}</span> |
                                        Fail Reschedule Days:
                                        <span class="text-danger">{{ $question->fail_reschedule_days }}</span>
                                    </small>
                                </div>
                            </label>
                            <hr>
                        @endforeach
                    </div>
                    <div class="row mx-2 my-3">
                        <div class="col-12 col-lg-3 ms-auto text-end">
                            <button type="submit" class="btn add-new-btn w-100">
                                <i class="fa-solid fa-floppy-disk"></i> Save Questions
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div> --}}
        <div class="table-container animated-container">
            <div
                class="row mt-3 mb-3 d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center">
                <div class="col-12 col-lg-3 ">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fas fa-search"></i></span>
                        <input type="text" id="tableSearch" class="form-control" placeholder="Search..."
                            onkeyup="filterTable()">
                    </div>
                </div>
                <div class="col-12 col-lg-3 W mt-3 mt-lg-0 text-end">
                    <button class="btn w-50 w-lg-auto add-new-btn" data-bs-toggle="modal"
                        data-bs-target="#addLocationModal"><i class="bi bi-file-earmark-plus"></i> Add New</button>
                    @include('Admin.Device.modals.add')
                </div>
            </div>
            <div class="table-container table-responsive">
                <table class="sortable-table table table-responsive table-bordered w-100" id="sortableTable">
                    <thead>
                        <tr>

                            <th class="text-center sortable align-middle" data-index="0" onclick="sortTable(this)">
                                # <span class="sort-icons"><span class="asc">▲</span><span
                                        class="desc">▼</span></span>
                            </th>
                            <th class="text-center sortable align-middle" data-index="1" onclick="sortTable(this)">
                                Certificate No. <span class="sort-icons"><span class="asc">▲</span><span
                                        class="desc">▼</span></span>
                            </th>
                            <th class="text-center sortable align-middle" data-index="2" onclick="sortTable(this)">
                                Issue Date<span class="sort-icons"><span class="asc">▲</span><span
                                        class="desc">▼</span></span>
                            </th>
                            <th class="text-center sortable align-middle" data-index="2" onclick="sortTable(this)">
                                Expiry Date <span class="sort-icons"><span class="asc">▲</span><span
                                        class="desc">▼</span></span>
                            </th>
                            {{-- <th class="text-center sortable align-middle" data-index="4" onclick="sortTable(this)">
                            Status <span class="sort-icons"><span class="asc">▲</span><span
                                    class="desc">▼</span></span>
                        </th> --}}
                            <th class="text-center sortable align-middle">Status</th>
                            <th class="text-center sortable align-middle">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $index => $item)
                            <tr>

                                <td style="vertical-align: middle; text-align: center;">
                                    {{ $index + 1 }}
                                </td>

                                <td style="vertical-align: middle; text-align: center;" class="text-capitalize">
                                    {{ $item->certificate_no }}
                                </td>

                                <td style="vertical-align: middle; text-align: center;">
                                    {{ optional($item->issue_date ? \Carbon\Carbon::parse($item->issue_date) : null)->format('F d, Y') ?? 'N/A' }}
                                </td>
                                <td style="vertical-align: middle; text-align: center;">
                                    {{ optional($item->expiry_date ? \Carbon\Carbon::parse($item->expiry_date) : null)->format('F d, Y') ?? 'N/A' }}
                                </td>

                                <td class="text-capitalize" style="vertical-align: middle; text-align: center;">
                                    @php
                                        $status = $item->status;
                                        $badgeClass = match ($status) {
                                            'active' => 'success',
                                            'expired' => 'danger',
                                            default => 'secondary',
                                        };
                                    @endphp

                                    <span
                                        class="badge px-3 py-2 rounded-pill bg-{{ $badgeClass }}">{{ $status }}</span>
                                </td>

                                <td class="text-center align-middle">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <button style="background-color: transparent; border: 0;" class="mx-2 edit-btn"
                                            data-bs-toggle="modal" data-bs-target="#ViewCertModal{{ $item->id }}">
                                            <i class="fa-regular fa-eye"></i>
                                        </button>
                                        @include('Admin.Device.modals.view')
                                        {{-- <a class="mx-2 edit-btn" href="{{ url('Devices/Details/' . $item->id) }}">

                                        </a> --}}
                                        {{-- <form action="{{ route('admin.DeleteExtinguisher') }}" method="POST"
                                            onsubmit="return confirmDelete(this);">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <button class="mx-2 delete-btn" type="submit" title="Delete"
                                                style="border: none; background-color: transparent">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                        @include('layouts.components.deletepopup') --}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="  d-flex flex-wrap justify-content-between align-items-center">

                    <div class="mb-2 mt-2 small text-muted">
                        Showing <b>{{ $items->firstItem() }}</b> to <b>{{ $items->lastItem() }}</b> of
                        <b>{{ $items->total() }}</b> Items
                    </div>

                    <div class="mt-3">
                        {{ $items->onEachSide(1)->links() }}
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const locationId = document.getElementById("location_id")?.value;
                if (locationId) preloadLocation(locationId);
            });
        </script>
        <script src="{{ asset('/js/extinguishers/editdropdown.js') }}"></script>
        <script src="{{ asset('/js/extinguishers/typedropdowncolor.js') }}"></script>
        <script src="{{ asset('/js/table/search.js') }}"></script>
        <script src="{{ asset('/js/table/sort.js') }}"></script>
    @endsection
    @push('css')
        <link href="{{ asset('css/custom.css') }}?v={{ time() }}" rel="stylesheet">
        <link href="{{ asset('css/components/submenu.css') }}?v={{ time() }}" rel="stylesheet">
    @endpush
