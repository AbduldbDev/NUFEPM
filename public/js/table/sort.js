let sortDirection = {};
let lastSortedTh = null;

function sortTable(thElement) {
    const columnIndex = thElement.getAttribute("data-index");
    const table = document.querySelector(".sortable-table");
    const tbody = table.querySelector("tbody");
    const rows = Array.from(tbody.querySelectorAll("tr"));

    sortDirection[columnIndex] = !sortDirection[columnIndex];
    const direction = sortDirection[columnIndex] ? 1 : -1;

    if (lastSortedTh && lastSortedTh !== thElement) {
        lastSortedTh.classList.remove("sorted");
        lastSortedTh.querySelector(".asc").classList.remove("active");
        lastSortedTh.querySelector(".desc").classList.remove("active");
    }

    thElement.classList.add("sorted");
    thElement.querySelector(".asc").classList.toggle("active", direction === 1);
    thElement
        .querySelector(".desc")
        .classList.toggle("active", direction === -1);
    lastSortedTh = thElement;

    rows.sort((a, b) => {
        const aText = a.children[columnIndex].innerText.trim().toLowerCase();
        const bText = b.children[columnIndex].innerText.trim().toLowerCase();
        return (
            aText.localeCompare(bText, undefined, {
                numeric: true,
            }) * direction
        );
    });

    rows.forEach((row) => tbody.appendChild(row));
}
let formToSubmit = null;

function confirmDelete(form) {
    formToSubmit = form;
    const deleteModal = new bootstrap.Modal(
        document.getElementById("deleteConfirmModal")
    );
    deleteModal.show();
    return false;
}

function proceedDelete() {
    if (formToSubmit) {
        formToSubmit.submit();
    }
}
