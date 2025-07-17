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

        <div class="add-extinguisher-container shadow-sm animated-container">

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
                                <option value="Good">Good</option>
                                <option value="Overcharged">Overcharged</option>
                                <option value="Undercharged">Undercharged</option>
                                <option value="Retired">Retired</option>
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
                @method('PUT')
                @csrf
                <input type="hidden" name="id" value="{{ $details->id }}">
                <div class="mb-3">
                    <label for="question_ids" class="form-label">Inspection Questions:</label>
                    <div class="list-group">

                        @foreach ($allQuestions as $question)
                            <label class="list-group-item d-flex align-items-start">
                                <input class="form-check-input me-2 mt-1" type="checkbox" name="question_ids[]"
                                    value="{{ $question->id }}"
                                    {{ in_array($question->id, $assignedQuestionIds) ? 'checked' : '' }}>
                                <div>
                                    <strong>{{ $question->question }}</strong><br>
                                    <small>
                                        Maintenance Interval: <span
                                            class="text-primary">{{ $question->maintenance_interval }}</span> |

                                    </small>
                                    <small>
                                        Fail Reschedule Days: <span
                                            class="text-danger">{{ $question->fail_reschedule_days }}</span>
                                    </small>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Save Assignments</button>
            </form>
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
