@extends('layouts.app')
@section('content')
    <div class="main-container container">
        <div class="breadcrumb-container">
            <div class="breadcrumb-back">
                <a href="javascript:history.back()" class="back-button">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
            </div>
            <div class="breadcrumb-icon">
                <i class="fa-solid fa-ticket"></i>
            </div>
            <nav class="breadcrumb-nav">
                <div class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Home</a>
                </div>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <div class="breadcrumb-item">
                    <a href="{{ route('admin.ShowAllTickets') }}"> All Tickets</a>
                </div>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <div class="breadcrumb-item active">
                    <span>Details</span>
                </div>
            </nav>
        </div>

        <form action="{{ route('admin.UpdateTicketUser') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @METHOD('PUT')
            <div class="row">
                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header text-white d-flex align-items-center py-3"
                            style="background-color: #35408e;">
                            <i class="fa-solid fa-circle-exclamation me-2"></i>
                            <h5 class="mb-0">Ticket Details</h5>
                        </div>
                        <div class="card-body px-4">
                            <div class="form-floating mb-3">
                                <input type="hidden" name="id" value="{{ $detail->id }}">
                                <input id="ticket_id" type="text" name="ticket_id" class="form-control"
                                    value="{{ $detail->ticket_id }}" readonly>
                                <label for="ticket_id">Ticket No</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input id="submitted_by" type="text" name="submitted_by" class="form-control"
                                    value="{{ $detail->creator->lname }}, {{ $detail->creator->fname }}" readonly>
                                <label for="submitted_by">Created By</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input id="submitted_by" type="text" name="submitted_by" class="form-control"
                                    value="{{ $detail->assignee->lname }}, {{ $detail->assignee->fname }}" readonly>
                                <label for="assignee_to">Assigned To</label>
                            </div>

                            <div class="form-floating mb-3">
                                <textarea id="description" name="description" class="form-control" style="height: 120px" placeholder="Description"
                                    readonly>{{ $detail->description }}</textarea>
                                <label for="description">Description</label>
                            </div>

                            <div class="form-floating mb-3">
                                <textarea id="instructions" name="instructions" class="form-control" style="height: 120px" placeholder="instructions"
                                    readonly>{{ $detail->instructions }}</textarea>
                                <label for="instructions">Instructions</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="datetime-local" id="submitted_at" name="submitted_at" class="form-control"
                                    value="{{ $detail->created_at }}" readonly></input>
                                <label for="submitted_at">Submitted At</label>
                            </div>

                            @if ($detail->completed_at)
                                <div class="form-floating mb-3">
                                    <input type="datetime-local" id="completed_at" name="completed_at" class="form-control"
                                        value="{{ $detail->completed_at }}"></input>
                                    <label for="completed_at">Completed At</label>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header text-white d-flex align-items-center py-3"
                            style="background-color: #35408e;">
                            <i class="fa-solid fa-circle-exclamation me-2"></i>
                            <h5 class="mb-0">Ticket Images</h5>
                        </div>

                        <div class="card-body px-4">
                            {{-- Remarks --}}
                            <div class="form-floating mb-3">
                                <textarea id="Remarks" name="remarks" class="form-control" style="height: 120px" placeholder="Remarks"
                                    {{ !empty($detail->remarks) ? 'readonly' : '' }} required>{{ old('Remarks', $detail->remarks) }}</textarea>
                                <label for="Remarks">Remarks</label>
                            </div>

                            @if (empty($detail->images))
                                <div class="form-floating mb-3">
                                    <input id="images" type="file" name="images[]" class="form-control"
                                        accept="image/*" multiple required>
                                    <label for="images">Upload Proof</label>
                                </div>
                            @endif

                            {{-- Preview Container --}}
                            <div id="preview-container" class="row g-2">
                                @if (!empty($detail->images))
                                    @foreach (json_decode($detail->images, true) as $img)
                                        <div class="col-6 col-md-4 col-lg-3">
                                            <div class="ratio ratio-4x3 rounded border overflow-hidden">
                                                <img src="{{ $img }}" class="w-100 h-100 object-fit-cover">
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row mb-3">
                <div class="col-12 col-lg-6">
                    <button type="submit" class="btn save-btn mt-2 w-100">
                        <i class="fa-solid fa-paper-plane"></i> Complete Ticket
                    </button>
                </div>
            </div>
        </form>
    </div>
    <script>
        document.getElementById('images').addEventListener('change', function(event) {
            let preview = document.getElementById('preview-container');
            preview.innerHTML = "";

            Array.from(event.target.files).forEach(file => {
                if (!file.type.startsWith("image/")) return;

                let reader = new FileReader();
                reader.onload = function(e) {
                    let col = document.createElement("div");
                    col.classList.add("col-6", "col-md-4", "col-lg-3");

                    col.innerHTML = `
                <div class="ratio ratio-4x3 rounded border overflow-hidden">
                    <img src="${e.target.result}" class="w-100 h-100 object-fit-cover">
                </div>
            `;
                    preview.appendChild(col);
                };
                reader.readAsDataURL(file);
            });
        });
    </script>
@endsection

@push('css')
    <link href="{{ asset('css/custom.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/components/submenu.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
