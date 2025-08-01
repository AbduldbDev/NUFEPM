@extends('layouts.app')
@section('content')
    @include('layouts.components.alerts')
    <div class="main-container container ">
        <div class="title">
            <span class="menu-title-icon"><i class="fa-solid fa-qrcode"></i></span> &nbsp;
            <span class="crumb">
                <span class="breadcrumbs"><a href="{{ route('admin.ShowAdminInspectionMenu') }}">Inspections</a> &gt; </span>
            </span>
            <span class="breadcrumbs">Refill Logs</span>
        </div>
        <hr>
    </div>
    <div class="table-container container animated-container">
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
                                    Extinguisher Id<span class="sort-icons"><span class="asc">▲</span><span
                                            class="desc">▼</span></span>
                                </th>
                                <th class="text-center sortable align-middle" data-index="2" onclick="sortTable(this)">
                                    Refilled By<span class="sort-icons"><span class="asc">▲</span><span
                                            class="desc">▼</span></span>
                                </th>
                                <th class="text-center sortable align-middle" data-index="2" onclick="sortTable(this)">
                                    Refilled At<span class="sort-icons"><span class="asc">▲</span><span
                                            class="desc">▼</span></span>
                                </th>
                                <th class="text-center sortable align-middle" data-index="2" onclick="sortTable(this)"
                                    style="width: 40%">
                                    Remarks<span class="sort-icons"><span class="asc">▲</span><span
                                            class="desc">▼</span></span>
                                </th>

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
                                {{ optional($item->refill_date ? \Carbon\Carbon::parse($item->refill_date) : null)->format('F d, Y h:i a') ?? 'N/A' }}
                            </td>
                            <td class="text-center align-middle">
                                {{ $item->remarks }}
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
    <script src="{{ asset('/js/table/search.js') }}"></script>
    <script src="{{ asset('/js/table/sort.js') }}"></script>
@endsection
@push('css')
    <link href="{{ asset('css/custom.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/components/submenu.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
