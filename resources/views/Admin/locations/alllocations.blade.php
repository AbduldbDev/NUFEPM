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
                <i class="fa-solid fa-school-flag"></i>
            </div>
            <nav class="breadcrumb-nav">
                <div class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Home</a>
                </div>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <div class="breadcrumb-item active">
                    <span>Locations</span>
                </div>
            </nav>
        </div>

        <div class="table-container animated-container">
            <div
                class="row mt-3 mb-3 d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center">
                <div class="col-12 col-lg-3 ">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fas fa-search"></i></span>
                        <input type="text" id="tableSearch" class="form-control" placeholder="Search..."
                            onkeyup="filterTable()">
                    </div>
                </div>
                <div class="col-12 col-lg-3 W mt-3 mt-lg-0 text-end">
                    <button class="btn w-50 w-lg-auto add-new-btn" data-bs-toggle="modal"
                        data-bs-target="#addLocationModal"><i class="bi bi-file-earmark-plus"></i> Add New</button>
                    @include('Admin.locations.modals.addlocation')
                </div>
            </div>
            <div class="table-responsive mt-3">
                <table class="sortable-table table table-responsive table-bordered w-100" id="sortableTable">
                    <thead>
                        <tr>
                            <thead>
                                <tr>
                                    <th class="text-center sortable align-middle" data-index="0" onclick="sortTable(this)">
                                        # <span class="sort-icons"><span class="asc">▲</span><span
                                                class="desc">▼</span></span>
                                    </th>
                                    <th class="text-center sortable align-middle" data-index="1" onclick="sortTable(this)">
                                        Created By <span class="sort-icons"><span class="asc">▲</span><span
                                                class="desc">▼</span></span>
                                    </th>
                                    <th class="text-center sortable align-middle" data-index="2" onclick="sortTable(this)">
                                        Building<span class="sort-icons"><span class="asc">▲</span><span
                                                class="desc">▼</span></span>
                                    </th>
                                    <th class="text-center sortable align-middle" data-index="2" onclick="sortTable(this)">
                                        Floor<span class="sort-icons"><span class="asc">▲</span><span
                                                class="desc">▼</span></span>
                                    </th>
                                    <th class="text-center sortable align-middle" data-index="2" onclick="sortTable(this)">
                                        Room<span class="sort-icons"><span class="asc">▲</span><span
                                                class="desc">▼</span></span>
                                    </th>
                                    <th class="text-center sortable align-middle" data-index="2" onclick="sortTable(this)">
                                        Spot<span class="sort-icons"><span class="asc">▲</span><span
                                                class="desc">▼</span></span>
                                    </th>

                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $index => $item)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>
                                    @if ($item->user && $item->user->lname && $item->user->fname)
                                        {{ $item->user->lname }}, {{ $item->user->fname }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ $item->building ?? 'N/A' }}</td>
                                <td>{{ $item->floor ?? 'N/A' }}</td>
                                <td>{{ $item->room ?? 'N/A' }}</td>
                                <td>{{ $item->spot ?? 'N/A' }}</td>
                                <td class="text-center align-middle">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <button class="edit-btn" style="border: none; background-color: transparent"
                                            data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        @include('Admin.locations.modals.editlocation')
                                        <form action="{{ route('admin.DeleteLocation') }}" method="POST"
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
