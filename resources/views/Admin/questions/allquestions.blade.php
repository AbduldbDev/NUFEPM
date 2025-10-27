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
                <i class="fa-solid fa-circle-question"></i>
            </div>
            <nav class="breadcrumb-nav">
                <div class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Home</a>
                </div>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <div class="breadcrumb-item active">
                    <span>Questions</span>
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
                        data-bs-target="#addQuestionModal"><i class="bi bi-file-earmark-plus"></i> Add New</button>
                    @include('Admin.questions.modals.addquestion')
                </div>
            </div>

            <div class="table-responsive mt-3">
                <table class="sortable-table table table-responsive" id="sortableTable">
                    <thead>
                        <tr>
                            <thead>
                                <tr>
                                    <th class="text-center align-middle sortable" data-index="0" onclick="sortTable(this)">
                                        # <span class="sort-icons"><span class="asc">▲</span><span
                                                class="desc">▼</span></span>
                                    </th>
                                    <th class="text-center align-middle sortable" data-index="1" onclick="sortTable(this)">
                                        Created By <span class="sort-icons"><span class="asc">▲</span><span
                                                class="desc">▼</span></span>
                                    </th>
                                    <th class="text-center align-middle sortable" data-index="2" onclick="sortTable(this)">
                                        Question Type <span class="sort-icons"><span class="asc">▲</span><span
                                                class="desc">▼</span></span>
                                    </th>
                                    <th class="text-center sortable align-middle " data-index="3" onclick="sortTable(this)">
                                        Question<span class="sort-icons"><span class="asc">▲</span><span
                                                class="desc">▼</span></span>
                                    </th>
                                    <th class="text-center sortable align-middle" data-index="4" onclick="sortTable(this)">
                                        Maintenance Interval<span class="sort-icons"><span class="asc">▲</span><span
                                                class="desc">▼</span></span>
                                    </th>
                                    <th class="text-center sortable align-middle" data-index="5" onclick="sortTable(this)">
                                        Fail Schedule<span class="sort-icons"><span class="asc">▲</span><span
                                                class="desc">▼</span></span>
                                    </th>

                                    <th class="text-center align-middle">Action</th>
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
                                <td class="text-capitalize">{{ str_replace('_', ' ', $item->type) }}</td>
                                <td>{{ $item->question }} Days</td>
                                <td class="text-center">{{ $item->maintenance_interval }} Days</td>
                                <td class="text-center">{{ $item->fail_reschedule_days }} Days</td>
                                <td class="text-center align-middle">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <button class="edit-btn" style="border: none; background-color: transparent"
                                            data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        @include('Admin.questions.modals.editquestions')
                                        <form action="{{ route('admin.DeleteQuestions') }}" method="POST"
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

    <script src="{{ asset('/js/table/search.js') }}"></script>
    <script src="{{ asset('/js/table/sort.js') }}"></script>
@endsection
@push('css')
    <link href="{{ asset('css/custom.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/components/submenu.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
