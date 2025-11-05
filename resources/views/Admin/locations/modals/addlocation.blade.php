<div class="modal fade" id="addLocationModal" tabindex="-1" aria-labelledby="addLocationLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header  text-white rounded-top-4" style="background-color: #35408e">
                <h5 class="modal-title fw-bold" id="addLocationLabel">
                    <i class="fa-solid fa-file-circle-plus me-2"></i> Add New Location
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <form action="{{ route('admin.SubmitNewLocation') }}" method="POST">
                @csrf
                <div class="modal-body px-4 py-3 text-start">
                    <div class="row g-2">
                        <div class="col-12">
                            <label for="serial_number" class="form-label">Created By: </label>
                            <input type="text" name="serial_number" class="form-control" readonly
                                value="{{ Auth::user()->lname }}, {{ Auth::user()->fname }}">
                        </div>
                        {{-- <div class="col-12">
                            <label for="Icon" class="form-label">Icon: <span class="text-danger">*</span></label>
                            <select name="Icon" id="Icon" class="form-control">
                                <option value="" disabled selected>Select an icon</option>

                                <!-- Buildings -->
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
                        </div> --}}

                        <div class="col-12">
                            <label for="building" class="form-label">Building: <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="building" class="form-control" readonly
                                value="{{ $building }}">
                        </div>

                        <div class="col-12">
                            <label for="floor" class="form-label">Floor</label>
                            <input type="text" name="floor" class="form-control">
                        </div>

                        <div class="col-12">
                            <label for="room" class="form-label">Room</label>
                            <input type="text" name="room" class="form-control">
                        </div>

                        <div class="col-12">
                            <label for="spot" class="form-label">Spot</label>
                            <input type="text" name="spot" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between  py-3">
                    <button type="button" class="btn cancel-btn" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark me-1"></i> Cancel
                    </button>
                    <button type="submit" class="btn save-btn">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Save Location
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
