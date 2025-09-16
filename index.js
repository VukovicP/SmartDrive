// PRELOADER
window.addEventListener("load", () => {
    const preloader = document.getElementById("preloader");

    // Dodaje klasu `animate` na preloader da započne animaciju linija
    preloader.classList.add("animate");

    // Čeka 1.5 sekundi dok se animacija linija završi, zatim pokreće nestajanje preloader-a
    setTimeout(() => {
        preloader.classList.add("fade-out");
    }, 1500); // Čeka 1.5 sekundi pre nego što započne fade-out

    // Potpuno uklanja preloader nakon 2.5 sekunde
    setTimeout(() => {
        preloader.style.display = "none";
    }, 2500);
});


// DINAMICKO ISPISIVANJE TEKSTA
document.addEventListener("DOMContentLoaded", function () {
    const text = "Drive with ease, explore without limits. Your perfect ride is just a key turn away! Affordable, reliable, and ready when you are. Wherever the road takes you, we’ve got you covered!";
    const speed = 30;
    let i = 0;
    const paragraph = document.getElementById("typewriter");

    function typeWriterEffect() {
        if (i < text.length) {
            paragraph.innerHTML += text.charAt(i);
            i++;
            setTimeout(typeWriterEffect, speed);
        }
    }

    typeWriterEffect();
});


// KALENDAR
document.addEventListener("DOMContentLoaded", function () {
  const today = new Date();
  const threeDaysLater = new Date();
  threeDaysLater.setDate(today.getDate() + 3);

  // Pickup date
  flatpickr("#pickup-date", {
    minDate: today,
    defaultDate: today,
    dateFormat: "Y-m-d"
  });

  // Return date
  flatpickr("#return-date", {
    minDate: today,
    defaultDate: threeDaysLater,
    dateFormat: "Y-m-d"
  });
});


// document.addEventListener("DOMContentLoaded", function () {
//   const dateInput = document.getElementById("pickup-date");
//   const returnDateInput = document.getElementById("return-date");

//   const today = new Date();
//   const yyyy = today.getFullYear();
//   let mm = today.getMonth() + 1;
//   let dd = today.getDate();

//   // formatiranje
//   if (mm < 10) mm = "0" + mm;
//   if (dd < 10) dd = "0" + dd;

//   const minDate = `${yyyy}-${mm}-${dd}`;
  
//   // default return date = +3 dana
//   const returnDateObj = new Date(today);
//   returnDateObj.setDate(returnDateObj.getDate() + 3);

//   let rmm = returnDateObj.getMonth() + 1;
//   let rdd = returnDateObj.getDate();
//   const ryyyy = returnDateObj.getFullYear();
//   if (rmm < 10) rmm = "0" + rmm;
//   if (rdd < 10) rdd = "0" + rdd;

//   const returnDate = `${ryyyy}-${rmm}-${rdd}`;

//   dateInput.min = minDate;
//   dateInput.value = minDate;

//   returnDateInput.min = minDate;
//   returnDateInput.value = returnDate;
// });



// JUMBOTRONS
document.addEventListener("DOMContentLoaded", function () {
    const jumbotrons = document.querySelectorAll(".jumbo-div");

    const observer = new IntersectionObserver(
        (entries, observer) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("jumbo-visible");
                    observer.unobserve(entry.target); // Prestaje posmatranje nakon prvog prikazivanja
                }
            });
        },
        { threshold: 0.2 } // Element je vidljiv kada je 20% u viewport-u
    );

    jumbotrons.forEach((jumbo) => observer.observe(jumbo));
});


// FOOTER
var year = new Date().getFullYear();
document.getElementById("copyright").innerText = "© " + year + ", SmartDrive";


// POPOUT LOGIN
// Selektovanje elemenata
const popup = document.getElementById("popupContainer");
const openBtn = document.getElementById("openPopup");
const openBtn2 = document.getElementById("openPopup2");
const closeBtn = document.getElementById("closePopup");

// Kada kliknem na dugme "Login", prikazuje se popup sa animacijom
openBtn.addEventListener("click", () => {
    popup.classList.add("show");
});
openBtn2.addEventListener("click", () => {
    popup.classList.add("show");
});

// Kada kliknem na "X", zatvara se popup
closeBtn.addEventListener("click", () => {
    popup.classList.remove("show");
});

// Kada kliknem van popup-a, takođe se zatvara
window.addEventListener("click", (e) => {
    if (e.target === popup) {
        popup.classList.remove("show");
    }
}); 


// LOGIN PROVERA
document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("forma-login").addEventListener("submit", function (event) {
    
        event.preventDefault();
    
        let formData = new FormData(this);
    
        // Slanje podataka AJAXOM
        fetch("./login.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json()) 
        .then(data => {
            if (data.success) {
                window.location.href = data.redirect;
            }
            else {
                let header = document.getElementById("login-header");
                header.innerText = data.message;
                header.style.color = "red";
            }
        })
        .catch(error => console.error("Error greska: ", error));
    });
});


