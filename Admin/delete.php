<?php
    include_once 'adminConnection.php';
    session_start();

    // OBRADA CUSTOMER PODATAKA
    $customer_id = $_POST['customer_id'];
    $drivers_licence = $_POST['driversLicence'];
    $national_ID = $_POST['nationalID'];

    // Delete Customer
    if ($customer_id != null) {
        $sql = "DELETE FROM customer WHERE customer_id = '" . $customer_id . "'";
        $rez = $mySqli -> query($sql);
        if ($rez) {
            header("Location: admin.php");
            exit;
        }
    }


    // OBRADA VEHICLE PODATAKA
    $vehicle_id = $_POST['vehicle_id'];

    // Delete Vehicle
    if ($vehicle_id != null) {
        $sql = "DELETE FROM vehicles WHERE vehicle_id = '" . $vehicle_id . "'";
        $rez = $mySqli -> query($sql);
        if ($rez) {
            header("Location: admin.php");
            exit;
        }
    }


    // OBRADA RESERVATION PODATAKA
    $reservation_id = $_POST['reservation_id'];

    // Delete Vehicle
    if ($reservation_id != null) {
        $sql = "DELETE FROM reservation WHERE reservation_id = '" . $reservation_id . "'";
        $rez = $mySqli -> query($sql);
        if ($rez) {
            header("Location: admin.php");
            exit;
        }
    }
    
?>