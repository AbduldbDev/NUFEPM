<div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}"
    aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header  text-white rounded-top-4" style="background-color: #35408e">
                <h5 class="modal-title fw-bold" id="editModalLabel{{ $item->id }}">
                    <i class="fa-solid fa-pen-to-square"></i> Edit Question
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('admin.UpdateQuestion', $item->id) }}">
                @csrf
                @method('PUT')

                <div class="modal-body text-start">
                    <div class="row g-4">
                        <div class="mb-3">
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <label for="question{{ $item->id }}" class="form-label">Question: <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="question" id="question{{ $item->id }}" class="form-control"
                                value="{{ $item->question }}">
                        </div>

                        <div class="mb-3">
                            <label for="interval{{ $item->id }}" class="form-label">Maintence Interval: <span
                                    class="text-danger">*</span></label>
                            <input type="number" name="interval" id="interval{{ $item->id }}" class="form-control"
                                value="{{ $item->maintenance_interval }}">
                        </div>

                        <div class="mb-3">
                            <label for="fail{{ $item->id }}" class="form-label">Fail Schedule: <span
                                    class="text-danger">*</span></label>
                            <input type="number" name="fail" id="fail{{ $item->id }}" class="form-control"
                                value="{{ $item->fail_reschedule_days }}">
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
