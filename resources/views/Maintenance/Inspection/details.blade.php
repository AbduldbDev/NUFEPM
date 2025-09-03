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
                    <span class="breadcrumbs"><a href="{{ route('dashboard') }}">Home</a> </span>
                </div>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <div class="breadcrumb-item active">
                    {{ $extinguisher->extinguisher_id }}
                </div>
            </nav>
        </div>

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
                    <strong>Status:</strong>
                    <div class="text-muted"> <span
                            class="badge px-3 py-1 rounded-pill {{ $extinguisher->status === 'Good'
                                ? 'bg-success'
                                : ($extinguisher->status === 'Undercharged'
                                    ? 'bg-danger'
                                    : ($extinguisher->status === 'Overcharged'
                                        ? 'bg-primary'
                                        : ($extinguisher->status === 'Retired'
                                            ? 'bg-secondary'
                                            : 'bg-light text-dark'))) }}">
                            {{ $extinguisher->status ?? 'N/A' }}
                        </span></div>
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

                @if ($extinguisher->category === 'Extinguisher')
                    <div class="mb-2">
                        <a href="{{ url('/Refill/Form/' . $extinguisher->id) }}" class="btn red-btn w-100"><i
                                class="fa-solid fa-fire-extinguisher"></i>
                            Refill Extinguisher</a>
                    </div>
                @endif
            </div>
        </div>
    @endsection
    @push('css')
        <link href="{{ asset('css/custom.css') }}?v={{ time() }}" rel="stylesheet">
        <link href="{{ asset('css/components/submenu.css') }}?v={{ time() }}" rel="stylesheet">
    @endpush
