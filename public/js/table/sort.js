let sortDirection = {};
let lastSortedTh = null;

function sortTable(thElement) {
    const dataIndex = thElement.getAttribute("data-index");
    const table = document.querySelector(".sortable-table");
    const tbody = table.querySelector("tbody");
    const rows = Array.from(tbody.querySelectorAll("tr"));

    // Use the data-index but add 1 to account for the checkbox column
    const columnIndex = parseInt(dataIndex) + 1;

    sortDirection[dataIndex] = !sortDirection[dataIndex];
    const direction = sortDirection[dataIndex] ? 1 : -1;

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
        const aText = a.children[columnIndex].innerText.trim();
        const bText = b.children[columnIndex].innerText.trim();

        console.log(`Sorting column ${dataIndex}:`, aText, "vs", bText); // Debug log

        // Try to parse as numbers first
        const aNum = parseFloat(aText.replace(/[^\d.-]/g, ""));
        const bNum = parseFloat(bText.replace(/[^\d.-]/g, ""));

        // If both are valid numbers, compare numerically
        if (!isNaN(aNum) && !isNaN(bNum)) {
            return (aNum - bNum) * direction;
        }

        // For date columns (index 7 and 8), use date comparison
        if (dataIndex === "7" || dataIndex === "8") {
            const aDate = new Date(aText);
            const bDate = new Date(bText);
            if (!isNaN(aDate) && !isNaN(bDate)) {
                return (aDate - bDate) * direction;
            }
        }

        // Otherwise, use natural sorting for alphanumeric strings
        return (
            naturalCompare(aText.toLowerCase(), bText.toLowerCase()) * direction
        );
    });

    rows.forEach((row) => tbody.appendChild(row));
}

// Natural sorting function for alphanumeric strings
function naturalCompare(a, b) {
    const ax = [],
        bx = [];

    a.replace(/(\d+)|(\D+)/g, function (_, $1, $2) {
        ax.push([$1 || Infinity, $2 || ""]);
    });
    b.replace(/(\d+)|(\D+)/g, function (_, $1, $2) {
        bx.push([$1 || Infinity, $2 || ""]);
    });

    while (ax.length && bx.length) {
        const an = ax.shift();
        const bn = bx.shift();
        const nn = an[0] - bn[0] || an[1].localeCompare(bn[1]);
        if (nn) return nn;
    }

    return ax.length - bx.length;
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
