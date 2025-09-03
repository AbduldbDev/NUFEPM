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
                    <a href="{{ route('maintenance.ShowMaintenanceExtinguishersMenu') }}">Fire Equipments</a>
                </div>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <div class="breadcrumb-item active">
                    <span>Upcoming Inspection</span>
                </div>
            </nav>
        </div>

        <div>
            @forelse ($items as $index => $item)
                @php
                    $locationParts = array_filter([
                        $item->location->building ?? null,
                        $item->location->floor ?? null,
                        $item->location->room ?? null,
                        $item->location->spot ?? null,
                    ]);

                    $locationString = !empty($locationParts) ? implode(', ', $locationParts) : 'N/A';
                @endphp
                <div class="card mb-3 shadow-sm animated-container" style="border-left: 4px solid #35408e">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h6 class="card-title mb-2">
                                <strong>#{{ $items->firstItem() + $index }}</strong>
                            </h6>

                        </div>

                        <p class="mb-1"><strong>Equipment ID:</strong>
                            {{ $item->extinguisher_id ?? 'N/A' }}</p>
                        <p class="mb-1"><strong>Location: </strong>{{ $locationString }}</p>

                        <p class="mb-1"><strong>Last Maintenance:</strong>
                            {{ optional($item->last_maintenance ? \Carbon\Carbon::parse($item->last_maintenance) : null)->format('F d, Y') ?? 'N/A' }}
                        </p>

                        @php
                            $next = $item->next_maintenance ? Carbon\Carbon::parse($item->next_maintenance) : null;
                            $remainingDays = $next ? ceil(now()->floatDiffInDays($next, false)) : null;
                        @endphp

                        <p class="mb-1">
                            <strong>Next Maintenance:</strong>
                            {{ $next ? $next->format('F d, Y') : 'N/A' }}

                            @if (!is_null($remainingDays))
                                <br>
                                <span
                                    class="{{ $remainingDays < 0 ? 'text-danger' : ($remainingDays <= 7 ? 'text-success' : '') }}">
                                    ({{ $remainingDays < 0
                                        ? number_format(abs($remainingDays), 0) . ' day(s) overdue'
                                        : number_format($remainingDays, 0) . ' day(s) remaining' }})
                                </span>
                                {{-- <span>{{ $remainingDays }}</span> --}}
                            @endif
                        </p>

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
    </div>
@endsection
@push('css')
    <link href="{{ asset('css/custom.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/components/submenu.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
