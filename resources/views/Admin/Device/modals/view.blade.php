<div class="modal fade" id="ViewCertModal{{ $item->id }}" tabindex="-1"
    aria-labelledby="ViewCertModal{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header  text-white rounded-top-4" style="background-color: #35408e">
                <h5 class="modal-title fw-bold" id="ViewCertModal{{ $item->id }}">
                    <i class="fa-solid fa-pen-to-square"></i> View Certificate
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <div class="modal-body text-start">
                <div class="row g-4">
                    <div class="col-12 d-flex justify-content-center">
                        <a href="{{ '/storage/' . $item->file_path }}" target="_blank" class="w-100">
                            <div class="ratio ratio-16x9 w-100">
                                <iframe src="{{ '/storage/' . $item->file_path }}" class="w-100 h-100" allowfullscreen>
                                </iframe>
                            </div>
                        </a>
                    </div>

                </div>
            </div>

            <div class="modal-footer justify-content-end  py-3">
                <a href="{{ '/storage/' . $item->file_path }}" target="_blank" class="btn  add-new-btn">
                    <i class="fa-solid fa-up-right-from-square me-1"></i> Open in New Tab
                </a>
                <button type="submit" class="btn save-btn" data-bs-dismiss="modal">
                    <i class="fa-solid fa-floppy-disk me-1"></i>Close
                </button>

            </div>

        </div>
    </div>
</div>
