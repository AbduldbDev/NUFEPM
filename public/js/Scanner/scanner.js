let hasScanned = false;
let html5QrCode = null;

const readerElement = document.getElementById("reader");
const errorElement = document.getElementById("error");
const errorMessageElement = document.getElementById("errorMessage");
const spinnerElement = document.getElementById("loadingSpinner");
const statusCard = document.getElementById("scannerStatus");

function updateStatus(type, title, message) {
    const icon = statusCard.querySelector(".status-icon");
    const titleElement = statusCard.querySelector(".status-title");
    const messageElement = statusCard.querySelector(".status-content p");

    statusCard.style.display = "block";
    icon.className = "status-icon " + type;

    if (type === "info") {
        icon.innerHTML = '<i class="fa-solid fa-info-circle"></i>';
    } else if (type === "error") {
        icon.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i>';
    } else if (type === "success") {
        icon.innerHTML = '<i class="fa-solid fa-check-circle"></i>';
    }

    titleElement.textContent = title;
    messageElement.textContent = message;
}

function showError(message) {
    errorMessageElement.textContent = message;
    errorElement.style.display = "block";
    updateStatus(
        "error",
        "Scanner Error",
        "An error occurred while using the scanner."
    );
}

function hideError() {
    errorElement.style.display = "none";
}

function getCameras() {
    return Html5Qrcode.getCameras().then((devices) => {
        if (devices && devices.length) {
            const backCamera = devices.find((device) =>
                device.label.toLowerCase().includes("back")
            );

            return backCamera || devices[0];
        }
        throw new Error("No cameras found");
    });
}

function startScanner() {
    hasScanned = false;
    hideError();

    if (!html5QrCode) {
        html5QrCode = new Html5Qrcode("reader");
    }

    getCameras()
        .then((camera) => {
            return html5QrCode.start(
                camera.id,
                {
                    fps: 10,
                    qrbox: {
                        width: 250,
                        height: 250,
                    },
                    supportedScanTypes: [Html5QrcodeScanType.SCAN_TYPE_CAMERA],
                },
                onScanSuccess,
                onScanFailure
            );
        })
        .then(() => {
            spinnerElement.style.display = "none";
            updateStatus(
                "success",
                "Scanner Active",
                "Position the QR code in the frame to scan."
            );
        })
        .catch((err) => {
            spinnerElement.style.display = "none";
            showError(`Failed to start scanner: ${err.message || err}`);
            updateStatus(
                "error",
                "Scanner Error",
                "Could not start the scanner. Please check your camera permissions."
            );
        });
}

function onScanSuccess(decodedText, decodedResult) {
    if (hasScanned) return;
    hasScanned = true;

    readerElement.style.border = "3px solid var(--success)";
    setTimeout(() => {
        readerElement.style.border = "none";
    }, 500);

    updateStatus(
        "success",
        "QR Code Detected",
        "Redirecting to inspection details..."
    );

    html5QrCode
        .stop()
        .then(() => {
            window.location.href = `/Inspection/Details/${encodeURIComponent(
                decodedText
            )}`;
        })
        .catch((err) => {
            showError(`Stop scanner error: ${err}`);
        });
}

function onScanFailure(error) {}

document.addEventListener("DOMContentLoaded", () => {
    startScanner();
});
