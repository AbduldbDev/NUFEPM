@extends('layouts.app')
@section('content')
    @include('layouts.components.alerts ')
    <div class=" container-fluid  px-0 px-lg-5">
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
                    <a href="{{ route('admin.ShowExtinguishersMenu') }}">Fire Equipments</a>
                </div>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <div class="breadcrumb-item active">
                    {{ ucwords(str_replace('_', ' ', $type)) }}
                </div>
            </nav>
        </div>
    </div>

    <div class="animated-container container-fluid px-0 px-lg-5">

        <div class="table-container ">
            <div class="border rounded-3 p-4 mb-4 bg-light position-relative">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h5 class="fw-bold mb-0" style="color: #35408e">
                        <i
                            class="fa-solid fa-school me-2"></i>{{ $type === 'all' ? 'All Extinguishers' : ucwords(str_replace('_', ' ', $type)) }}
                        Overview (Active)
                    </h5>
                </div>
                <div class="row">

                    <!-- Total Extinguishers -->
                    <div class="col-12 col-md-6 col-lg-3 mb-3 mb-lg-0">
                        <div class="d-flex">
                            <i class="fa-solid fa-fire-extinguisher me-2 mt-1 text-muted"></i>
                            <div>
                                <small class="text-muted">Total Extinguishers</small><br>
                                <span class="fw-medium"> {{ $totalExtinguishers }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Total Fire Hose -->
                    <div class="col-12 col-md-6 col-lg-3 mb-3 mb-lg-0">
                        <div class="d-flex">
                            <i class="fa-solid fa-fire-extinguisher me-2 mt-1 text-muted"></i>
                            <div>
                                <small class="text-muted">Total Fire Hose</small><br>
                                <span class="fw-medium"> {{ $totalFireHose }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Near Expiration -->
                    <div class="col-12 col-md-6 col-lg-3 mb-3 mb-lg-0">
                        <div class="d-flex">
                            <i class="fa-solid fa-calendar-times me-2 mt-1 text-muted"></i>
                            <div>
                                <small class="text-muted">Near Expiration</small><br>
                                <span class="fw-medium text-danger">{{ $nearExpiration }}</span>
                                <small class="text-muted ms-1">
                                    @if ($nearestExpirationDate)
                                        <small>
                                            {{ $nearestExpirationDate ? \Carbon\Carbon::parse($nearestExpirationDate)->format('M d, Y') : '—' }}
                                        </small>
                                    @endif
                                </small>
                            </div>
                        </div>
                    </div>

                    <!-- Near Inspection -->
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="d-flex">
                            <i class="fa-solid fa-clipboard-check me-2 mt-1 text-muted"></i>
                            <div>
                                <small class="text-muted">Near Inspection</small><br>
                                <span class="fw-medium text-warning">{{ $nearInspection }}</span>
                                <small class="text-muted ms-1">
                                    @if ($nearestInspectionDate)
                                        <small>{{ $nearestInspectionDate ? \Carbon\Carbon::parse($nearestInspectionDate)->format('M d, Y') : '—' }}
                                        </small>
                                    @endif
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="row mt-3 mb-3 gap-2 d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center">
                <div class="col-12 col-lg-3 ">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fas fa-search"></i></span>
                        <input type="text" id="tableSearch" class="form-control" placeholder="Search..."
                            onkeyup="filterTable()">
                    </div>
                </div>
                <div class="col-12 col-lg-3 text-end">
                    <button class="btn add-new-btn mb-3 w-100" id="download-selected">
                        <i class="fa fa-download"></i> Download Selected QR
                    </button>
                </div>

            </div>
            <div class="table-responsive">
                <table class="sortable-table table table-responsive table-bordered w-100" id="sortableTable">
                    <thead>
                        <tr>
                            <th style="text-center sortable align-middle">
                                <input type="checkbox" class="form-check-input" id="select-all">
                            </th>
                            <th class="text-center sortable align-middle" data-index="0" onclick="sortTable(this)">
                                # <span class="sort-icons"><span class="asc">▲</span><span class="desc">▼</span></span>
                            </th>
                            <th class="text-center sortable align-middle" data-index="1" onclick="sortTable(this)">
                                QR Codes <span class="sort-icons"><span class="asc">▲</span><span
                                        class="desc">▼</span></span>
                            </th>
                            <th class="text-center sortable align-middle" data-index="2" onclick="sortTable(this)">
                                Category <span class="sort-icons"><span class="asc">▲</span><span
                                        class="desc">▼</span></span>
                            </th>
                            <th class="text-center sortable align-middle" data-index="3" onclick="sortTable(this)">
                                Serial Number <span class="sort-icons"><span class="asc">▲</span><span
                                        class="desc">▼</span></span>
                            </th>
                            <th class="text-center sortable align-middle" data-index="4" onclick="sortTable(this)">
                                Extinguisher Type <span class="sort-icons"><span class="asc">▲</span><span
                                        class="desc">▼</span></span>
                            </th>
                            <th class="text-center sortable align-middle" data-index="5" onclick="sortTable(this)">
                                Capacity <span class="sort-icons"><span class="asc">▲</span><span
                                        class="desc">▼</span></span>
                            </th>
                            <th class="text-center sortable align-middle" data-index="6" onclick="sortTable(this)">
                                Extinguisher Location <span class="sort-icons"><span class="asc">▲</span><span
                                        class="desc">▼</span></span>
                            </th>
                            <th class="text-center sortable align-middle" data-index="7" onclick="sortTable(this)">
                                Date Installed <span class="sort-icons"><span class="asc">▲</span><span
                                        class="desc">▼</span></span>
                            </th>
                            <th class="text-center sortable align-middle" data-index="8" onclick="sortTable(this)">
                                Next Maintenance <span class="sort-icons"><span class="asc">▲</span><span
                                        class="desc">▼</span></span>
                            </th>
                            <th class="text-center sortable align-middle" data-index="9" onclick="sortTable(this)">
                                Expiration Date <span class="sort-icons"><span class="asc">▲</span><span
                                        class="desc">▼</span></span>
                            </th>
                            <th class="text-center sortable align-middle">Status</th>
                            <th class="text-center sortable align-middle">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $index => $item)
                            <tr>
                                <td style="vertical-align: middle; text-align: center;">
                                    <input type="checkbox" class="qr-checkbox form-check-input"
                                        value="{{ asset('/storage/' . $item->qr_code_path) }}">
                                </td>
                                <td style="vertical-align: middle; text-align: center;">
                                    {{ $index + 1 }}
                                </td>

                                <td style="vertical-align: middle; text-align: center;">

                                    <a href="{{ asset('/storage/' . $item->qr_code_path) }}" target="_blank">
                                        <img src="{{ asset('/storage/' . $item->qr_code_path) }}" alt="QR Code"
                                            width="100px">
                                    </a><br>
                                    {{ $item->extinguisher_id }} <br>

                                </td>
                                {{-- <td style="vertical-align: middle; text-align: center;">
                                @if ($item->user && $item->user->lname && $item->user->fname)
                                    {{ $item->user->lname }}, {{ $item->user->fname }}
                                @else
                                    N/A
                                @endif
                            </td> --}}
                                <td style="vertical-align: middle; text-align: center;">
                                    {{ ucwords(str_replace('_', ' ', $item->category)) }}
                                </td>
                                <td style="vertical-align: middle; text-align: center;">
                                    {{ $item->serial_number }}
                                </td>
                                <td style="vertical-align: middle; text-align: center">
                                    {{ $item->type }}
                                </td>
                                <td style="vertical-align: middle; text-align: center; ">
                                    {{ $item->capacity }}
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
                                    {{ optional($item->installation_date ? \Carbon\Carbon::parse($item->installation_date) : null)->format('F d, Y') ?? 'N/A' }}
                                </td>
                                <td style="vertical-align: middle; text-align: center;">
                                    {{ optional($item->next_maintenance ? \Carbon\Carbon::parse($item->next_maintenance) : null)->format('F d, Y') ?? 'N/A' }}
                                </td>
                                <td style="vertical-align: middle; text-align: center;">
                                    {{ optional($item->life_span ? \Carbon\Carbon::parse($item->life_span) : null)->format('F d, Y') ?? 'N/A' }}
                                </td>
                                <td style="vertical-align: middle; text-align: center;">
                                    @php
                                        $status = $item->status;
                                        $badgeClass = match ($status) {
                                            'Good' => 'success',
                                            'Overcharged' => 'primary',
                                            'Undercharged', 'Retired' => 'danger',
                                            default => 'secondary',
                                        };
                                    @endphp

                                    <span
                                        class="badge px-3 py-2 rounded-pill bg-{{ $badgeClass }}">{{ $status }}</span>
                                </td>

                                <td class="text-center align-middle">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <a class="mx-2 edit-btn" href="{{ asset('/storage/' . $item->qr_code_path) }}"
                                            download>
                                            <i class="fa fa-download"></i>
                                        </a>
                                        <a class="mx-2 edit-btn" href="{{ url('Extinguisher/Details/' . $item->id) }}">
                                            <i class="fa-regular fa-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.DeleteExtinguisher') }}" method="POST"
                                            onsubmit="return confirmDelete(this);">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <button class="mx-2 delete-btn" type="submit" title="Delete"
                                                style="border: none; background-color: transparent">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                        @include('layouts.components.deletepopup')
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
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
    </div>
    </div>
    <script>
        document.getElementById('select-all').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.qr-checkbox');
            checkboxes.forEach(cb => cb.checked = this.checked);
        });

        document.getElementById('download-selected').addEventListener('click', function() {
            const selected = document.querySelectorAll('.qr-checkbox:checked');
            if (selected.length === 0) {
                alert('Please select at least one QR code to download.');
                return;
            }

            selected.forEach(cb => {
                const link = document.createElement('a');
                link.href = cb.value;
                link.download = '';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            });
        });
    </script>

    <script src="{{ asset('/js/table/search.js') }}"></script>
    <script src="{{ asset('/js/table/sort.js') }}"></script>
@endsection
@push('css')
    <link href="{{ asset('css/components/submenu.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
