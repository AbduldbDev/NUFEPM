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
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <nav class="breadcrumb-nav">
                <div class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Home</a>
                </div>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <div class="breadcrumb-item ">
                    <a href="{{ route('admin.ShowSOSReports') }}">Incident Reports</a>
                </div>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <div class="breadcrumb-item active ">
                    <span>Details</span>
                </div>
            </nav>
        </div>

        <form action="{{ route('admin.UpdateSOS') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @METHOD('PUT')
            <div class="row">
                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header text-white d-flex align-items-center py-3"
                            style="background-color: #a91d1d;">
                            <i class="fa-solid fa-circle-exclamation me-2"></i>
                            <h5 class="mb-0">Incident Details</h5>
                        </div>
                        <div class="card-body px-4">
                            <div class="form-floating mb-3">
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <input id="location" type="text" name="location" class="form-control"
                                    placeholder="Location" readonly value="{{ $item->location }}">
                                <label for="location">Location</label>
                            </div>

                            <div class="form-floating mb-3">
                                <textarea id="description" name="description" class="form-control" style="height: 120px" placeholder="Description"
                                    readonly>{{ $item->location }}</textarea>
                                <label for="description">Description</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="datetime-local" id="date_time" name="date_time" class="form-control" readonly
                                    value="{{ $item->date_time }}"></input>
                                <label for="description">Date & Time</label>
                            </div>

                            <div class="form-floating mb-3">
                                <select name="status" id="status" class="form-control">
                                    <option value="pending" {{ $item->status == 'pending' ? 'selected' : '' }}>
                                        Pending
                                    </option>

                                    <option value="inprogress" {{ $item->status == 'inprogress' ? 'selected' : '' }}>
                                        Inprogress
                                    </option>

                                    <option value="completed" {{ $item->status == 'completed' ? 'selected' : '' }}>
                                        Completed
                                    </option>
                                </select>

                                <label for="status">Status</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header text-white d-flex align-items-center py-3"
                            style="background-color: #a91d1d;">
                            <i class="fa-solid fa-circle-exclamation me-2"></i>
                            <h5 class="mb-0">Incident Images</h5>
                        </div>
                        <div class="card-body px-4">
                            <div class="card-body px-4">
                                <div id="preview-container" class="row g-2">
                                    @foreach (json_decode($item->image, true) as $img)
                                        <div class="col-6 col-md-4 col-lg-3">
                                            <div class="ratio ratio-4x3 rounded border overflow-hidden">
                                                <img src="{{ $img }}" width="auto"
                                                    class="w-100 h-100 object-fit-cover">
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row
                                                    mb-3">
                <div class="col-12 col-lg-6">
                    <button type="submit" class="btn red-btn mt-2 w-100">
                        <i class="fa-solid fa-paper-plane"></i> Update Incident Report
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('css')
    <link href="{{ asset('css/custom.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/components/submenu.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
