function fetchLocations(params, callback) {
    const url = new URL("/Extinguisher/location/get", window.location.origin);
    Object.keys(params).forEach((key) => {
        if (params[key]) url.searchParams.append(key, params[key]);
    });

    fetch(url)
        .then((res) => res.json())
        .then((data) => callback(data));
}

function resetSelect(id, label = "") {
    const select = document.getElementById(id);
    select.innerHTML = `<option value="">Select ${label}</option>`;
    select.required = false;
    const group = document.getElementById(`${id}-group`);
    if (group) group.style.display = "none";
}

function populateSelect(id, items) {
    const select = document.getElementById(id);
    const group = document.getElementById(`${id}-group`);
    if (!items.length) {
        resetSelect(id);
        return;
    }

    const label = id.charAt(0).toUpperCase() + id.slice(1);
    select.innerHTML = `<option value="">Select ${label}</option>`;
    items.forEach((item) => {
        select.innerHTML += `<option value="${item}">${item}</option>`;
    });

    if (group) group.style.display = "block";
}

function tryGetLocationId() {
    const building = document.getElementById("building").value;
    const floor = document.getElementById("floor")?.value || "";
    const room = document.getElementById("room")?.value || "";
    const spot = document.getElementById("spot")?.value || "";

    const url = `/Extinguisher/location/id?building=${encodeURIComponent(
        building
    )}&floor=${encodeURIComponent(floor)}&room=${encodeURIComponent(
        room
    )}&spot=${encodeURIComponent(spot)}`;

    fetch(url)
        .then((res) => res.json())
        .then((data) => {
            const locationId = data.id || "";
            const hiddenInput = document.getElementById("location_id");
            const displayInput = document.getElementById("location_id_display");
            if (hiddenInput) hiddenInput.value = locationId;
            if (displayInput) displayInput.value = locationId;

            updateLocationValidationUI();
        })
        .catch((err) => {
            console.error("Failed to get location ID", err);
        });
}

function updateLocationValidationUI() {
    const locationId = document.getElementById("location_id_display").value;
    const statusText = document.getElementById("location-status");
    const submitButton = document.getElementById("submit-button");

    const selects = ["building", "floor", "room", "spot"].map((id) =>
        document.getElementById(id)
    );

    if (locationId) {
        statusText.textContent = "Valid Location";
        statusText.style.color = "green";

        selects.forEach((select) => {
            if (select) {
                select.classList.add("border-success");
                select.classList.remove("border-danger");
            }
        });

        submitButton.disabled = false;
    } else {
        statusText.textContent = "Invalid Location";
        statusText.style.color = "red";

        selects.forEach((select) => {
            if (select) {
                select.classList.add("border-danger");
                select.classList.remove("border-success");
            }
        });

        submitButton.disabled = true;
    }
}

document.getElementById("building").addEventListener("change", function () {
    const building = this.value;
    resetSelect("floor", "Floor");
    resetSelect("room", "Room");
    resetSelect("spot", "Spot");
    tryGetLocationId();

    if (building) {
        fetchLocations(
            {
                building,
            },
            (data) => {
                if (data.floors.length) populateSelect("floor", data.floors);
                if (data.rooms.length) populateSelect("room", data.rooms);
                if (data.spots.length) populateSelect("spot", data.spots);
            }
        );
    }
});

document.getElementById("floor").addEventListener("change", function () {
    const building = document.getElementById("building").value;
    const floor = this.value;
    resetSelect("room", "Room");
    resetSelect("spot", "Spot");
    tryGetLocationId();

    if (floor) {
        fetchLocations(
            {
                building,
                floor,
            },
            (data) => {
                if (data.rooms.length) populateSelect("room", data.rooms);
                if (data.spots.length) populateSelect("spot", data.spots);
            }
        );
    }
});

document.getElementById("room").addEventListener("change", function () {
    const building = document.getElementById("building").value;
    const floor = document.getElementById("floor")?.value || "";
    const room = this.value;
    resetSelect("spot", "Spot");
    tryGetLocationId();

    if (room) {
        fetchLocations(
            {
                building,
                floor,
                room,
            },
            (data) => {
                if (data.spots.length) populateSelect("spot", data.spots);
            }
        );
    }
});

document.getElementById("spot").addEventListener("change", function () {
    tryGetLocationId();
});
