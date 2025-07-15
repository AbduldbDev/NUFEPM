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
            <span class="breadcrumbs">Questions</span>
        </div>
        <hr>

        <div class="add-extinguisher-container shadow-sm animated-container">

            <form action="{{ route('admin.SubmitNewQuestion') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <h1 class="text-lg addnew-title"><i class="fa-solid fa-file-circle-plus"></i> Add New Question
                        </h1>
                        <div class="mb-3">
                            <label for="created_by" class="form-label">Created By: </label>
                            <input id="created_by" type="text" name="serial_number" class="form-control" readonly
                                value="{{ Auth::user()->lname }}, {{ Auth::user()->fname }}">
                        </div>

                        <div class="mb-3">
                            <label for="interval" class="form-label">Maintence Interval: <span
                                    class="text-danger">*</span></label>
                            <input id="interval" type="number" name="interval" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="fail" class="form-label">Fail Schedule: <span
                                    class="text-danger">*</span></label>
                            <input id="fail" type="number" name="fail" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="question" class="form-label">Questions: <span class="text-danger">*</span></label>
                            <textarea name="question" class="form-control" id="question" cols="30" rows="5" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12 col-lg-3">
                        <button type="submit" class="btn btn-primary w-100"><i class="fa-solid fa-floppy-disk"></i> Save
                            Question</button>
                    </div>
                </div>

            </form>
        </div>

        <div class="animated-container">
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
                                    <th class="text-center sortable" data-index="0" onclick="sortTable(this)">
                                        # <span class="sort-icons"><span class="asc">▲</span><span
                                                class="desc">▼</span></span>
                                    </th>
                                    <th class="text-center sortable" data-index="1" onclick="sortTable(this)">
                                        Created By <span class="sort-icons"><span class="asc">▲</span><span
                                                class="desc">▼</span></span>
                                    </th>
                                    <th class="sortable" data-index="2" onclick="sortTable(this)">
                                        Question<span class="sort-icons"><span class="asc">▲</span><span
                                                class="desc">▼</span></span>
                                    </th>
                                    <th class="sortable" data-index="2" onclick="sortTable(this)">
                                        Maintenance Interval<span class="sort-icons"><span class="asc">▲</span><span
                                                class="desc">▼</span></span>
                                    </th>
                                    <th class="sortable" data-index="2" onclick="sortTable(this)">
                                        Fail Schedule<span class="sort-icons"><span class="asc">▲</span><span
                                                class="desc">▼</span></span>
                                    </th>

                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $index => $item)
                            <tr>
                                <td class="text-center">{{ $items->firstItem() + $index }}</td>

                                <td>
                                    @if ($item->user && $item->user->lname && $item->user->fname)
                                        {{ $item->user->lname }}, {{ $item->user->fname }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ $item->question }} Days</td>
                                <td class="text-center">{{ $item->maintenance_interval }} Days</td>
                                <td class="text-center">{{ $item->fail_reschedule_days }} Days</td>
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
                                                    action="{{ route('admin.UpdateQuestion', $item->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-content text-start">
                                                        <div class="modal-header ">
                                                            <h5 class="modal-title"
                                                                id="editModalLabel{{ $item->id }}">
                                                                Edit
                                                                Type</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <input type="hidden" name="id"
                                                                    value="{{ $item->id }}">
                                                                <label for="question{{ $item->id }}"
                                                                    class="form-label">Question: <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" name="question"
                                                                    id="question{{ $item->id }}" class="form-control"
                                                                    value="{{ $item->question }}">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="interval{{ $item->id }}"
                                                                    class="form-label">Maintence Interval: <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="number" name="interval"
                                                                    id="interval{{ $item->id }}" class="form-control"
                                                                    value="{{ $item->maintenance_interval }}">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="fail{{ $item->id }}"
                                                                    class="form-label">Fail Schedule: <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="number" name="fail"
                                                                    id="fail{{ $item->id }}" class="form-control"
                                                                    value="{{ $item->fail_reschedule_days }}">
                                                            </div>

                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-success">Update</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <form action="{{ route('admin.DeleteQuestions') }}" method="POST"
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

    <script src="{{ asset('/js/table/search.js') }}"></script>
    <script src="{{ asset('/js/table/sort.js') }}"></script>
@endsection
@push('css')
    <link href="{{ asset('css/custom.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/components/submenu.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
