<?php

    include_once 'adminConnection.php';
    session_start();

    $customer_id = $_POST['customer_id'];
    $drivers_licence = $_POST['driversLicence'];
    $national_ID = $_POST['nationalID'];
    $role = $_POST['role'];

    if ($drivers_licence == null  && $role == null) {
        $sql = "UPDATE customer SET nationalID = '" . $national_ID . "' WHERE customer_id = '" . $customer_id . "'";
        $rez = $mySqli -> query($sql);
        if ($rez) {
            header("Location: admin.php");
        }
    }
    else if ($national_ID == null && $role == null) {
        $sql = "UPDATE customer SET driversLicence = '" . $drivers_licence . "' WHERE customer_id = '" . $customer_id . "'";
        $rez = $mySqli -> query($sql);
        if ($rez) {
            header("Location: admin.php");
        }
    }
    else if ($national_ID == null && $drivers_licence == null) {
        $sql = "UPDATE customer SET role = '" . $role . "' WHERE customer_id = '" . $customer_id . "'";
        $rez = $mySqli -> query($sql);
        if ($rez) {
            header("Location: admin.php");
        }
    }
    else {
        exit;
    }


    // OBRADA VEHICLE PODATAKA
    $vehicle_id = $_POST['vehicle_id'];
    $price = $_POST['day_price'];
    $unlimited_price = $_POST['unlimited_price'];

    // Update
    if ($price == null) {
        $sql = "UPDATE vehicles SET unlimited_km = '" . $unlimited_price . "' WHERE vehicle_id = '" . $vehicle_id . "'";
        $rez = $mySqli -> query($sql);
        if ($rez) {
            header("Location: admin.php");
        }
    }
    else if ($unlimited_price == null) {
        $sql = "UPDATE vehicles SET price = '" . $price . "' WHERE vehicle_id = '" . $vehicle_id . "'";
        $rez = $mySqli -> query($sql);
        if ($rez) {
            header("Location: admin.php");
        }
    }
    else {
        exit;
    }
    

    // OBRADA RESERVATION PODATAKA
    $reservation_id = $_POST['reservation_id'];
    $location = $_POST['location'];

    // Update
    if ($reservation_id != null) {
        $sql = "UPDATE reservation SET pickup_return_location = '" . $location . "' WHERE reservation_id = '" . $reservation_id . "'";
        $rez = $mySqli -> query($sql);
        if ($rez) {
            header("Location: admin.php");
        }
    }
    else {
        exit;
    }

?>