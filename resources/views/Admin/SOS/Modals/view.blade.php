<div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}"
    aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header  text-white rounded-top-4" style="background-color: #35408e">
                <h5 class="modal-title fw-bold" id="editModalLabel{{ $item->id }}">
                    <i class="fa-solid fa-pen-to-square"></i> View Incident
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <div class="modal-body text-start">
                <div class="row g-2">
                    <div class="col-12">
                        <label for="title{{ $item->id }}" class="form-label">Submitted By: <span
                                class="text-danger">*</span></label>
                        <input type="text" name="title" id="title{{ $item->id }}" class="form-control"
                            value="{{ $item->user->lname }}, {{ $item->user->fname }}" readonly>
                    </div>
                    <div class="col-12">
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        <label for="title{{ $item->id }}" class="form-label">Location: <span
                                class="text-danger">*</span></label>
                        <input type="text" name="title" id="title{{ $item->id }}" class="form-control"
                            value="{{ $item->location }}" readonly>
                    </div>

                    <div class="col-12">
                        <label for="content{{ $item->id }}" class="form-label">Description:</label>
                        <textarea name="content" id="content{{ $item->id }}" rows="3" class="form-control" readonly>{{ $item->description }}</textarea>
                    </div>

                    <div class="col-12">
                        <a href="{{ $item->image }}" target="_blank">
                            <img src="{{ $item->image }}" alt="Incident Image" class="img-fluid rounded border"
                                style="height: 200px; object-fit: cover;">
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
