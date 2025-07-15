function filterTable() {
    const input = document.getElementById("tableSearch");
    const filter = input.value.toLowerCase();
    const table = document.getElementById("sortableTable");
    const tbody = table.querySelector("tbody");
    const rows = tbody.getElementsByTagName("tr");

    let visibleCount = 0;

    // Remove previous "no results" row if it exists
    const existingNoResult = document.getElementById("noResultsRow");
    if (existingNoResult) {
        existingNoResult.remove();
    }

    for (let i = 0; i < rows.length; i++) {
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

        if (match) {
            row.style.display = "";
            visibleCount++;
        } else {
            row.style.display = "none";
        }
    }

    // Show "no results" row if nothing is visible
    if (visibleCount === 0) {
        const noResultsRow = document.createElement("tr");
        noResultsRow.id = "noResultsRow";

        const columnCount = rows[0]?.children.length || 1;

        noResultsRow.innerHTML = `
          <td colspan="${columnCount}" style="height: 100px; padding: 0;" class="p-0" >
            <div class="d-flex justify-content-center align-items-center h-100 w-100 text-muted">
                No results found.
            </div>
        </td>
        `;

        tbody.appendChild(noResultsRow);
    }
}
document.addEventListener("DOMContentLoaded", function () {
    const table = document.getElementById("sortableTable");
    const tbody = table?.querySelector("tbody");
    const searchInput = document.getElementById("tableSearch");

    const hasData = Array.from(tbody?.rows || []).some(
        (row) => row.id !== "noResultsRow" && row.id !== "noDataRow"
    );

    if (!hasData && searchInput) {
        searchInput.disabled = true;
        searchInput.placeholder = "No Available Data";
    }
});
