<div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header text-white rounded-top-4" style="background-color: #35408e">
                <h5 class="modal-title fw-bold" id="editModalLabel{{ $item->id }}">
                    <i class="fa-solid fa-pen-to-square"></i> Edit Certificate
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('admin.UpdateCertificate', $item->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-body text-start">
                    <div class="row g-4">
                        <div class="col-12">
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <label for="certificate_no{{ $item->id }}" class="form-label">Certificate No.:</label>
                            <input type="text" name="certificate_no" id="certificate_no{{ $item->id }}"
                                class="form-control" value="{{ $item->certificate_no }}" required>
                        </div>

                        <div class="col-12">
                            <label for="issue_date{{ $item->id }}" class="form-label">Issue Date:</label>
                            <input type="date" name="issue_date" id="issue_date{{ $item->id }}"
                                class="form-control" value="{{ $item->issue_date }}" required>
                        </div>

                        <div class="col-12">
                            <label for="expiry_date{{ $item->id }}" class="form-label">Expiry Date:</label>
                            <input type="date" name="expiry_date" id="expiry_date{{ $item->id }}"
                                class="form-control" value="{{ $item->expiry_date }}" required>
                        </div>

                        <div class="col-12">
                            <label for="attachment{{ $item->id }}" class="form-label">Attachment:</label>
                            <input type="file" name="file_path" id="attachment{{ $item->id }}"
                                class="form-control">
                        </div>
                    </div>
                </div>

                <div class="modal-footer justify-content-between py-3">
                    <button type="button" class="btn cancel-btn" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark me-1"></i> Cancel
                    </button>
                    <button type="submit" class="btn save-btn">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Save Certification
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
