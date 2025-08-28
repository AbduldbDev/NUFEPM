<div class="modal fade" id="ViewCertModal{{ $item->id }}" tabindex="-1"
    aria-labelledby="ViewCertModal{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
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
                    <div class="col-12 text-center">
                        <img class="border-1 " src="{{ '/storage/' . $item->file_path }}" alt="">
                    </div>

                </div>
            </div>

            <div class="modal-footer justify-content-end  py-3">
                {{-- <button type="button" class="btn cancel-btn" data-bs-dismiss="modal">
                    <i class="fa-solid fa-xmark me-1"></i> Cancel
                </button> --}}
                <button type="submit" class="btn save-btn" data-bs-dismiss="modal">
                    <i class="fa-solid fa-floppy-disk me-1"></i>Close
                </button>
            </div>

        </div>
    </div>
</div>
