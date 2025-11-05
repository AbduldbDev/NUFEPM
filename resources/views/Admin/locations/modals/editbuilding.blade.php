<div class="modal fade" id="editBuildingModal{{ $item->id }}" tabindex="-1"
    aria-labelledby="editBuildingModalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header  text-white rounded-top-4" style="background-color: #35408e">
                <h5 class="modal-title fw-bold" id="editBuildingModalLabel{{ $item->id }}">
                    <i class="fa-solid fa-pen-to-square"></i> Edit Building
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('admin.UpdateBuilding') }}">
                @csrf
                @method('PUT')

                <div class="modal-body text-start">
                    <div class="row g-4">
                        <div class="col-12">
                            <input type="hidden" class="form-label" name="id" value="{{ $item->id }}">
                            <label for="name{{ $item->id }}" class="form-label">Name: </label>
                            <input type="text" name="name" id="name{{ $item->id }}" class="form-control"
                                value="{{ $item->name }}" required>
                        </div>

                        <div class="col-12">
                            <label for="icon{{ $item->id }}" class="form-label">Name: </label>
                            <select name="icon" id="icon{{ $item->id }}" class="form-control" required>
                                <option value="" disabled>Select an icon</option>

                                <option value="fa-solid fa-building"
                                    {{ $item->icon == 'fa-solid fa-building' ? 'selected' : '' }}>Building</option>
                                <option value="fa-solid fa-city"
                                    {{ $item->icon == 'fa-solid fa-city' ? 'selected' : '' }}>City / Complex</option>
                                <option value="fa-solid fa-landmark"
                                    {{ $item->icon == 'fa-solid fa-landmark' ? 'selected' : '' }}>Landmark</option>
                                <option value="fa-solid fa-warehouse"
                                    {{ $item->icon == 'fa-solid fa-warehouse' ? 'selected' : '' }}>Warehouse</option>

                                <!-- School -->
                                <option value="fa-solid fa-school"
                                    {{ $item->icon == 'fa-solid fa-school' ? 'selected' : '' }}>School / Campus
                                </option>
                                <option value="fa-solid fa-graduation-cap"
                                    {{ $item->icon == 'fa-solid fa-graduation-cap' ? 'selected' : '' }}>Graduation /
                                    Education</option>
                                <option value="fa-solid fa-chalkboard-teacher"
                                    {{ $item->icon == 'fa-solid fa-chalkboard-teacher' ? 'selected' : '' }}>Classroom /
                                    Teaching</option>

                                <!-- Rooms -->
                                <option value="fa-solid fa-door-open"
                                    {{ $item->icon == 'fa-solid fa-door-open' ? 'selected' : '' }}>Door / Room</option>
                                <option value="fa-solid fa-bed"
                                    {{ $item->icon == 'fa-solid fa-bed' ? 'selected' : '' }}>Bedroom</option>
                                <option value="fa-solid fa-couch"
                                    {{ $item->icon == 'fa-solid fa-couch' ? 'selected' : '' }}>Lounge / Common Room
                                </option>

                                <!-- Lab -->
                                <option value="fa-solid fa-flask"
                                    {{ $item->icon == 'fa-solid fa-flask' ? 'selected' : '' }}>Laboratory</option>
                                <option value="fa-solid fa-vials"
                                    {{ $item->icon == 'fa-solid fa-vials' ? 'selected' : '' }}>Test Tubes / Lab
                                </option>
                                <option value="fa-solid fa-microscope"
                                    {{ $item->icon == 'fa-solid fa-microscope' ? 'selected' : '' }}>Microscope</option>

                                <!-- Hotel -->
                                <option value="fa-solid fa-hotel"
                                    {{ $item->icon == 'fa-solid fa-hotel' ? 'selected' : '' }}>Hotel / Building
                                </option>
                                <option value="fa-solid fa-bath"
                                    {{ $item->icon == 'fa-solid fa-bath' ? 'selected' : '' }}>Bathroom</option>
                                <option value="fa-solid fa-concierge-bell"
                                    {{ $item->icon == 'fa-solid fa-concierge-bell' ? 'selected' : '' }}>Hotel Reception
                                </option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="description{{ $item->id }}" class="form-label">Name: </label>
                            <textarea class="form-control" name="description" id="description" cols="10" rows="5">{{ $item->description }}</textarea>
                        </div>

                    </div>
                </div>

                <div class="modal-footer justify-content-between  py-3">
                    <button type="button" class="btn cancel-btn" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark me-1"></i> Cancel
                    </button>
                    <button type="submit" class="btn save-btn">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Save Building
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
