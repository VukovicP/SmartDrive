<?php 
    $user = "root";
    $password = "";
    $db = "db_smartDrive1";

    $mySqli = new mysqli("127.0.0.1", $user, $password, $db);

    if ($mySqli -> connect_errno) {
        die("Greska prilikom konektovanja: " . $mySqli->connect_error);
    }
?>