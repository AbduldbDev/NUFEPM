<div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}"
    aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header  text-white rounded-top-4" style="background-color: #35408e">
                <h5 class="modal-title fw-bold" id="editModalLabel{{ $item->id }}">
                    <i class="fa-solid fa-pen-to-square"></i> Edit Emergency Plans
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('admin.UpdateEmergencyPlan') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-body text-start">
                    <div class="row g-2">
                        <div class="col-12">
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <label for="pdf{{ $item->id }}" class="form-label">Update PDF</label>
                            <input type="file" name="pdf" id="pdf{{ $item->id }}" class="form-control"
                                accept="application/pdf" required>

                            @if ($item->pdf)
                                <div class="mt-2">
                                    <small class="text-muted ">
                                        Current: <a href="{{ $item->pdf }}" target="_blank">View PDF</a>
                                    </small>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="modal-footer justify-content-between  py-3">
                    <button type="button" class="btn cancel-btn" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark me-1"></i> Cancel
                    </button>
                    <button type="submit" class="btn save-btn">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Save Guide
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
