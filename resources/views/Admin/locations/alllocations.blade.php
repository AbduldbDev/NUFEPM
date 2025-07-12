@extends('layouts.app')
@section('content')
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

        <div class="add-extinguisher-container shadow-sm">

            <form action="{{ route('SubmitNewTank') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <h1 class="text-lg addnew-title"><i class="fa-solid fa-file-circle-plus"></i> Add New Extinguishers
                        </h1>
                        <div class="mb-3">
                            <label for="serial_number" class="form-label">Serial Number</label>
                            <input type="text" name="serial_number" class="form-control" required>
                        </div>

                        {{-- <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <input type="text" name="category" class="form-control" required>
                        </div> --}}

                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <input type="text" name="type" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="capacity" class="form-label">Capacity</label>
                            <input type="text" name="capacity" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="installation_date" class="form-label">Installation Date</label>
                            <input type="date" name="installation_date" class="form-control" required>
                        </div>

                        {{-- <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="Active">Active</option>
                                <option value="Retired">Retired</option>
                                <option value="Under Maintenance">Under Maintenance</option>
                            </select>
                        </div> --}}
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <h1 class="text-lg addnew-title"><i class="fa-solid fa-building"></i> Extinguisher Location
                        </h1>
                        <div class="mb-3">
                            <label for="location" class="form-label">Building</label>
                            <input type="text" name="location" class="form-control" required>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Save Extinguisher</button>
            </form>
        </div>
    </div>

    {{-- <div class="container-fluid p-5 my-5 shadow-sm">
        <table class="extinguisher-table table table-responsive">
            <thead>
                <tr>
                    <th class="text-center sortable" data-index="0" onclick="sortTable(this)">
                        # <span class="sort-icons"><span class="asc">▲</span><span class="desc">▼</span></span>
                    </th>
                    <th class="text-center sortable" data-index="1" onclick="sortTable(this)">
                        QR Codes <span class="sort-icons"><span class="asc">▲</span><span class="desc">▼</span></span>
                    </th>
                    <th class="sortable" data-index="2" onclick="sortTable(this)">
                        Serial Number <span class="sort-icons"><span class="asc">▲</span><span
                                class="desc">▼</span></span>
                    </th>
                    <th class="sortable" data-index="3" onclick="sortTable(this)">
                        Extinguisher Type <span class="sort-icons"><span class="asc">▲</span><span
                                class="desc">▼</span></span>
                    </th>
                    <th class="sortable" data-index="4" onclick="sortTable(this)">
                        Extinguisher Location <span class="sort-icons"><span class="asc">▲</span><span
                                class="desc">▼</span></span>
                    </th>
                    <th class="text-center sortable" data-index="5" onclick="sortTable(this)">
                        Last Maintenance <span class="sort-icons"><span class="asc">▲</span><span
                                class="desc">▼</span></span>
                    </th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tanks as $index => $item)
                    <tr>
                        <td style="vertical-align: middle; text-align: center;">
                            {{ $index + 1 }}
                        </td>
                        <td style="vertical-align: middle; text-align: center;">

                            <img src="{{ asset($item->qr_code_path) }}" alt="QR Code" width="100px">
                            {{ $item->extinguisher_id }}

                        </td>
                        <td style="vertical-align: middle; text-align: center;">
                            {{ $item->serial_number }}
                        </td>
                        <td style="vertical-align: middle; text-align: center;">
                            {{ $item->type }}
                        </td>
                        <td style="vertical-align: middle; text-align: center;">
                            {{ $item->location }}
                        </td>
                        <td style="vertical-align: middle; text-align: center;">
                            {{ \Carbon\Carbon::parse($item->last_maintenance)->format('F d, Y') }}

                        </td>
                        <td style="vertical-align: middle; text-align: center;">
                            {{ $item->status }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div> --}}
    <script>
        let sortDirection = {};
        let lastSortedTh = null;

        function sortTable(thElement) {
            const columnIndex = thElement.getAttribute('data-index');
            const table = document.querySelector(".extinguisher-table");
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
