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
                <i class="fa-solid fa-ticket"></i>
            </div>
            <nav class="breadcrumb-nav">
                <div class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Home</a>
                </div>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <div class="breadcrumb-item active">
                    All Tickets
                </div>
            </nav>
        </div>
    </div>

    <div class="animated-container container-fluid px-0 px-lg-5">
        <div class="table-container ">
            <div
                class="row mt-3 mb-3 gap-2 d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center">
                <div class="col-12 col-lg-3 ">
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
                            <th class="text-center sortable align-middle" data-index="0" onclick="sortTable(this)">
                                # <span class="sort-icons"><span class="asc">▲</span><span class="desc">▼</span></span>
                            </th>
                            <th class="text-center sortable align-middle" data-index="1" onclick="sortTable(this)">
                                Ticket ID <span class="sort-icons"><span class="asc">▲</span><span
                                        class="desc">▼</span></span>
                            </th>
                            <th class="text-center sortable align-middle" data-index="2" onclick="sortTable(this)">
                                Created By <span class="sort-icons"><span class="asc">▲</span><span
                                        class="desc">▼</span></span>
                            </th>
                            <th class="text-center sortable align-middle" data-index="3" onclick="sortTable(this)">
                                Description <span class="sort-icons"><span class="asc">▲</span><span
                                        class="desc">▼</span></span>
                            </th>

                            <th class="text-center sortable align-middle" data-index="4" onclick="sortTable(this)">
                                Assigned To <span class="sort-icons"><span class="asc">▲</span><span
                                        class="desc">▼</span></span>
                            </th>
                            <th class="text-center sortable align-middle" data-index="5" onclick="sortTable(this)">
                                Submitted At <span class="sort-icons"><span class="asc">▲</span><span
                                        class="desc">▼</span></span>
                            </th>
                            <th class="text-center sortable align-middle" data-index="6" onclick="sortTable(this)">
                                Completed At <span class="sort-icons"><span class="asc">▲</span><span
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
                                    {{ $index + 1 }}
                                </td>

                                <td style="vertical-align: middle; text-align: center;">
                                    {{ $item->ticket_id }}
                                </td>
                                <td style="vertical-align: middle; ">
                                    {{ $item->creator->lname }}, {{ $item->creator->fname }}
                                </td>

                                <td style="vertical-align: middle; text-align: center; width: 25%;">
                                    {{ $item->description }}
                                </td>
                                <td style="vertical-align: middle; text-align: center;">
                                    @if ($item->assignee)
                                        {{ $item->assignee->lname }}, {{ $item->assignee->fname }}
                                    @else
                                        Not Assigned
                                    @endif
                                </td>

                                <td style="vertical-align: middle; text-align: center;">
                                    {{ optional($item->created_at ? \Carbon\Carbon::parse($item->created_at) : null)->format('F d, Y h:ia') ?? 'N/A' }}
                                </td>
                                <td style="vertical-align: middle; text-align: center;">
                                    {{ optional($item->completed_at ? \Carbon\Carbon::parse($item->completed_at) : null)->format('F d, Y h:ia') ?? 'Not Completed' }}
                                </td>
                                <td style="vertical-align: middle; text-align: center; text-transform: capitalize;">
                                    @php
                                        $status = $item->status;
                                        $badgeClass = match ($status) {
                                            'open' => 'warning',
                                            'in_progress' => 'primary',
                                            'completed', 'Retired' => 'success',
                                            default => 'secondary',
                                        };

                                        // Convert 'in_progress' => 'In Progress'
                                        $displayStatus = ucwords(str_replace('_', ' ', $status));
                                    @endphp

                                    <span class="badge px-3 py-2 rounded-pill bg-{{ $badgeClass }}">
                                        {{ $displayStatus }}
                                    </span>
                                </td>

                                <td class="text-center align-middle">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <a class="mx-2 edit-btn" href="{{ url('User/Tickets/details/' . $item->id) }}">
                                            <i class="fa-regular fa-eye"></i>
                                        </a>
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

    <script src="{{ asset('/js/table/search.js') }}"></script>
    <script src="{{ asset('/js/table/sort.js') }}"></script>
@endsection
@push('css')
    <link href="{{ asset('css/components/submenu.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
