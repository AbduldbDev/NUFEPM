@extends('layouts.app')
@section('content')
    @include('layouts.components.alerts')
    <div class="main-container container ">
        <div class="title">
            <span class="menu-title-icon"><i class="fa-solid fa-qrcode"></i></span> &nbsp;

            <span class="crumb">
                <span class="breadcrumbs"><a
                        href="{{ route('maintenance.ShowMaintenanceExtinguishersMenu') }}">Inspections</a> &gt; </span>
            </span>

            <span class="breadcrumbs">Upcoming Inspection</span>
        </div>
        <hr>

        <div>
            @forelse ($items as $index => $item)
                <div class="card mb-3 shadow-sm animated-container" style="border-left: 4px solid #35408e">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h6 class="card-title mb-2">
                                <strong>#{{ $items->firstItem() + $index }}</strong>
                            </h6>

                        </div>

                        <p class="mb-1"><strong>Extinguisher ID:</strong>
                            {{ $item->extinguisher_id ?? 'N/A' }}</p>
                        <p class="mb-1"><strong>Last Maintenance:</strong>
                            {{ optional($item->last_maintenance ? \Carbon\Carbon::parse($item->last_maintenance) : null)->format('F d, Y') ?? 'N/A' }}
                        </p>
                        @php

                            $next = $item->next_maintenance ? Carbon\Carbon::parse($item->next_maintenance) : null;
                            $remainingDays = $next ? now()->diffInDays($next, false) : null;
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
