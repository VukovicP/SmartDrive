<?php
    session_start();

    $_SESSION['pickup_city'] = $_POST['pickup-city'];
    $_SESSION['pickup-date'] = $_POST['pickup-date'];
    $_SESSION['return-date'] = $_POST['return-date'];


    header("Location: ./Vehicles/vehicles.php");
?>
