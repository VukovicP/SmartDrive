// DINAMICKO ISPISIVANJE TEKSTA
document.addEventListener("DOMContentLoaded", function () {
    const text = "Thank you for choosing our rent-a-car service! Your reservation has been successfully created, and your vehicle will be ready for you as scheduled. A confirmation email with all the details has been sent to you!";
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



window.addEventListener('load', () => {
    // Sačekaj 1.5 sekundi pre nego što počne fade-out animacija
    setTimeout(() => {
      const preloader = document.getElementById('preloader');
      preloader.classList.add('fade-out');
      // Kada se animacija završi, ukloni preloader iz prikaza
      preloader.addEventListener('transitionend', () => {
        preloader.style.display = 'none';
      });
    }, 2500);
});
