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
                <i class="fa-solid fa-clock-rotate-left"></i>
            </div>
            <nav class="breadcrumb-nav">
                <div class="breadcrumb-item">
                    <a href="{{ route('admin.ShowAdminInspectionMenu') }}">Inspections</a>
                </div>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <div class="breadcrumb-item">
                    <a href="{{ route('admin.ShowInspectionExtinguishers') }}">All Extinguishers</a>
                </div>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <div class="breadcrumb-item active">
                    {{ $details->extinguisher_id }}
                </div>
            </nav>
        </div>
        <div class="table-container  animated-container">
            <div class="border rounded-3 p-4 mb-4 bg-light position-relative">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h5 class="fw-bold  mb-0" style="color: #35408e">
                        <i class="fa-solid fa-fire-extinguisher me-2"></i>Extinguisher #{{ $details->extinguisher_id }}
                    </h5>
                </div>

                <div class="row">
                    <div class="col-12 col-md-4 ">
                        <div class="d-flex ">
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
            <div class="row mt-3 mb-3">
                <div class="col-12 col-lg-3">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fas fa-search"></i></span>
                        <input type="text" id="tableSearch" class="form-control" placeholder="Search..."
                            onkeyup="filterTable()">
                    </div>
                </div>
            </div>

            <div class="table-responsive mt-3">
                <table class="sortable-table table table-responsive" id="sortableTable">
                    <thead>
                        <tr>
                            <thead>
                                <tr>
                                    <th class="text-center sortable align-middle" data-index="0" onclick="sortTable(this)">
                                        # <span class="sort-icons"><span class="asc">▲</span><span
                                                class="desc">▼</span></span>
                                    </th>
                                    <th class="text-center sortable align-middle" data-index="1" onclick="sortTable(this)">
                                        Equipment  Id<span class="sort-icons"><span class="asc">▲</span><span
                                                class="desc">▼</span></span>
                                    </th>
                                    <th class="text-center sortable align-middle" data-index="2" onclick="sortTable(this)">
                                        Inspected By<span class="sort-icons"><span class="asc">▲</span><span
                                                class="desc">▼</span></span>
                                    </th>
                                    <th class="text-center sortable align-middle" data-index="2" onclick="sortTable(this)">
                                        Inspected At<span class="sort-icons"><span class="asc">▲</span><span
                                                class="desc">▼</span></span>
                                    </th>
                                    <th class="text-center sortable align-middle" data-index="2" onclick="sortTable(this)">
                                        Next Due<span class="sort-icons"><span class="asc">▲</span><span
                                                class="desc">▼</span></span>
                                    </th>
                                    <th class="text-center sortable align-middle" data-index="2" onclick="sortTable(this)">
                                        Completion Time<span class="sort-icons"><span class="asc">▲</span><span
                                                class="desc">▼</span></span>
                                    </th>
                                    <th class="text-center sortable align-middle" data-index="2" onclick="sortTable(this)">
                                        Status<span class="sort-icons"><span class="asc">▲</span><span
                                                class="desc">▼</span></span>
                                    </th>

                                    <th class="text-center sortable align-middle">Action</th>
                                </tr>
                            </thead>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $index => $item)
                            <tr>
                                <td class="text-center">{{ $items->firstItem() + $index }}</td>
                                <td>{{ $item->extinguisher->extinguisher_id }}</td>
                                <td>
                                    @if ($item->user && $item->user->lname && $item->user->fname)
                                        {{ $item->user->lname }}, {{ $item->user->fname }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="text-center">
                                    {{ optional($item->inspected_at ? \Carbon\Carbon::parse($item->inspected_at) : null)->format('F d, Y h:i a') ?? 'N/A' }}
                                </td>
                                @php
                                    $nextRaw = $item->next_due ?? null;
                                    $next = $nextRaw ? \Carbon\Carbon::parse($nextRaw) : null;
                                    $now = \Carbon\Carbon::now();

                                    $diffInDays = $next ? $now->diffInDays($next, false) : null;
                                    $class = 'text-muted';

                                    if ($diffInDays < 0) {
                                        $class = 'text-danger';
                                    } elseif ($diffInDays <= 3) {
                                        $class = 'text-success';
                                    } elseif ($diffInDays <= 7) {
                                        $class = 'text-primary';
                                    } elseif ($diffInDays <= 30) {
                                        $class = 'text-dark';
                                    }
                                @endphp

                                <td class="text-center {{ $class }}">
                                    {{ $next ? $next->format('F d, Y ') : 'N/A' }}<br>

                                </td>
                                <td class="text-center">
                                    {{ gmdate($details->time > 3600 ? 'H:i:s' : ($details->time >= 60 ? 'i:s' : 's'), $details->time) }}
                                    {{ $details->time > 3600 ? 'Hr' : ($details->time >= 60 ? 'Min' : 'Sec') }}
                                </td>
                                <td class="text-center">
                                    @if ($item->status === 'Good')
                                        <span class="badge text-bg-success">Good</span>
                                    @elseif ($item->status === 'Undercharged')
                                        <span class="badge text-bg-danger">Under Charged</span>
                                    @elseif ($item->status === 'Overcharged')
                                        <span class="badge text-bg-primary">Over Charged</span>
                                    @elseif ($item->status === 'Retired')
                                        <span class="badge text-bg-secondary">Retired</span>
                                    @endif

                                </td>

                                <td class="text-center align-middle">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <a class="mx-2 edit-btn"
                                            href="{{ url('/Inspection/Logs/Answer/' . $item->id) }}">
                                            <i class="fa-regular fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class=" d-flex flex-wrap justify-content-between align-items-center">

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
    </div>
    <script src="{{ asset('/js/table/search.js') }}"></script>
    <script src="{{ asset('/js/table/sort.js') }}"></script>
@endsection
@push('css')
    <link href="{{ asset('css/custom.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/components/submenu.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
