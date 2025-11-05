<div class="modal fade" id="addQuestionModal" tabindex="-1" aria-labelledby="addQuestionLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header  text-white rounded-top-4" style="background-color: #35408e">
                <h5 class="modal-title fw-bold" id="addQuestionLabel">
                    <i class="fa-solid fa-file-circle-plus me-2"></i> Add New Question
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <form action="{{ route('admin.SubmitNewQuestion') }}" method="POST">
                @csrf
                <div class="modal-body px-4 py-3 text-start">
                    <div class="row g-2">
                        <input class=" form-control" readonly type="hidden" name="type" id="type"
                            value="{{ $type }}">
                        <div class="col-12">
                            <label for="created_by" class="form-label">Created By: </label>
                            <input id="created_by" type="text" name="serial_number" class="form-control" readonly
                                value="{{ Auth::user()->lname }}, {{ Auth::user()->fname }}">
                        </div>

                        <div class="col-12">
                            <label for="interval" class="form-label">Maintence Interval: <span
                                    class="text-danger">*</span></label>
                            <input id="interval" type="number" name="interval" class="form-control" required>
                        </div>

                        <div class="col-12">
                            <label for="fail" class="form-label">Fail Schedule: <span
                                    class="text-danger">*</span></label>
                            <input id="fail" type="number" name="fail" class="form-control" required>
                        </div>

                        <div class="col-12">
                            <label for="question" class="form-label">Questions: <span
                                    class="text-danger">*</span></label>
                            <textarea name="question" class="form-control" id="question" cols="30" rows="5" required></textarea>
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
