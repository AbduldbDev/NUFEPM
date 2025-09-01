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
                <i class="fa-solid fa-fire-extinguisher"></i>
            </div>
            <nav class="breadcrumb-nav">
                <div class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Home</a>
                </div>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <div class="breadcrumb-item">
                    <a href="{{ route('admin.ShowExtinguishersMenu') }}">Fire Equipments</a>
                </div>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <div class="breadcrumb-item active">
                    <span>Edit</span>
                </div>
            </nav>
        </div>

        {{-- <div class="add-extinguisher-container shadow-sm animated-container">

            <form action="{{ route('admin.UpdateExtinguishers') }}" method="POST">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <h1 class="text-lg addnew-title"><i class="fa-solid fa-file-circle-plus"></i> Extinguisher:
                            ({{ $details->extinguisher_id }})
                        </h1>
                        <input type="hidden" name="id" value="{{ $details->id }}">

                        <div class="mb-3">
                            <label for="serial_number" class="form-label">Serial Number: <span
                                    class="text-danger">*</span></label>
                            <input id="serial_number" type="text" name="serial_number" class="form-control" required
                                value="{{ $details->serial_number }}">
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">Type: <span class="text-danger">*</span></label>
                            <select id="type" name="type" class="form-control" required>
                                <option value="">-- SELECT TYPE --</option>
                                @foreach ($types as $item)
                                    <option value="{{ $item->id }}" style="color: {{ $item->color }}"
                                        {{ optional($details->type)->id === $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="capacity" class="form-label">Capacity: <span class="text-danger">*</span></label>
                            <input id="capacity" type="text" name="capacity" class="form-control" required
                                value="{{ $details->capacity }}">
                        </div>

                        <div class="mb-3">
                            <label for="installation_date" class="form-label">Installation Date: <span
                                    class="text-danger">*</span></label>
                            <input id="installation_date" type="date" name="installation_date" class="form-control"
                                required value="{{ $details->installation_date }}">
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status: <span class="text-danger">*</span></label>
                            <select class="form-control" name="status" id="status">
                                <option value="Good" {{ $details->status == 'Good' ? 'selected' : '' }}>Good</option>
                                <option value="Overcharged" {{ $details->status == 'Overcharged' ? 'selected' : '' }}>
                                    Overcharged</option>
                                <option value="Undercharged" {{ $details->status == 'Undercharged' ? 'selected' : '' }}>
                                    Undercharged</option>
                                <option value="Retired" {{ $details->status == 'Retired' ? 'selected' : '' }}>Retired
                                </option>
                            </select>

                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <h1 class="text-lg addnew-title"><i class="fa-solid fa-building"></i> Extinguisher Location
                        </h1>

                        <input type="hidden" name="location_id" id="location_id" value="{{ $details->location_id }}">

                        <div class="mb-3" id="building-group">
                            <label class="form-label" for="building">Building</label>
                            <select id="building" class="form-control" name="building" required>
                                <option value="">Select Building</option>
                                @foreach ($buildings as $building)
                                    <option value="{{ $building }}">{{ $building }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3" id="floor-group" style="display: none;">
                            <label class="form-label" for="floor">Floor</label>
                            <select id="floor" class="form-control"></select>
                        </div>

                        <div class="mb-3" id="room-group" style="display: none;">
                            <label class="form-label" for="room">Room</label>
                            <select id="room" class="form-control"></select>
                        </div>

                        <div class="mb-3" id="spot-group" style="display: none;">
                            <label class="form-label" for="spot">Spot</label>
                            <select id="spot" class="form-control"></select>
                        </div>

                        <h1 id="location-status" style="display: none;" class="validation-title"></h1>
                    </div>
                </div>
                <button id="submit-button" type="submit" class="btn save-btn mt-3">
                    <i class="fa-solid fa-floppy-disk"></i> Update Extinguisher
                </button>
            </form>

            <h3 class="mt-5">Assign Questions to (#{{ $details->extinguisher_id }})</h3>

            <form method="POST" action="{{ route('admin.AssignInspectionQuestion') }}">
                @csrf
                @method('PUT')

                <input type="hidden" name="id" value="{{ $details->id }}">

                <div class="mb-4">
                    <label for="question_ids" class="form-label fw-bold">Assign Inspection Questions</label>
                    <div class="list-group  rounded">
                        @forelse ($allQuestions as $question)
                            <label class="list-group-item d-flex  align-items-center gap-4 ">
                                <input type="checkbox" name="question_ids[]" value="{{ $question->id }}"
                                    class="form-check-input mt-1"
                                    {{ in_array($question->id, $assignedQuestionIds) ? 'checked' : '' }}>
                                <div>
                                    <div class="fw-semibold">{{ $question->question }}</div>
                                    <small class="d-block">
                                        <span class="text-muted">Interval:</span>
                                        <span class="text-primary">{{ $question->maintenance_interval }}</span> |
                                        <span class="text-muted">Fail Resched:</span>
                                        <span class="text-danger">{{ $question->fail_reschedule_days }} day(s)</span>
                                    </small>
                                </div>
                            </label>
                        @empty
                            <div class="p-3 text-muted">No inspection questions available.</div>
                        @endforelse
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Save Assignments
                    </button>
                </div>
            </form>

        </div> --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header  text-white d-flex align-items-center py-3" style="background-color: #35408e">
                <i class="fa-solid fa-fire-extinguisher me-2"></i>
                <h5 class="mb-0">Update Extinguisher: {{ $details->extinguisher_id }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.UpdateExtinguishers') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $details->id }}">

                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div class="form-floating">
                                <input type="text" id="serial_number" name="serial_number" class="form-control" required
                                    value="{{ $details->serial_number }}">
                                <label for="serial_number">Serial Number</label>
                            </div>

                            <div class="form-floating mt-3">
                                <select id="type" name="category" class="form-select" required>
                                    <option value="" disabled selected hidden>-- SELECT CATEGORY --</option>

                                    <option value="Extinguisher"
                                        {{ $details->category == 'Extinguisher' ? 'selected' : '' }}>
                                        Extinguisher
                                    </option>
                                    <option value="Fire_Hose" {{ $details->category == 'Fire_Hose' ? 'selected' : '' }}>
                                        Fire Hose
                                    </option>
                                </select>
                                <label for="type">Category <span class="text-danger">*</span></label>
                            </div>

                            <div class="form-floating mt-3">
                                <select id="type" name="type" class="form-select" required>
                                    <option value="" disabled {{ $details->type ? '' : 'selected' }}>-- SELECT TYPE --
                                    </option>

                                    <option style="color: red" value="ABC Fire Extinguisher (RED)"
                                        {{ $details->type == 'ABC Fire Extinguisher (RED)' ? 'selected' : '' }}>
                                        ABC Fire Extinguisher (RED)
                                    </option>

                                    <option style="color: green" value="ABC Fire Extinguisher (GREEN)"
                                        {{ $details->type == 'ABC Fire Extinguisher (GREEN)' ? 'selected' : '' }}>
                                        ABC Fire Extinguisher (GREEN)
                                    </option>

                                    <option value="CO2 Fire Extinguisher"
                                        {{ $details->type == 'CO2 Fire Extinguisher' ? 'selected' : '' }}>
                                        CO2 Fire Extinguisher
                                    </option>

                                    <option value="Class K Fire Extinguisher"
                                        {{ $details->type == 'Class K Fire Extinguisher' ? 'selected' : '' }}>
                                        Class K Fire Extinguisher
                                    </option>

                                    <option value="Halotron Fire Extinguisher"
                                        {{ $details->type == 'Halotron Fire Extinguisher' ? 'selected' : '' }}>
                                        Halotron Fire Extinguisher
                                    </option>

                                    <option value="Water-Based Fire Extinguisher"
                                        {{ $details->type == 'Water-Based Fire Extinguisher' ? 'selected' : '' }}>
                                        Water-Based Fire Extinguisher
                                    </option>

                                    <option style="color: purple" value="Purple K Fire Extinguisher"
                                        {{ $details->type == 'Purple K Fire Extinguisher' ? 'selected' : '' }}>
                                        Purple K Fire Extinguisher
                                    </option>

                                    <option value="Other" {{ $details->type == 'Other' ? 'selected' : '' }}>
                                        Other
                                    </option>
                                </select>

                                <label for="type">Type</label>
                            </div>

                            <div class="form-floating mt-3">
                                <input type="text" id="capacity" name="capacity" class="form-control" required
                                    value="{{ $details->capacity }}">
                                <label for="capacity">Capacity</label>
                            </div>

                            <div class="form-floating mt-3">
                                <input type="date" id="installation_date" name="installation_date" class="form-control"
                                    required value="{{ $details->installation_date }}">
                                <label for="installation_date">Installation Date</label>
                            </div>

                            <div class="form-floating mt-3">
                                <select name="status" id="status" class="form-select" required>
                                    <option value="Good" {{ $details->status == 'Good' ? 'selected' : '' }}>Good
                                    </option>
                                    <option value="Overcharged" {{ $details->status == 'Overcharged' ? 'selected' : '' }}>
                                        Overcharged</option>
                                    <option value="Undercharged"
                                        {{ $details->status == 'Undercharged' ? 'selected' : '' }}>Undercharged</option>
                                    <option value="Retired" {{ $details->status == 'Retired' ? 'selected' : '' }}>Retired
                                    </option>
                                </select>
                                <label for="status">Status</label>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <input type="hidden" name="location_id" id="location_id" value="{{ $details->location_id }}">

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
                                <i class="fa-solid fa-floppy-disk"></i> Update Extinguisher
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow-sm">
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
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const locationId = document.getElementById("location_id")?.value;
                if (locationId) preloadLocation(locationId);
            });
        </script>
        <script src="{{ asset('/js/extinguishers/editdropdown.js') }}"></script>
        <script src="{{ asset('/js/extinguishers/typedropdowncolor.js') }}"></script>
    @endsection
    @push('css')
        <link href="{{ asset('css/custom.css') }}?v={{ time() }}" rel="stylesheet">
        <link href="{{ asset('css/components/submenu.css') }}?v={{ time() }}" rel="stylesheet">
    @endpush
