<div class="modal fade" id="addTypeModal" tabindex="-1" aria-labelledby="addTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header  text-white rounded-top-4" style="background-color: #35408e">
                <h5 class="modal-title fw-bold" id="addTypeModalLabel">
                    <i class="fa-solid fa-file-circle-plus me-2"></i> Add New Extinguisher Type
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <form action="{{ route('admin.SubmitNewType') }}" method="POST">
                @csrf
                <div class="modal-body px-4 py-3">
                    <div class="row g-4">
                        <div class="col-12">
                            <label for="serial_number" class="form-label">Created By</label>
                            <input type="text" name="serial_number" class="form-control bg-light" readonly
                                value="{{ Auth::user()->lname }}, {{ Auth::user()->fname }}">
                        </div>

                        <div class="col-12">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter type name"
                                required>
                        </div>

                        <div class="col-12">
                            <label for="color" class="form-label">Color</label>
                            <input type="color" name="color" class="w-25 form-control form-control-color" required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer justify-content-between py-3">
                    <button type="button" class="btn cancel-btn" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark me-1"></i> Cancel
                    </button>
                    <button type="submit" class="btn save-btn">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Save Type
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
