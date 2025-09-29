<div class="modal fade" id="addHotlineModal" tabindex="-1" aria-labelledby="addHotlineLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header  text-white rounded-top-4" style="background-color: #35408e">
                <h5 class="modal-title fw-bold" id="addHotlineLabel">
                    <i class="fa-solid fa-file-circle-plus me-2"></i> Add New Hotline
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <form action="{{ route('admin.SubmitNewHotline') }}" method="POST">
                @csrf
                <div class="modal-body px-4 py-3 text-start">
                    <div class="row g-2">
                        <div class="col-12">
                            <label for="serial_number" class="form-label">Created By: </label>
                            <input type="text" name="serial_number" class="form-control" readonly
                                value="{{ Auth::user()->lname }}, {{ Auth::user()->fname }}">
                        </div>

                        <div class="col-12">
                            <label for="location" class="form-label">Location</label>
                            <input id="location" type="text" name="location" class="form-control" required>
                        </div>

                        <div class="col-12">
                            <label for="label" class="form-label">Label</label>
                            <input id="label" type="text" name="label" class="form-control" required>
                        </div>

                        <div class="col-12">
                            <label for="number" class="form-label">Contact No.</label>
                            <input id="number" type="text" name="number" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between  py-3">
                    <button type="button" class="btn cancel-btn" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark me-1"></i> Cancel
                    </button>
                    <button type="submit" class="btn save-btn">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Save Hotline
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
