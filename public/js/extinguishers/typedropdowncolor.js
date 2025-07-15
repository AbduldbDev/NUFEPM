const typeSelect = document.getElementById("type");
function setSelectColor() {
    const selectedOption = typeSelect.options[typeSelect.selectedIndex];
    typeSelect.style.color = selectedOption.style.color || "#000";
}
window.addEventListener("DOMContentLoaded", setSelectColor);
typeSelect.addEventListener("change", setSelectColor);
