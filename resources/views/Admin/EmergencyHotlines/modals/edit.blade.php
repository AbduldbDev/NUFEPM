<div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}"
    aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header  text-white rounded-top-4" style="background-color: #35408e">
                <h5 class="modal-title fw-bold" id="editModalLabel{{ $item->id }}">
                    <i class="fa-solid fa-pen-to-square"></i> Edit Emergency Hotline
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('admin.UpdateHotline') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-body text-start">
                    <div class="row g-2">
                        <div class="col-12">
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <label for="title{{ $item->id }}" class="form-label">Location: <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="location" id="title{{ $item->id }}" class="form-control"
                                value="{{ $item->location }}" required>
                        </div>
                        <div class="col-12">
                            <label for="label{{ $item->id }}" class="form-label">Name: <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="label" id="label{{ $item->id }}" class="form-control"
                                value="{{ $item->label }}" required>
                        </div>

                        <div class="col-12">
                            <label for="contact{{ $item->id }}" class="form-label">Contact No.: <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="number" id="contact{{ $item->id }}" class="form-control"
                                value="{{ $item->number }}" required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer justify-content-between  py-3">
                    <button type="button" class="btn cancel-btn" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark me-1"></i> Cancel
                    </button>
                    <button type="submit" class="btn save-btn">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Update Hotline
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
