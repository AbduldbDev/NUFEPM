function showFloatingAlert(message = "Success!", type = "success") {
    const alert = document.getElementById("floatingAlert");
    const icon = document.getElementById("alertIcon");
    const messageEl = document.getElementById("alertMessage");

    const iconMap = {
        success: "fa-check-circle",
        danger: "fa-times-circle",
        warning: "fa-exclamation-circle",
        info: "fa-info-circle",
    };

    const colorMap = {
        success: "#198754",
        danger: "#dc3545",
        warning: "#ffc107",
        info: "#0dcaf0",
    };

    alert.style.borderLeftColor = colorMap[type];
    icon.className = `fas ${iconMap[type]} fa-lg fa-beat`;
    icon.style.color = colorMap[type];
    messageEl.textContent = message;

    alert.classList.remove("hide");
    alert.classList.add("show");

    setTimeout(() => {
        hideFloatingAlert();
    }, 3000);
}

function hideFloatingAlert() {
    const alert = document.getElementById("floatingAlert");
    alert.classList.remove("show");
    alert.classList.add("hide");
}
