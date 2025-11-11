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
                    <a href="{{ url('/Tickets') }}"> All Tickets</a>
                </div>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <div class="breadcrumb-item active">
                    <span>Details</span>
                </div>
            </nav>
        </div>

        <form action="{{ route('admin.CreateNewTicket') }}" method="POST" enctype="multipart/form-data">
            @csrf
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
                                <select id="assignee_to" name="assignee_to" class="form-select">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">
                                            {{ $user->lname }}, {{ $user->fname }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="assignee_to">Assigned To</label>
                            </div>

                            <div class="form-floating mb-3">
                                <textarea id="description" name="description" class="form-control" style="height: 120px" placeholder="Description"></textarea>
                                <label for="description">Description</label>
                            </div>

                            <div class="form-floating mb-3">
                                <textarea id="instructions" name="instructions" class="form-control" style="height: 120px" placeholder="instructions"></textarea>
                                <label for="instructions">Instructions</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12 col-lg-6">
                    <button type="submit" class="btn save-btn mt-2 w-100">
                        <i class="fa-solid fa-paper-plane"></i> Submit New Ticket
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
