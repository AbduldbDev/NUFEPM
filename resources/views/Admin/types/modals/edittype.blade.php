<div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}"
    aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header  text-white rounded-top-4" style="background-color: #35408e">
                <h5 class="modal-title fw-bold" id="editModalLabel{{ $item->id }}">
                    <i class="fa-solid fa-pen-to-square"></i> Edit Extinguisher Type
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('admin.UpdateType', $item->id) }}">
                @csrf
                @method('PUT')
                <div class="modal-body text-start">

                    <div class="row g-4">
                        <div class="col-12">
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <label for="name{{ $item->id }}" class="form-label">Type
                                Name</label>
                            <input type="text" name="name" id="name{{ $item->id }}" class="form-control"
                                value="{{ $item->name }}">
                        </div>
                        <div class="col-12">
                            <label for="color{{ $item->id }}" class="form-label">Color</label>
                            <input type="color" name="color" id="color{{ $item->id }}"
                                class="form-control form-control-color w-25" value="{{ $item->color }}">
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
