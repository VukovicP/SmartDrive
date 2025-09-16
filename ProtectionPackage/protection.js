
// Azuriranje trenutne cene nakon odabira package-a
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".package-checkbox").forEach(radio => {
        radio.addEventListener("change", function() {
            let packagePrice = parseFloat(this.closest('.package').querySelector('.package-price strong').textContent);

            let newCurrentPrice = basePrice + packagePrice;

            document.querySelector("#total-price p strong").textContent = newCurrentPrice.toFixed(2) + "€ / day";
        });
    });
});

// Priprema cene za prenos na sledecu stranu, kao i azuriranje trenutne cene
document.querySelectorAll('input[name="protection_package"]').forEach(radio => {
    radio.addEventListener("change", function () {
        let packagePrice = parseFloat(this.closest('.package').querySelector('.package-price strong').textContent);
        let currentPriceDisplay = document.getElementById("currentPriceDisplay");
        let currentPriceInput = document.getElementById("currentPriceInput");

        // Dohvati osnovnu cenu iz hidden inputa (postavljenu pri učitavanju stranice)
        let basePrice = parseFloat(currentPriceInput.defaultValue);

        // Izračunaj novu cenu
        let newTotalPrice = basePrice + packagePrice;

        // Ažuriraj vrednosti na stranici
        currentPriceDisplay.textContent = newTotalPrice.toFixed(2) + "€ / day";
        currentPriceInput.value = newTotalPrice.toFixed(2); // Ažurira hidden input za slanje u PHP
    });
});

// Primena animacije pojavljivanja kartica sa osiguranjem
document.addEventListener("DOMContentLoaded", function () {
    const packages = document.querySelectorAll(".package");

    packages.forEach((package, index) => {
        setTimeout(() => {
            package.classList.add("visible");
        }, index * 200); 
    });
});


// FOOTER
var year = new Date().getFullYear();
document.getElementById("copyr").innerText = "© " + year + ", SmartDrive";

