@extends('layouts.app')
@section('content')
    @include('layouts.components.alerts')
    <div class="container-fluid px-0 px-lg-5">
        <div class="breadcrumb-container">
            <div class="breadcrumb-back">
                <a href="javascript:history.back()" class="back-button">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
            </div>
            <div class="breadcrumb-icon">
                <i class="fa-solid fa-fire-extinguisher"></i>
            </div>
            <nav class="breadcrumb-nav">
                <div class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Home</a>
                </div>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <div class="breadcrumb-item">
                    <a href="{{ route('admin.ShowAdminInspectionMenu') }}">Inspections</a>
                </div>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <div class="breadcrumb-item active">
                    Extinguishers
                </div>
            </nav>
        </div>
    </div>
    <div class="animated-container container-fluid px-0 px-lg-5">
        <div class="row mt-3 mb-3">
            <div class="col-12 col-lg-3">
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="fas fa-search"></i></span>
                    <input type="text" id="tableSearch" class="form-control" placeholder="Search..."
                        onkeyup="filterTable()">
                </div>
            </div>
        </div>
        <div class="table-container table-responsive">
            <table class="sortable-table table table-responsive table-bordered w-100" id="sortableTable">
                <thead>
                    <tr>
                        <th class="text-center sortable" data-index="0" onclick="sortTable(this)">
                            # <span class="sort-icons"><span class="asc">▲</span><span class="desc">▼</span></span>
                        </th>
                        <th class="text-center sortable" data-index="1" onclick="sortTable(this)">
                            QR Codes <span class="sort-icons"><span class="asc">▲</span><span
                                    class="desc">▼</span></span>
                        </th>
                        <th class="sortable" data-index="2" onclick="sortTable(this)">
                            Serial Number <span class="sort-icons"><span class="asc">▲</span><span
                                    class="desc">▼</span></span>
                        </th>

                        <th class="sortable" data-index="4" onclick="sortTable(this)">
                            Extinguisher Location <span class="sort-icons"><span class="asc">▲</span><span
                                    class="desc">▼</span></span>
                        </th>
                        <th class="text-center sortable" data-index="5" onclick="sortTable(this)">
                            Last Maintenance <span class="sort-icons"><span class="asc">▲</span><span
                                    class="desc">▼</span></span>
                        </th>
                        <th class="text-center sortable" data-index="5" onclick="sortTable(this)">
                            Next Maintenance <span class="sort-icons"><span class="asc">▲</span><span
                                    class="desc">▼</span></span>
                        </th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $index => $item)
                        <tr>
                            <td style="vertical-align: middle; text-align: center;">
                                {{ $index + 1 }}
                            </td>
                            <td style="vertical-align: middle; text-align: center;">

                                <a href="{{ asset('/storage/' . $item->qr_code_path) }}" target="_blank">
                                    <img src="{{ asset('/storage/' . $item->qr_code_path) }}" alt="QR Code" width="100px">
                                </a><br>
                                {{ $item->extinguisher_id }}

                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                {{ $item->serial_number }}
                            </td>

                            <td style="vertical-align: middle; text-align: center;">
                                {{ implode(
                                    ', ',
                                    array_filter([
                                        $item->location->building ?? null,
                                        $item->location->floor ?? null,
                                        $item->location->room ?? null,
                                        $item->location->spot ?? null,
                                    ]),
                                ) }}
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                {{ optional($item->installation_date ? \Carbon\Carbon::parse($item->last_maintenance) : null)->format('F d, Y') ?? 'N/A' }}
                            </td>
                            @php
                                $nextRaw = $item->next_maintenance ?? null;
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

                            <td class="text-center {{ $class }}" style="vertical-align: middle; text-align: center;">
                                {{ $next ? $next->format('F d, Y ') : 'N/A' }}<br>
                                {{-- <small>{{ number_format($diffInDays, 0) }} days</small> --}}
                            </td>

                            <td style="vertical-align: middle; text-align: center;">
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
                                    <a class="mx-2  edit-btn" href="{{ url('/Inspection/Logs/Table/' . $item->id) }}">
                                        <i class="fa-regular fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            <div class="   d-flex flex-wrap justify-content-between align-items-center">

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
    <script src="{{ asset('/js/table/search.js') }}"></script>
    <script src="{{ asset('/js/table/sort.js') }}"></script>
@endsection
@push('css')
    <link href="{{ asset('css/components/submenu.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
