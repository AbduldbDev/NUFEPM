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
            <span class="breadcrumbs">Types</span>
        </div>
        <hr>

        <div class="add-extinguisher-container shadow-sm">
            <form action="{{ route('admin.SubmitNewType') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <h1 class="text-lg addnew-title"><i class="fa-solid fa-file-circle-plus"></i> Add New Type
                        </h1>
                        <div class="mb-3">
                            <label for="serial_number" class="form-label">Created By: </label>
                            <input type="text" name="serial_number" class="form-control" readonly
                                value="{{ Auth::user()->lname }}, {{ Auth::user()->fname }}">
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label">Name:</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="capacity" class="form-label">Color</label>
                            <input type="color" name="color" class="form-control w-25" required>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Save
                    Extinguisher</button>
            </form>
        </div>

        <div class="table-responsive mt-5">
            <table class="sortable-table table table-responsive">
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
                                    Name<span class="sort-icons"><span class="asc">▲</span><span
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
                            <td style="color: {{ $item->color }}">{{ $item->name }}</td>
                            <td class="d-flex justify-content-center">
                                <div class="d-flex">
                                    <button style="border: none; background-color: transparent" data-bs-toggle="modal"
                                        data-bs-target="#editModal{{ $item->id }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form method="POST" action="{{ route('admin.UpdateType', $item->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit
                                                            Type</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <input type="hidden" name="id"
                                                                value="{{ $item->id }}">
                                                            <label for="name{{ $item->id }}" class="form-label">Type
                                                                Name</label>
                                                            <input type="text" name="name"
                                                                id="name{{ $item->id }}" class="form-control"
                                                                value="{{ $item->name }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="color{{ $item->id }}"
                                                                class="form-label">Color</label>
                                                            <input type="color" name="color"
                                                                id="color{{ $item->id }}" class="form-control w-25"
                                                                value="{{ $item->color }}">
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

                                    <form action="{{ route('admin.DeleteTypes') }}" method="POST"
                                        onsubmit="return confirmDelete(this);">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <button class="mx-2" type="submit" title="Delete"
                                            style="border: none; background-color: transparent">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function confirmDelete(form) {
            return confirm('Are you sure you want to delete this account?');
        }
    </script>
    <script>
        let sortDirection = {};
        let lastSortedTh = null;

        function sortTable(thElement) {
            const columnIndex = thElement.getAttribute('data-index');
            const table = document.querySelector(".sortable-table");
            const tbody = table.querySelector("tbody");
            const rows = Array.from(tbody.querySelectorAll("tr"));


            sortDirection[columnIndex] = !sortDirection[columnIndex];
            const direction = sortDirection[columnIndex] ? 1 : -1;


            if (lastSortedTh && lastSortedTh !== thElement) {
                lastSortedTh.classList.remove('sorted');
                lastSortedTh.querySelector('.asc').classList.remove('active');
                lastSortedTh.querySelector('.desc').classList.remove('active');
            }


            thElement.classList.add('sorted');
            thElement.querySelector('.asc').classList.toggle('active', direction === 1);
            thElement.querySelector('.desc').classList.toggle('active', direction === -1);
            lastSortedTh = thElement;


            rows.sort((a, b) => {
                const aText = a.children[columnIndex].innerText.trim().toLowerCase();
                const bText = b.children[columnIndex].innerText.trim().toLowerCase();
                return aText.localeCompare(bText, undefined, {
                    numeric: true
                }) * direction;
            });

            rows.forEach(row => tbody.appendChild(row));
        }

        // function filterTable() {
        //     const input = document.getElementById("tableSearch");
        //     const filter = input.value.toLowerCase();
        //     const table = document.getElementById("employeeTable");
        //     const rows = table.getElementsByTagName("tr");

        //     for (let i = 1; i < rows.length; i++) {
        //         const row = rows[i];
        //         const cells = row.getElementsByTagName("td");
        //         let match = false;

        //         for (let j = 0; j < cells.length; j++) {
        //             const cell = cells[j];
        //             if (cell.textContent.toLowerCase().includes(filter)) {
        //                 match = true;
        //                 break;
        //             }
        //         }
        //         row.style.display = match ? "" : "none";
        //     }
        // }
    </script>
@endsection
@push('css')
    <link href="{{ asset('css/extinguisher.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/components/submenu.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
