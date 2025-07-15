@extends('layouts.app')
@section('content')
    @include('layouts.components.alerts')
    <div class="main-container container">
        <div class="title">
            <span class="menu-title-icon"><i class="fa-solid fa-fire-extinguisher"></i></span> &nbsp;
            <span class="crumb">
                <span class="breadcrumbs"><a href="{{ route('dashboard') }}">Home</a> &gt; </span>
            </span>
            <span class="crumb">
                <span class="breadcrumbs"><a href="{{ route('admin.ShowExtinguishersMenu') }}">Extinguishers</a> &gt; </span>
            </span>
            <span class="breadcrumbs">Active </span>
        </div>
        <hr>
    </div>

    <style>
        body {
            background-color: #f5f7fa;
        }

        .dashboard-card {
            background: #fff;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            position: relative;
            height: 130px;
            transition: 0.3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-4px);
        }

        .dashboard-number {
            font-size: 2rem;
            font-weight: 700;
            color: #212529;
        }

        .dashboard-icon {
            position: absolute;
            top: 1rem;
            right: 1.5rem;
            font-size: 2rem;
            color: #0d6efd;
        }

        .dashboard-label {
            position: absolute;
            bottom: 1rem;
            right: 1.5rem;
            color: #6c757d;
            font-weight: 500;
        }

        .search-box {
            max-width: 300px;
            float: right;
        }

        .table-container {
            background: #fff;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            margin-top: 2rem;
        }
    </style>
    {{-- 
    <div class="container ">
        <div class="row g-4">
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="dashboard-card">
                    <div class="dashboard-number">1,240</div>
                    <i class="fas fa-users dashboard-icon"></i>
                    <div class="dashboard-label">Users</div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="dashboard-card">
                    <div class="dashboard-number">876</div>
                    <i class="fas fa-box dashboard-icon"></i>
                    <div class="dashboard-label">Orders</div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="dashboard-card">
                    <div class="dashboard-number">$15,340</div>
                    <i class="fas fa-dollar-sign dashboard-icon"></i>
                    <div class="dashboard-label">Revenue</div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="dashboard-card">
                    <div class="dashboard-number">34</div>
                    <i class="fas fa-chart-line dashboard-icon"></i>
                    <div class="dashboard-label">Reports</div>
                </div>
            </div>
        </div>
    </div>
   --}}
    <div class="container-fluid">
        <div class="table-container">
            <div class="row mt-3 mb-3">
                <div class="col-12 col-lg-3">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fas fa-search"></i></span>
                        <input type="text" id="tableSearch" class="form-control" placeholder="Search..."
                            onkeyup="filterTable()">
                    </div>
                </div>
            </div>
            <div class="table-responsive">
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
                                Created By <span class="sort-icons"><span class="asc">▲</span><span
                                        class="desc">▼</span></span>
                            </th>
                            <th class="sortable" data-index="2" onclick="sortTable(this)">
                                Serial Number <span class="sort-icons"><span class="asc">▲</span><span
                                        class="desc">▼</span></span>
                            </th>
                            <th class="sortable" data-index="3" onclick="sortTable(this)">
                                Extinguisher Type <span class="sort-icons"><span class="asc">▲</span><span
                                        class="desc">▼</span></span>
                            </th>
                            <th class="sortable" data-index="3" onclick="sortTable(this)">
                                Capacity <span class="sort-icons"><span class="asc">▲</span><span
                                        class="desc">▼</span></span>
                            </th>
                            <th class="sortable" data-index="4" onclick="sortTable(this)">
                                Extinguisher Location <span class="sort-icons"><span class="asc">▲</span><span
                                        class="desc">▼</span></span>
                            </th>
                            <th class="text-center sortable" data-index="5" onclick="sortTable(this)">
                                Date Installed <span class="sort-icons"><span class="asc">▲</span><span
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
                                        <img src="{{ asset('/storage/' . $item->qr_code_path) }}" alt="QR Code"
                                            width="100px">
                                    </a><br>
                                    {{ $item->extinguisher_id }}

                                </td>
                                <td style="vertical-align: middle; text-align: center;">
                                    @if ($item->user && $item->user->lname && $item->user->fname)
                                        {{ $item->user->lname }}, {{ $item->user->fname }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td style="vertical-align: middle; text-align: center;">
                                    {{ $item->serial_number }}
                                </td>
                                <td
                                    style="vertical-align: middle; text-align: center; color:  {{ $item->type->color ?? '#00000' }}">
                                    {{ $item->type->name ?? 'N/A' }}
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
                                    {{ $item->status }}
                                </td>
                                <td class="text-center align-middle">
                                    <div class="d-flex justify-content-center align-items-center">
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
                                                <i class="fa-solid fa-trash-can"></i>
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

    {{-- <div class="container-fluid animated-container">
        <div class="row mt-3 mb-3">
            <div class="col-12 col-lg-3">
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="fas fa-search"></i></span>
                    <input type="text" id="tableSearch" class="form-control" placeholder="Search..."
                        onkeyup="filterTable()">
                </div>
            </div>
        </div>
        <div class="table-responsive">
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
                            Created By <span class="sort-icons"><span class="asc">▲</span><span
                                    class="desc">▼</span></span>
                        </th>
                        <th class="sortable" data-index="2" onclick="sortTable(this)">
                            Serial Number <span class="sort-icons"><span class="asc">▲</span><span
                                    class="desc">▼</span></span>
                        </th>
                        <th class="sortable" data-index="3" onclick="sortTable(this)">
                            Extinguisher Type <span class="sort-icons"><span class="asc">▲</span><span
                                    class="desc">▼</span></span>
                        </th>
                        <th class="sortable" data-index="3" onclick="sortTable(this)">
                            Capacity <span class="sort-icons"><span class="asc">▲</span><span
                                    class="desc">▼</span></span>
                        </th>
                        <th class="sortable" data-index="4" onclick="sortTable(this)">
                            Extinguisher Location <span class="sort-icons"><span class="asc">▲</span><span
                                    class="desc">▼</span></span>
                        </th>
                        <th class="text-center sortable" data-index="5" onclick="sortTable(this)">
                            Date Installed <span class="sort-icons"><span class="asc">▲</span><span
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
                                    <img src="{{ asset('/storage/' . $item->qr_code_path) }}" alt="QR Code"
                                        width="100px">
                                </a><br>
                                {{ $item->extinguisher_id }}

                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                @if ($item->user && $item->user->lname && $item->user->fname)
                                    {{ $item->user->lname }}, {{ $item->user->fname }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                {{ $item->serial_number }}
                            </td>
                            <td
                                style="vertical-align: middle; text-align: center; color:  {{ $item->type->color ?? '#00000' }}">
                                {{ $item->type->name ?? 'N/A' }}
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
                                {{ $item->status }}
                            </td>
                            <td class="text-center align-middle">
                                <div class="d-flex justify-content-center align-items-center">
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
                                            <i class="fa-solid fa-trash-can"></i>
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
    </div> --}}
    <script src="{{ asset('/js/table/search.js') }}"></script>
    <script src="{{ asset('/js/table/sort.js') }}"></script>
@endsection
@push('css')
    <link href="{{ asset('css/components/submenu.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
