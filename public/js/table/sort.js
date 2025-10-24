const tableState = new WeakMap();

function getTableState(table) {
    if (!tableState.has(table)) {
        tableState.set(table, { sortDirection: {}, lastSortedTh: null });
    }
    return tableState.get(table);
}

function sortTable(thElement) {
    const table = thElement.closest("table");
    if (!table) return;

    const state = getTableState(table);

    const headerRow =
        thElement.closest("thead")?.querySelector("tr") ||
        thElement.parentElement;
    const headers = Array.from(headerRow.querySelectorAll("th"));
    const headerIndex = headers.indexOf(thElement);
    if (headerIndex === -1) return;

    const dataIndex = thElement.getAttribute("data-index");
    const key = dataIndex != null ? String(dataIndex) : String(headerIndex);

    const tbody = table.querySelector("tbody");
    if (!tbody) return;
    const rows = Array.from(tbody.querySelectorAll("tr"));

    state.sortDirection[key] = !state.sortDirection[key];
    const direction = state.sortDirection[key] ? 1 : -1;

    if (state.lastSortedTh && state.lastSortedTh !== thElement) {
        state.lastSortedTh.classList.remove("sorted");
        const prevAsc = state.lastSortedTh.querySelector(".asc");
        const prevDesc = state.lastSortedTh.querySelector(".desc");
        if (prevAsc) prevAsc.classList.remove("active");
        if (prevDesc) prevDesc.classList.remove("active");
    }

    thElement.classList.add("sorted");
    const ascEl = thElement.querySelector(".asc");
    const descEl = thElement.querySelector(".desc");
    if (ascEl) ascEl.classList.toggle("active", direction === 1);
    if (descEl) descEl.classList.toggle("active", direction === -1);
    state.lastSortedTh = thElement;

    function isEmpty(x) {
        return x === null || x === undefined || String(x).trim() === "";
    }

    function cleanText(cell) {
        return (cell?.textContent || "").replace(/\u00A0/g, " ").trim();
    }

    function parseNumber(str) {
        const cleaned = str.replace(/[^\d\-.]/g, "");
        const num = parseFloat(cleaned);
        return isNaN(num) ? null : num;
    }

    function tryParseDate(str) {
        if (!str) return NaN;
        const s = str.trim();

        let t = Date.parse(s);
        if (!isNaN(t)) return t;

        const dmy = s.match(/^(\d{1,2})[\/\-](\d{1,2})[\/\-](\d{2,4})(.*)$/);
        if (dmy) {
            const day = dmy[1].padStart(2, "0");
            const mon = dmy[2].padStart(2, "0");
            const year = dmy[3].length === 2 ? "20" + dmy[3] : dmy[3];

            t = Date.parse(`${mon}/${day}/${year}`);
            if (!isNaN(t)) return t;

            t = Date.parse(`${day}/${mon}/${year}`);
            if (!isNaN(t)) return t;
        }

        const noOrd = s.replace(/(\d+)(st|nd|rd|th)/gi, "$1");
        t = Date.parse(noOrd);
        return isNaN(t) ? NaN : t;
    }

    const collator = new Intl.Collator(undefined, {
        numeric: true,
        sensitivity: "base",
    });

    rows.sort((rowA, rowB) => {
        const aCell = rowA.children[headerIndex];
        const bCell = rowB.children[headerIndex];
        const aText = cleanText(aCell);
        const bText = cleanText(bCell);

        if (isEmpty(aText) && isEmpty(bText)) return 0;
        if (isEmpty(aText)) return 1 * direction;
        if (isEmpty(bText)) return -1 * direction;

        const aHasLetters = /[a-zA-Z]/.test(aText);
        const bHasLetters = /[a-zA-Z]/.test(bText);
        const aNum = parseNumber(aText);
        const bNum = parseNumber(bText);

        if (!aHasLetters && !bHasLetters && aNum !== null && bNum !== null) {
            if (aNum === bNum) return 0;
            return (aNum < bNum ? -1 : 1) * direction;
        }

        const forceDate = dataIndex === "7" || dataIndex === "8";
        const aDate = tryParseDate(aText);
        const bDate = tryParseDate(bText);
        if (
            (forceDate && !isNaN(aDate) && !isNaN(bDate)) ||
            (!isNaN(aDate) && !isNaN(bDate))
        ) {
            if (aDate === bDate) return 0;
            return (aDate < bDate ? -1 : 1) * direction;
        }

        return (
            collator.compare(aText.toLowerCase(), bText.toLowerCase()) *
            direction
        );
    });

    rows.forEach((r) => tbody.appendChild(r));
}

function naturalCompare(a, b) {
    return a.localeCompare(b, undefined, {
        numeric: true,
        sensitivity: "base",
    });
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
