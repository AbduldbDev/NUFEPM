@extends('layouts.app')
@section('content')
    @include('layouts.components.alerts')
    <div class="main-container container ">
        <div class="title">
            <span class="menu-title-icon"><i class="fa-solid fa-fire-extinguisher"></i></span> &nbsp;
            <span class="crumb">
                <span class="breadcrumbs"><a href="{{ route('dashboard') }}">Home</a> &gt; </span>
            </span>
            <span class="crumb">
                <span class="breadcrumbs"><a href="{{ route('admin.ShowExtinguishersMenu') }}">Extinguishers</a> &gt; </span>
            </span>
            <span class="breadcrumbs">Locations</span>
        </div>
        <hr>

        <div class="add-extinguisher-container shadow-sm animated-container">

            <form action="{{ route('admin.SubmitNewLocation') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <h1 class="text-lg addnew-title"><i class="fa-solid fa-file-circle-plus"></i> Add New Location
                        </h1>
                        <div class="mb-3">
                            <label for="serial_number" class="form-label">Created By: </label>
                            <input type="text" name="serial_number" class="form-control" readonly
                                value="{{ Auth::user()->lname }}, {{ Auth::user()->fname }}">
                        </div>

                        <div class="mb-3">
                            <label for="building" class="form-label">Building</label>
                            <input type="text" name="building" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="floor" class="form-label">Floor</label>
                            <input type="text" name="floor" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="room" class="form-label">Room</label>
                            <input type="text" name="room" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="spot" class="form-label">Spot</label>
                            <input type="text" name="spot" class="form-control">
                        </div>

                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12 col-lg-3">
                        <button type="submit" class="btn btn-primary w-100"><i class="fa-solid fa-floppy-disk"></i> Save
                            Location</button>
                    </div>
                </div>

            </form>
        </div>

        <div class="mt-5 animated-container">
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
                <table class="sortable-table table table-responsive table-bordered w-100" id="sortableTable">
                    <thead>
                        <tr>
                            <thead>
                                <tr>
                                    <th class="text-center sortable" data-index="0" onclick="sortTable(this)">
                                        # <span class="sort-icons"><span class="asc">▲</span><span
                                                class="desc">▼</span></span>
                                    </th>
                                    <th class="text-center sortable" data-index="1" onclick="sortTable(this)">
                                        Created By <span class="sort-icons"><span class="asc">▲</span><span
                                                class="desc">▼</span></span>
                                    </th>
                                    <th class="sortable" data-index="2" onclick="sortTable(this)">
                                        Building<span class="sort-icons"><span class="asc">▲</span><span
                                                class="desc">▼</span></span>
                                    </th>
                                    <th class="sortable" data-index="2" onclick="sortTable(this)">
                                        Floor<span class="sort-icons"><span class="asc">▲</span><span
                                                class="desc">▼</span></span>
                                    </th>
                                    <th class="sortable" data-index="2" onclick="sortTable(this)">
                                        Room<span class="sort-icons"><span class="asc">▲</span><span
                                                class="desc">▼</span></span>
                                    </th>
                                    <th class="sortable" data-index="2" onclick="sortTable(this)">
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
                                        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form method="POST"
                                                    action="{{ route('admin.UpdateLocation', $item->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-content text-start">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="editModalLabel{{ $item->id }}">
                                                                Edit
                                                                Location</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <input type="hidden" class="form-label" name="id"
                                                                    value="{{ $item->id }}">
                                                                <label for="building{{ $item->id }}"
                                                                    class="form-label">Building: </label>
                                                                <input type="text" name="building"
                                                                    id="building{{ $item->id }}" class="form-control"
                                                                    value="{{ $item->building }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <input type="hidden" class="form-label" name="id"
                                                                    value="{{ $item->id }}">
                                                                <label for="floor{{ $item->id }}"
                                                                    class="form-label">Floor: </label>
                                                                <input type="text" name="floor"
                                                                    id="floor{{ $item->id }}" class="form-control"
                                                                    value="{{ $item->floor }}">
                                                            </div>

                                                            <div class="mb-3">
                                                                <input type="hidden" class="form-label" name="id"
                                                                    value="{{ $item->id }}">
                                                                <label for="room{{ $item->id }}"
                                                                    class="form-label">Room: </label>
                                                                <input type="text" name="room"
                                                                    id="room{{ $item->id }}" class="form-control"
                                                                    value="{{ $item->room }}">
                                                            </div>

                                                            <div class="mb-3">
                                                                <input type="hidden" class="form-label" name="id"
                                                                    value="{{ $item->id }}">
                                                                <label for="spot{{ $item->id }}"
                                                                    class="form-label">Spot: </label>
                                                                <input type="text" name="spot"
                                                                    id="spot{{ $item->id }}" class="form-control"
                                                                    value="{{ $item->spot }}">
                                                            </div>

                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-danger"
                                                                data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i>
                                                                Cancel</button>
                                                            <button type="submit" class="btn btn-success"><i
                                                                    class="fa-solid fa-floppy-disk"></i> Update</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <form action="{{ route('admin.DeleteLocation') }}" method="POST"
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
