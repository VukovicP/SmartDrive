<?php
    include_once 'adminConnection.php';
    session_start();

    $vehicle_id = $_POST['vehicle_id'];
    $vehicle_name = $_POST['vehicle_name'];
    $year = $_POST['year'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    $seats = $_POST['seats'];
    $transmission = $_POST['transmission'];
    $doors = $_POST['doors'];
    $suitcase = $_POST['suitcase'];
    $bag = $_POST['bag'];
    $price = $_POST['price'];
    $unlimited_price = $_POST['unlimitedPrice'];

    // Insert
    $sql = "INSERT INTO `vehicles`(`name`, `year`, `type`, `description`, `seats`, `transmission`, `doors`, `suitcase`, `bag`, `price`, `unlimited_km`) 
    VALUES ('" . $vehicle_name . "','" . $year . "','" . $type . "','" . $description . "','" . $seats . "','" . $transmission . "','" . $doors . "','" . $suitcase . "','" . $bag . "','" . $price . "','" . $unlimited_price . "')";
    
    $rez = $mySqli->query($sql);
    if ($rez) {
        if ($_FILES['vehicle_image']['type'] == "image/png") {
            $source = $_FILES['vehicle_image']['tmp_name'];
            $imgName = str_replace(" ", "", $_FILES['vehicle_image']['name']);
            $target = "D:/Xampp/htdocs/Projekat-SmartDrive/Vehicles/images/" . $imgName;

            move_uploaded_file($source, $target);
            header("Location: admin.php");
        }
        else {
            die ("Nesto ne valja sa slikom");
        }
    }
    else {
        die("Nesto ne valja sa upitom");
    }

?>
