// REGISTER PROVERA
document.addEventListener("DOMContentLoaded", function() {
    let form = document.getElementById("forma-register");

    if (!form) {
        console.error("Forma #forma-register nije pronadjena!");
        return;
    }

    form.addEventListener("submit", function (event) {
        event.preventDefault();
    
        let frmData = new FormData(this);
    
        fetch("register.php", {
            method: "POST",
            body: frmData
        })
        .then(response => {
            
            return response.json();
        })
        .then(data => {
            console.log("JSON ODgovor: ", data);

            console.log("Odgovor servera: ", data);
            
            if (data.success) {
                window.location.href = data.redirect;
                alert("Uspesna registracija!");
            }
            else {
                let header = document.getElementById("register-header");
                if (header) {
                    header.innerText = data.message;
                    header.style.color = "red";
                    header.style.alignContent = "center";
                }
                else {
                    console.error("Element #register-header nije pronadjen.")
                }
            }
        })
        .catch(error => console.error("Greska prilikom fetch poziva:", error));
    });
});
