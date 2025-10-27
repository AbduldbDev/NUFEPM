<div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}"
    aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header  text-white rounded-top-4" style="background-color: #35408e">
                <h5 class="modal-title fw-bold" id="editModalLabel{{ $item->id }}">
                    <i class="fa-solid fa-pen-to-square"></i> Edit Location
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('admin.UpdateLocation', $item->id) }}">
                @csrf
                @method('PUT')

                <div class="modal-body text-start">
                    <div class="row g-4">
                        <div class="col-12">
                            <input type="hidden" class="form-label" name="id" value="{{ $item->id }}">
                            <label for="building{{ $item->id }}" class="form-label">Building: </label>
                            <input type="text" name="building" id="building{{ $item->id }}" class="form-control"
                                value="{{ $item->building }}" readonly>
                        </div>
                        <div class="col-12">
                            <input type="hidden" class="form-label" name="id" value="{{ $item->id }}">
                            <label for="floor{{ $item->id }}" class="form-label">Floor: </label>
                            <input type="text" name="floor" id="floor{{ $item->id }}" class="form-control"
                                value="{{ $item->floor }}">
                        </div>

                        <div class="col-12">
                            <input type="hidden" class="form-label" name="id" value="{{ $item->id }}">
                            <label for="room{{ $item->id }}" class="form-label">Room: </label>
                            <input type="text" name="room" id="room{{ $item->id }}" class="form-control"
                                value="{{ $item->room }}">
                        </div>

                        <div class="col-12">
                            <input type="hidden" class="form-label" name="id" value="{{ $item->id }}">
                            <label for="spot{{ $item->id }}" class="form-label">Spot: </label>
                            <input type="text" name="spot" id="spot{{ $item->id }}" class="form-control"
                                value="{{ $item->spot }}">
                        </div>

                    </div>
                </div>

                <div class="modal-footer justify-content-between  py-3">
                    <button type="button" class="btn cancel-btn" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark me-1"></i> Cancel
                    </button>
                    <button type="submit" class="btn save-btn">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Save Question
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
