let userHasInteracted = false;

function fetchLocations(params, callback) {
    const url = new URL("/Extinguisher/location/edit", window.location.origin);
    Object.keys(params).forEach((key) => {
        if (params[key]) url.searchParams.append(key, params[key]);
    });

    fetch(url)
        .then((res) => res.json())
        .then((data) => callback(data));
}

function resetSelect(id, label = "") {
    const select = document.getElementById(id);
    select.innerHTML = `<option value=""  style="text-transform: uppercase">Select ${label}</option>`;
    select.required = false;
    const group = document.getElementById(`${id}-group`);
    if (group) group.style.display = "none";
}

function populateSelect(id, items) {
    const select = document.getElementById(id);
    const group = document.getElementById(`${id}-group`);
    const label = id.charAt(0).toUpperCase() + id.slice(1);

    if (!items || items.length === 0) {
        if (select) {
            select.innerHTML = `<option value="" style="text-transform: uppercase">Select ${label}</option>`;
            select.required = false;
        }
        if (group) group.style.display = "none";
        return;
    }

    select.innerHTML = `<option value=""  style="text-transform: uppercase">Select ${label}</option>`;
    items.forEach((item) => {
        select.innerHTML += `<option value="${item}">${item}</option>`;
        console.log(`populateSelect("${id}") with:`, items);
    });
    select.required = true;
    if (group) group.style.display = "block";
}

function tryGetLocationId() {
    const building = document.getElementById("building").value;
    const floor = document.getElementById("floor")?.value || "";
    const room = document.getElementById("room")?.value || "";
    const spot = document.getElementById("spot")?.value || "";

    const url = `/Extinguisher/location-id?building=${encodeURIComponent(
        building
    )}&floor=${encodeURIComponent(floor)}&room=${encodeURIComponent(
        room
    )}&spot=${encodeURIComponent(spot)}`;

    fetch(url)
        .then((res) => res.json())
        .then((data) => {
            const locationId = data.id || "";
            const hiddenInput = document.getElementById("location_id");

            if (hiddenInput) hiddenInput.value = locationId;

            updateLocationValidationUI(locationId);
        })
        .catch((err) => {
            console.error("Failed to get location ID", err);
        });
}

function updateLocationValidationUI(locationId) {
    const statusText = document.getElementById("location-status");
    const submitButton = document.getElementById("submit-button");

    const selects = ["building", "floor", "room", "spot"].map((id) =>
        document.getElementById(id)
    );

    if (userHasInteracted) {
        if (locationId) {
            statusText.textContent = "Valid Location";
            statusText.style.color = "green";
            statusText.style.display = "inline";

            selects.forEach((select) => {
                if (select) {
                    select.classList.remove("border-danger");
                    select.classList.add("border-success");
                }
            });

            submitButton.disabled = false;
        } else {
            statusText.textContent = "Invalid Location";
            statusText.style.color = "red";
            statusText.style.display = "inline";

            selects.forEach((select) => {
                if (select) {
                    select.classList.remove("border-success");
                    select.classList.add("border-danger");
                }
            });

            submitButton.disabled = true;
        }
    } else {
        statusText.style.display = "none";
    }
}

async function preloadLocation(locationId) {
    if (!locationId) return;

    try {
        const res = await fetch(`/Extinguisher/location/show/${locationId}`);
        const data = await res.json();
        if (!data || !data.building) return;

        document.getElementById("building").value = data.building;

        const fetchUrl = new URL(
            "/Extinguisher/location/edit",
            window.location.origin
        );
        fetchUrl.searchParams.append("building", data.building);
        if (data.floor) fetchUrl.searchParams.append("floor", data.floor);
        if (data.room) fetchUrl.searchParams.append("room", data.room);

        const locations = await fetch(fetchUrl).then((r) => r.json());

        if (locations.floors?.length) {
            populateSelect("floor", locations.floors);
            if (data.floor) {
                await waitForOption("floor", data.floor);
                document.getElementById("floor").value = data.floor;
            }
        } else {
            resetSelect("floor", "Floor");
        }

        if (locations.rooms?.length) {
            populateSelect("room", locations.rooms);
            if (data.room) {
                await waitForOption("room", data.room);
                document.getElementById("room").value = data.room;
            }
        } else {
            resetSelect("room", "Room");
        }

        if (locations.spots?.length) {
            populateSelect("spot", locations.spots);
            if (data.spot) {
                await waitForOption("spot", data.spot);
                document.getElementById("spot").value = data.spot;
            }
        } else {
            resetSelect("spot", "Spot");
        }

        tryGetLocationId();
    } catch (err) {
        console.error("Preload error:", err);
    }
}

function waitForOption(selectId, expectedValue, maxWait = 3000) {
    return new Promise((resolve, reject) => {
        const start = Date.now();

        function check() {
            const select = document.getElementById(selectId);
            const found = Array.from(select.options).some(
                (opt) => opt.value === expectedValue
            );

            if (found) return resolve();
            if (Date.now() - start > maxWait)
                return reject(`Timeout waiting for ${selectId} value`);

            setTimeout(check, 100);
        }

        check();
    });
}
document.getElementById("building").addEventListener("change", function () {
    this.dataset.userSelected = "true";
    userHasInteracted = true;
    resetSelect("floor", "Floor");
    resetSelect("room", "Room");
    resetSelect("spot", "Spot");
    tryGetLocationId(); // This triggers UI update

    const building = this.value;
    if (building) {
        fetchLocations({ building }, (data) => {
            if (data.floors?.length) populateSelect("floor", data.floors);
            if (data.rooms?.length) populateSelect("room", data.rooms);
            if (data.spots?.length) populateSelect("spot", data.spots);
        });
    }
});

document.getElementById("floor").addEventListener("change", function () {
    this.dataset.userSelected = "true";
    userHasInteracted = true;
    resetSelect("room", "Room");
    resetSelect("spot", "Spot");
    tryGetLocationId();

    const building = document.getElementById("building").value;
    const floor = this.value;
    if (floor) {
        fetchLocations({ building, floor }, (data) => {
            if (data.rooms.length) populateSelect("room", data.rooms);
            if (data.spots.length) populateSelect("spot", data.spots);
        });
    }
});

document.getElementById("room").addEventListener("change", function () {
    this.dataset.userSelected = "true";
    userHasInteracted = true;
    resetSelect("spot", "Spot");
    tryGetLocationId();

    const building = document.getElementById("building").value;
    const floor = document.getElementById("floor")?.value || "";
    const room = this.value;
    if (room) {
        fetchLocations({ building, floor, room }, (data) => {
            if (data.spots.length) populateSelect("spot", data.spots);
        });
    }
});

document.getElementById("spot").addEventListener("change", function () {
    this.dataset.userSelected = "true";
    userHasInteracted = true;
    tryGetLocationId();
});
