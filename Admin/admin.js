// Customer List
document.addEventListener("DOMContentLoaded", function() {
  const updateBtn = document.getElementById("updateBtn");
  const deleteBtn = document.getElementById("deleteBtn");
  const updateFormContainer = document.getElementById("updateFormContainer");
  const deleteFormContainer = document.getElementById("deleteFormContainer");

  updateBtn.addEventListener("click", function() {
    // Sakrij delete form ako je otvoren
    if (deleteFormContainer.style.display === "block") {
      deleteFormContainer.style.display = "none";
    }
    // Toggle update form
    updateFormContainer.style.display = updateFormContainer.style.display === "block" ? "none" : "block";
  });

  deleteBtn.addEventListener("click", function() {
    // Sakrij update form ako je otvoren
    if (updateFormContainer.style.display === "block") {
      updateFormContainer.style.display = "none";
    }
    // Toggle delete form
    deleteFormContainer.style.display = deleteFormContainer.style.display === "block" ? "none" : "block";
  });
});


// Vehicle List
document.addEventListener("DOMContentLoaded", function() {
    const updateBtn = document.getElementById("updateBtnVehicle");
    const insertBtn = document.getElementById("insertBtnVehicle");
    const deleteBtn = document.getElementById("deleteBtnVehicle");
    const updateFormContainer = document.getElementById("updateFormContainerVehicle");
    const insertFormContainer = document.getElementById("insertFormContainerVehicle");
    const deleteFormContainer = document.getElementById("deleteFormContainerVehicle");
  
    updateBtn.addEventListener("click", function() {
      // Sakrij delete form ako je otvoren
      if (deleteFormContainer.style.display === "block") {
        deleteFormContainer.style.display = "none";
      }
      // Toggle update form
      updateFormContainer.style.display = updateFormContainer.style.display === "block" ? "none" : "block";
    });

    insertBtn.addEventListener("click", function () {
        if (insertFormContainer.style.display === "block") {
            insertFormContainer.style.display === "none";
        }
        insertFormContainer.style.display = insertFormContainer.style.display === "block" ? "none" : "block";
    });
  
    deleteBtn.addEventListener("click", function() {
      // Sakrij update form ako je otvoren
      if (updateFormContainer.style.display === "block") {
        updateFormContainer.style.display = "none";
      }
      // Toggle delete form
      deleteFormContainer.style.display = deleteFormContainer.style.display === "block" ? "none" : "block";
    });
});


document.addEventListener("DOMContentLoaded", function() {
  const updateBtn = document.getElementById("updateBtnReservation");
  const deleteBtn = document.getElementById("deleteBtnReservation");
  const updateFormContainer = document.getElementById("updateFormContainerReservation");
  const deleteFormContainer = document.getElementById("deleteFormContainerReservation");

  updateBtn.addEventListener("click", function() {
    // Sakrij delete form ako je otvoren
    if (deleteFormContainer.style.display === "block") {
      deleteFormContainer.style.display = "none";
    }
    // Toggle update form
    updateFormContainer.style.display = updateFormContainer.style.display === "block" ? "none" : "block";
  });

  deleteBtn.addEventListener("click", function() {
    // Sakrij update form ako je otvoren
    if (updateFormContainer.style.display === "block") {
      updateFormContainer.style.display = "none";
    }
    // Toggle delete form
    deleteFormContainer.style.display = deleteFormContainer.style.display === "block" ? "none" : "block";
  });
});

