@extends('layouts.app')
@section('content')
    @include('layouts.components.alerts')
    <div class="main-container container">
        <div class="breadcrumb-container">
            <div class="breadcrumb-icon">
                <i class="fa-solid fa-users"></i>
            </div>
            <nav class="breadcrumb-nav">
                <div class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Home</a>
                </div>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <div class="breadcrumb-item active">
                    <span><a href="{{ route('admin.ShowAccountsMenu') }}">Accounts</a> </span>
                </div>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <div class="breadcrumb-item active">
                    <span>All Accounts</span>
                </div>
            </nav>
        </div>

        <div class="table-container animated-container">
            <div class="row mt-3 mb-3">
                <div class="col-12 col-lg-3">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fas fa-search"></i></span>
                        <input type="text" id="tableSearch" class="form-control" placeholder="Search..."
                            onkeyup="filterTable()">
                    </div>
                </div>
            </div>

            <div class="table-responsive ">

                <table class="sortable-table table table-responsive table-bordered w-100" id="sortableTable">
                    <thead>
                        <tr>
                            <th class="text-center sortable align-middle" data-index="0" onclick="sortTable(this)">
                                # <span class="sort-icons"><span class="asc">▲</span><span class="desc">▼</span></span>
                            </th>
                            <th class="text-center sortable align-middle" data-index="1" onclick="sortTable(this)">
                                Role <span class="sort-icons"><span class="asc">▲</span><span
                                        class="desc">▼</span></span>
                            </th>
                            <th class="text-center sortable align-middle" data-index="2" onclick="sortTable(this)">
                                Name <span class="sort-icons"><span class="asc">▲</span><span
                                        class="desc">▼</span></span>
                            </th>
                            <th class="text-center sortable align-middle" data-index="3" onclick="sortTable(this)">
                                Employee ID <span class="sort-icons"><span class="asc">▲</span><span
                                        class="desc">▼</span></span>
                            </th>
                            <th class="text-center sortable align-middle" data-index="4" onclick="sortTable(this)">
                                Email <span class="sort-icons"><span class="asc">▲</span><span
                                        class="desc">▼</span></span>
                            </th>
                            <th class="text-center sortable align-middle" data-index="5" onclick="sortTable(this)">
                                Status <span class="sort-icons"><span class="asc">▲</span><span
                                        class="desc">▼</span></span>
                            </th>
                            <th class="text-center sortable align-middle">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $index => $item)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-center text-capitalize">{{ $item->type }}</td>
                                <td>{{ $item->lname }} {{ $item->suffix }}, {{ $item->fname }} {{ $item->mname }}</td>
                                <td>{{ $item->uid }}</td>
                                <td>{{ $item->email }}</td>
                                <td class="text-center">
                                    @if ($item->status === 'active')
                                        <span class="badge rounded-pill text-bg-success">Active</span>
                                    @else
                                        <span class="badge rounded-pill text-bg-warning">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-center align-middle">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <a class="mx-2 edit-btn" href="{{ url('Accounts/Details/' . $item->id) }}">
                                            <i class="fa-regular fa-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.DeleteAccount') }}" method="POST"
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
                <div class="d-flex flex-wrap justify-content-between align-items-center">

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
    <link href="{{ asset('css/components/submenu.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
