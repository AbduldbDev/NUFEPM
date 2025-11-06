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
                <i class="fa-solid fa-radiation"></i>
            </div>
            <nav class="breadcrumb-nav">
                <div class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Home</a>
                </div>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <div class="breadcrumb-item">
                    <a href="{{ route('admin.ShowAdminDeviceMenu') }}">Devices</a>
                </div>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <div class="breadcrumb-item active">
                    {{ ucwords(str_replace('_', ' ', $type)) }}
                </div>
            </nav>
        </div>
    </div>

    <div class="animated-container container-fluid px-0 px-lg-5">
        <div class="table-container">
            <div class="border rounded-3 p-4 mb-4 bg-light position-relative">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h5 class="fw-bold mb-0" style="color: #35408e">
                        <i
                            class="fa-solid fa-school me-2"></i>{{ $type === 'all' ? 'All Devices' : ucwords(str_replace('_', ' ', $type)) }}
                        Overview
                    </h5>
                </div>
                <div class="row">

                    <div class="col-12 col-md-6 col-lg-3 mb-3 mb-lg-0">
                        <div class="d-flex">
                            <i class="fa-solid fa-shower me-2 mt-1 text-muted"></i>
                            <div>
                                <small class="text-muted">Total Sprinklers</small><br>
                                <span class="fw-medium"> {{ $sprinkler }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3 mb-3 mb-lg-0">
                        <div class="d-flex">
                            <i class="fa-solid fa-smog me-2 mt-1 text-muted"></i>
                            <div>
                                <small class="text-muted">Total Smoke Detector</small><br>
                                <span class="fw-medium"> {{ $smokedetector }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3 mb-3 mb-lg-0">
                        <div class="d-flex">
                            <i class="fa-solid fa-lightbulb me-2 mt-1 text-muted"></i>
                            <div>
                                <small class="text-muted">Total Emergency Lights</small><br>
                                <span class="fw-medium"> {{ $emergencylights }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3 mb-3 mb-lg-0">
                        <div class="d-flex">
                            <i class="fa-solid  fa-bell me-2 mt-1 text-muted"></i>
                            <div>
                                <small class="text-muted">Total Fire Alarm</small><br>
                                <span class="fw-medium"> {{ $firealarm }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="row mt-3 mb-3 d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center">
                <div class="col-12 col-lg-3 ">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fas fa-search"></i></span>
                        <input type="text" id="tableSearch" class="form-control" placeholder="Search..."
                            onkeyup="filterTable()">
                    </div>
                </div>
            </div>

            <div class=" table-responsive">
                <table class="sortable-table table table-responsive table-bordered w-100" id="sortableTable">
                    <thead>
                        <tr>

                            <th class="text-center sortable align-middle" data-index="0" onclick="sortTable(this)">
                                # <span class="sort-icons"><span class="asc">▲</span><span class="desc">▼</span></span>
                            </th>
                            <th class="text-center sortable align-middle" data-index="1" onclick="sortTable(this)">
                                Type <span class="sort-icons"><span class="asc">▲</span><span
                                        class="desc">▼</span></span>
                            </th>
                            <th class="text-center sortable align-middle" data-index="2" onclick="sortTable(this)">
                                Model<span class="sort-icons"><span class="asc">▲</span><span
                                        class="desc">▼</span></span>
                            </th>
                            <th class="text-center sortable align-middle" data-index="3" onclick="sortTable(this)">
                                Serial Number <span class="sort-icons"><span class="asc">▲</span><span
                                        class="desc">▼</span></span>
                            </th>
                            <th class="text-center sortable align-middle" data-index="4" onclick="sortTable(this)">
                                Device Location <span class="sort-icons"><span class="asc">▲</span><span
                                        class="desc">▼</span></span>
                            </th>
                            <th class="text-center sortable align-middle" data-index="5" onclick="sortTable(this)">
                                Date Installed <span class="sort-icons"><span class="asc">▲</span><span
                                        class="desc">▼</span></span>
                            </th>
                            <th class="text-center sortable align-middle" data-index="6" onclick="sortTable(this)">
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
                                @php
                                    $locationParts = array_filter([
                                        $item->location->building ?? null,
                                        $item->location->floor ?? null,
                                        $item->location->room ?? null,
                                        $item->location->spot ?? null,
                                    ]);

                                    $locationString = !empty($locationParts) ? implode(', ', $locationParts) : 'N/A';
                                @endphp

                                <td style="vertical-align: middle; text-align: center;">
                                    {{ $index + 1 }}
                                </td>

                                <td style="vertical-align: middle; text-align: center;" class="text-capitalize">
                                    {{ ucwords(str_replace('_', ' ', $item->type)) }}
                                </td>

                                <td style="vertical-align: middle; text-align: center;">
                                    {{ $item->model }}
                                </td>
                                <td style="vertical-align: middle; text-align: center;">
                                    {{ $item->serial_number }}
                                </td>

                                <td style="vertical-align: middle; text-align: center;">
                                    {{ $locationString }}
                                </td>
                                <td style="vertical-align: middle; text-align: center;">
                                    {{ optional($item->installation_date ? \Carbon\Carbon::parse($item->installation_date) : null)->format('M d, Y') ?? 'N/A' }}
                                </td>
                                <td style="vertical-align: middle; text-align: center;">
                                    {{ optional($item->latestCertificate)->created_at?->format('M d, Y') ?? 'No Certificate' }}

                                </td>
                                <td class="text-capitalize" style="vertical-align: middle; text-align: center;">
                                    @php
                                        $status = $item->status;
                                        $badgeClass = match ($status) {
                                            'active' => 'success',
                                            'inactive' => 'danger',
                                            default => 'secondary',
                                        };
                                    @endphp

                                    <span
                                        class="badge px-3 py-2 rounded-pill bg-{{ $badgeClass }}">{{ $status }}</span>
                                </td>

                                <td class="text-center align-middle">
                                    <div class="d-flex justify-content-center align-items-center">
                                        {{-- <a class="mx-2 edit-btn" href="{{ asset('/storage/' . $item->qr_code_path) }}"
                                        download>
                                        <i class="fa fa-download"></i>
                                    </a> --}}
                                        <a class="mx-2 edit-btn" href="{{ url('Devices/Details/' . $item->id) }}">
                                            <i class="fa-regular fa-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.DeleteDevice') }}" method="POST"
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
    {{-- <script>
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
    </script> --}}
    <script src="{{ asset('/js/table/search.js') }}"></script>
    <script src="{{ asset('/js/table/sort.js') }}"></script>
@endsection
@push('css')
    <link href="{{ asset('css/components/submenu.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
