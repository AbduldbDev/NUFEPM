@extends('layouts.app')
@section('content')
    @include('layouts.components.alerts')
    <div class="main-container container ">
        <div class="title">
            <span class="menu-title-icon"><i class="fa-solid fa-qrcode"></i></span> &nbsp;
            <span class="crumb">
                <span class="breadcrumbs"><a href="{{ route('dashboard') }}">Inspections</a> &gt; </span>
            </span>

            <span class="breadcrumbs">Fire Extinguishers</span>
        </div>
        <hr>

        <div class="card shadow-sm rounded-3 animated-container">
            <div class="card-body">
                <h5 class="card-title mb-2 text-center fw-bold text-danger">Extinguisher Details</h5>

                <div class="mb-2">
                    <strong>Extinguishers ID:</strong>
                    <div class="text-muted">{{ $extinguisher->extinguisher_id }}</div>
                </div>

                <div class="mb-2">
                    <strong>Location:</strong>
                    <div class="text-muted">
                        {{ collect([
                            $extinguisher->location->building,
                            $extinguisher->location->floor,
                            $extinguisher->location->room,
                            $extinguisher->location->spot,
                        ])->filter()->join(', ') }}
                    </div>
                </div>

                <div class="mb-2">
                    <strong>Type:</strong>
                    <div style="color: {{ $extinguisher->type->color ?? '#000000' }}">
                        {{ $extinguisher->type->name ?? 'N/A' }}
                    </div>
                </div>

                <div class="mb-2">
                    <strong>Serial Number:</strong>
                    <div class="text-muted">{{ $extinguisher->serial_number }}</div>
                </div>

                <div class="mb-2">
                    <strong>Capacity:</strong>
                    <div class="text-muted">{{ $extinguisher->capacity }}</div>
                </div>

                <div class="mb-2">
                    <strong>Last Inspection:</strong>
                    <div class="text-muted">
                        {{ \Carbon\Carbon::parse($extinguisher->last_maintenance)->format('F d, Y') }}</div>
                </div>

                @php
                    use Carbon\Carbon;

                    $nextMaintenance = Carbon::parse($extinguisher->next_maintenance);
                    $today = Carbon::today();
                    $daysDiff = $today->diffInDays($nextMaintenance, false);

                    $showButton = $today->greaterThanOrEqualTo($nextMaintenance->copy()->subDays(7));

                    $dateClass = '';
                    if ($daysDiff <= 3 && $daysDiff >= 0) {
                        $dateClass = 'text-warning';
                    } elseif ($daysDiff < 0) {
                        $dateClass = 'text-danger';
                    } elseif ($daysDiff <= 7) {
                        $dateClass = 'text-success';
                    }
                @endphp

                <div class="mb-2">
                    <strong>Next Inspection:</strong>
                    <div class="text-muted">
                        <p class="fw-semibold {{ $dateClass }}">{{ $nextMaintenance->format('F d, Y') }}</p>
                    </div>
                </div>

                @if ($showButton)
                    <div class="mb-2">
                        <a href="{{ url('/Inspection/Start/' . $extinguisher->extinguisher_id) }}"
                            class="btn save-btn w-100 mb-2">
                            <i class="fa-solid fa-wrench"></i> Start Inspection
                        </a>
                    </div>
                @endif

                <div class="mb-2">
                    <a href="{{ url('/Logs/History/' . $extinguisher->id) }}" class="btn add-new-btn w-100"><i
                            class="fa-solid fa-folder-open"></i> View
                        Inspection Logs</a>
                </div>
            </div>
        </div>
    @endsection
    @push('css')
        <link href="{{ asset('css/custom.css') }}?v={{ time() }}" rel="stylesheet">
        <link href="{{ asset('css/components/submenu.css') }}?v={{ time() }}" rel="stylesheet">
    @endpush
