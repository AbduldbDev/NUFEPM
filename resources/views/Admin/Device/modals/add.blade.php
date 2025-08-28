<div class="modal fade" id="addLocationModal" tabindex="-1" aria-labelledby="addLocationLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header  text-white rounded-top-4" style="background-color: #35408e">
                <h5 class="modal-title fw-bold" id="addLocationLabel">
                    <i class="fa-solid fa-file-circle-plus me-2"></i> Add New Certification
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <form action="{{ route('admin.StoreCertificate') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body px-4 py-3 text-start">
                    <div class="row g-2">
                        <input type="hidden" name="equipment_id" value="{{ $details->id }}">
                        <div class="col-12">
                            <label for="serial_number" class="form-label">Updated By: </label>
                            <input type="text" name="serial_number" class="form-control" readonly
                                value="{{ Auth::user()->lname }}, {{ Auth::user()->fname }}">
                        </div>

                        <div class="col-12">
                            <label for="certificate_no" class="form-label">Certificate No: <span
                                    class="text-danger">*</span></label>
                            <input id="certificate_no" type="text" name="certificate_no" class="form-control"
                                required>
                        </div>

                        <div class="col-12">
                            <label for="issue_date" class="form-label">Issue Date</label>
                            <input id="issue_date" type="date" name="issue_date" class="form-control">
                        </div>

                        <div class="col-12">
                            <label for="expiry_date" class="form-label">Expiration Date</label>
                            <input id="expiry_date" type="date" name="expiry_date" class="form-control">
                        </div>

                        <div class="col-12">
                            <label for="file_path" class="form-label">Certificate</label>
                            <input id="file_path" type="file" name="file_path" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between  py-3">
                    <button type="button" class="btn cancel-btn" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark me-1"></i> Cancel
                    </button>
                    <button type="submit" class="btn save-btn">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Save Certificate
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
