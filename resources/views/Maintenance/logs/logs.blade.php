@extends('layouts.app')
@section('content')
    @include('layouts.components.alerts')
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
                    <a href="{{ route('maintenance.ShowMaintenanceExtinguishersMenu') }}">Fire Equipments</a>
                </div>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <div class="breadcrumb-item active">
                    <span>Recent Inspections</span>
                </div>
            </nav>
        </div>

        <div>
            @forelse ($items as $index => $item)
                @php
                    $locationParts = array_filter([
                        $item->extinguisher->location->building ?? null,
                        $item->extinguisher->location->floor ?? null,
                        $item->extinguisher->location->room ?? null,
                        $item->extinguisher->location->spot ?? null,
                    ]);

                    $locationString = !empty($locationParts) ? implode(', ', $locationParts) : 'N/A';
                @endphp
                <div class="card mb-3 shadow-sm animated-container" style="border-left: 4px solid #35408e">
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
                        <p class="mb-1"><strong>Location: </strong>{{ $locationString }}</p>
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
