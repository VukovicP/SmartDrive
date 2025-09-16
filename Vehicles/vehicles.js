
// Elegantno ucitavanje kartica
document.addEventListener("DOMContentLoaded", function () {
    const cards = document.querySelectorAll(".vehicleCard");

    cards.forEach((card, index) => {
        setTimeout(() => {
            card.classList.add("show");
        }, index * 300); // Svaka kartica se pojavljuje sa malim kašnjenjem
    });
});

// VEHICLES DETAILS
function openVehicleDetails(vehicleId) {
    const detailsPopup = document.getElementById(`vehicleDetails_${vehicleId}`);
    if (detailsPopup) {
        detailsPopup.classList.add("active");
    } else {
        console.error(`Element vehicleDetails_${vehicleId} nije pronadjen!`);
    }
}


function updatePrice(vehicleId, basePrice, unlimitedPrice) {
    let unlimitedOption = document.getElementById("unlimited_" + vehicleId);
    let priceElement = document.getElementById("price_" + vehicleId);

    let total = unlimitedPrice + basePrice;

    if (unlimitedOption.checked) {
        priceElement.innerHTML = total + "€ / day";
    }
    else {
        priceElement.innerHTML = basePrice + "€ / day";
    }
}


function closeVehicleDetails(vehicleId) {
    const detailsPopup = document.getElementById(`vehicleDetails_${vehicleId}`);
    if (detailsPopup) {
        detailsPopup.classList.remove("active");
    }
    else {
        console.error(`Element vehicleDetails_${vehicleId} nije pronadjen!`);
    }
}


// FOOTER
var year = new Date().getFullYear();
document.getElementById("copyr").innerText = "© " + year + ", SmartDrive";

