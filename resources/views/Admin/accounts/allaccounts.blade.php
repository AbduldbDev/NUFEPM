@extends('layouts.app')
@section('content')
    @include('layouts.components.alerts')
    <div class="main-container container">
        <div class="title">
            <span class="menu-title-icon"><i class="fa-solid fa-users"></i></span> &nbsp;
            <span class="crumb">
                <span class="breadcrumbs"><a href="{{ route('dashboard') }}">Home</a> &gt; </span>
            </span>
            <span class="crumb">
                <span class="breadcrumbs"><a href="{{ route('admin.ShowAccountsMenu') }}">Accounts</a> &gt; </span>
            </span>
            <span class="breadcrumbs">All Accounts </span>
        </div>
        <hr>
    </div>

    <div class="container">
        <input type="text" id="tableSearch" class="form-control mb-3 w-25" placeholder="Search..."
            onkeyup="filterTable()">
        <div class="table-responsive">
            <table class="accounts-table table table-responsive table-bordered w-100" id="employeeTable">
                <thead>
                    <tr>
                        <th class="text-center sortable" data-index="0" onclick="sortTable(this)">
                            # <span class="sort-icons"><span class="asc">▲</span><span class="desc">▼</span></span>
                        </th>
                        <th class="text-center sortable" data-index="1" onclick="sortTable(this)">
                            Role <span class="sort-icons"><span class="asc">▲</span><span class="desc">▼</span></span>
                        </th>
                        <th class="sortable" data-index="2" onclick="sortTable(this)">
                            Name <span class="sort-icons"><span class="asc">▲</span><span class="desc">▼</span></span>
                        </th>
                        <th class="sortable" data-index="3" onclick="sortTable(this)">
                            Employee ID <span class="sort-icons"><span class="asc">▲</span><span
                                    class="desc">▼</span></span>
                        </th>
                        <th class="sortable" data-index="4" onclick="sortTable(this)">
                            Email <span class="sort-icons"><span class="asc">▲</span><span class="desc">▼</span></span>
                        </th>
                        <th class="text-center sortable" data-index="5" onclick="sortTable(this)">
                            Status <span class="sort-icons"><span class="asc">▲</span><span
                                    class="desc">▼</span></span>
                        </th>
                        <th class="text-center">Action</th>
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
                            <td class="text-center d-flex justify-content-center">
                                <div class="d-flex">
                                    <a class="mx-2" href="{{ url('Accounts/Details/' . $item->id) }}">
                                        <i class="fa-regular fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.DeleteAccount') }}" method="POST"
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
            const table = document.querySelector(".accounts-table");
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

        function filterTable() {
            const input = document.getElementById("tableSearch");
            const filter = input.value.toLowerCase();
            const table = document.getElementById("employeeTable");
            const rows = table.getElementsByTagName("tr");

            for (let i = 1; i < rows.length; i++) {
                const row = rows[i];
                const cells = row.getElementsByTagName("td");
                let match = false;

                for (let j = 0; j < cells.length; j++) {
                    const cell = cells[j];
                    if (cell.textContent.toLowerCase().includes(filter)) {
                        match = true;
                        break;
                    }
                }
                row.style.display = match ? "" : "none";
            }
        }
    </script>
@endsection
@push('css')
    <link href="{{ asset('css/components/submenu.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/accounts.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
