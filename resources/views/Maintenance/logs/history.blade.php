@extends('layouts.app')
@section('content')
    <div class="main-container container ">
        <div class="breadcrumb-container">
            <div class="breadcrumb-back">
                <a href="javascript:history.back()" class="back-button">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
            </div>
            <div class="breadcrumb-icon">
                <i class="fa-solid fa-qrcode"></i>
            </div>
            <nav class="breadcrumb-nav">
                <div class="breadcrumb-item">
                    <a href="{{ route('maintenance.ShowMaintenanceExtinguishersMenu') }}">Inspections</a>
                </div>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <div class="breadcrumb-item active">
                    History
                </div>
            </nav>
        </div>

        <div class="animated-container">
            <div class="border rounded-3 p-4 mb-2 bg-white position-relative">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h5 class="fw-bold  mb-0" style="color: #35408e">
                        <i class="fa-solid fa-fire-extinguisher me-2"></i>Extinguisher #{{ $details->extinguisher_id }}
                    </h5>
                </div>

                <div class="row">
                    <div class="col-12 col-md-4 ">
                        <div class="d-flex">
                            <i class="fa-solid fa-calendar-check me-2 mt-1 text-muted"></i>
                            <div>
                                <small class="text-muted">Last Maintenance</small><br>
                                <span class="fw-medium">
                                    {{ optional($details->last_maintenance ? \Carbon\Carbon::parse($details->last_maintenance) : null)->format('F d, Y') ?? 'N/A' }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 ">
                        <div class="d-flex ">
                            <i class="fa-solid fa-calendar-plus me-2 mt-1 text-muted"></i>
                            <div>
                                <small class="text-muted">Next Maintenance</small><br>
                                <span class="fw-medium text-danger">
                                    {{ optional($details->next_maintenance ? \Carbon\Carbon::parse($details->next_maintenance) : null)->format('F d, Y') ?? 'N/A' }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 ">
                        <div class="d-flex">
                            <i class="fa-solid fa-bars-progress me-2 mt-1 text-muted"></i>
                            <div>
                                <small class="text-muted">Current Status</small><br>
                                @php
                                    $status = $details->status;
                                    $badgeClass = match ($status) {
                                        'Good' => 'success',
                                        'Overcharged' => 'primary',
                                        'Undercharged', 'Retired' => 'danger',
                                        default => 'secondary',
                                    };
                                @endphp
                                <span class="badge bg-{{ $badgeClass }} px-3 py-2 rounded-pill">{{ $status }}</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <h1 class="text-center text-dark my-3 fs-5 fw-bold">INSPECTION LOGS</h1>
            @forelse ($items as $index => $item)
                <div class="card mb-3 shadow-sm animated-container bg-light" style="border-left: 4px solid #35408e">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h6 class="card-title mb-2">
                                <strong>#{{ $items->firstItem() + $index }}</strong>
                            </h6>
                            <span
                                class="badge px-3 py-2 rounded-pill {{ $item->status === 'Good'
                                    ? 'bg-success'
                                    : ($item->status === 'Undercharged'
                                        ? 'bg-danger'
                                        : ($item->status === 'Overcharged'
                                            ? 'bg-primary'
                                            : ($item->status === 'Retired'
                                                ? 'bg-secondary'
                                                : 'bg-light text-dark'))) }}">
                                {{ $item->status ?? 'N/A' }}
                            </span>
                        </div>

                        <p class="mb-1"><strong>Equipment ID:</strong>
                            {{ $item->extinguisher->extinguisher_id ?? 'N/A' }}</p>
                        <p class="mb-1"><strong>Inspected By:</strong>
                            @if ($item->user && $item->user->lname && $item->user->fname)
                                {{ $item->user->lname }}, {{ $item->user->fname }}
                            @else
                                N/A
                            @endif
                        </p>
                        <p class="mb-1"><strong>Inspected At:</strong>
                            {{ optional($item->inspected_at ? \Carbon\Carbon::parse($item->inspected_at) : null)->format('F d, Y h:i a') ?? 'N/A' }}
                        </p>

                        <div class="mt-3 text-end">
                            <a href="{{ url('/Logs/History/Answer/' . $item->id) }}" class="btn add-new-btn btn-sm">
                                <i class="fa-regular fa-eye"></i> View Answers
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-warning text-center">No inspection records found.</div>
            @endforelse
            <div class="  d-flex flex-wrap justify-content-between align-items-center">

                <div class="mb-2 mt-2 small text-muted">
                    Showing <b>{{ $items->firstItem() }}</b> to <b>{{ $items->lastItem() }}</b> of
                    <b>{{ $items->total() }}</b> Items
                </div>

                <div class="mt-3">
                    {{ $items->onEachSide(1)->links() }}
                </div>
            </div>
        </div>
    @endsection
    @push('css')
        <link href="{{ asset('css/custom.css') }}?v={{ time() }}" rel="stylesheet">
        <link href="{{ asset('css/components/submenu.css') }}?v={{ time() }}" rel="stylesheet">
    @endpush
