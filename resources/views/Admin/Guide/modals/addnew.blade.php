<div class="modal fade" id="addGuideModal" tabindex="-1" aria-labelledby="addGuideLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header  text-white rounded-top-4" style="background-color: #35408e">
                <h5 class="modal-title fw-bold" id="addGuideLabel">
                    <i class="fa-solid fa-file-circle-plus me-2"></i> Add New Guide
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <form method="POST" action="{{ route('admin.AddNewGuide') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body px-4 py-3 text-start">
                    <div class="row g-2">

                        <input type="hidden" name="type" value="{{ $type }}">
                        <div class="col-12">
                            <label for="title" class="form-label">Title: <span class="text-danger">*</span></label>
                            <input type="text" id="title" name="title" class="form-control" required>
                        </div>

                        <div class="col-12">
                            <label for="content" class="form-label">Content</label>
                            <textarea id="content" name="content" rows="3" class="form-control" required></textarea>
                        </div>

                        <div class="col-12">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" id="image" name="image" class="form-control" required>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-between  py-3">
                    <button type="button" class="btn cancel-btn" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark me-1"></i> Cancel
                    </button>
                    <button type="submit" class="btn save-btn">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Update Guide
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
