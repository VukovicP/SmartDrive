<?php
    session_start();
    require_once "connection.php";

    header("Content-Type: application/json");

    $_SESSION["firstName"] = $_POST["firstName"];
    $_SESSION["lastName"] = $_POST["lastName"];
    $_SESSION["email"] = $_POST["email"];
    $_SESSION["password"] = $_POST["password"];
    $_SESSION["driversLicence"] = $_POST["driversLicence"];
    $_SESSION["idNumber"] = $_POST["idNumber"];

    $firstName = $_SESSION["firstName"];
    $lastName = $_SESSION["lastName"];
    $email = $_SESSION["email"];
    $password = $_SESSION["password"];
    $passwordRepeat = $_POST["repeatPassword"];
    $driversLicence = $_SESSION["driversLicence"];
    $idNumber = $_SESSION["idNumber"];

    if (!isset($firstName, $lastName, $email, $password, $passwordRepeat, $driversLicence, $idNumber)) {
        echo json_encode(["success" => false, "message" => "All fields are required"]);
        exit();
    }    
    
    $queryCheck = "SELECT * FROM customer WHERE email LIKE '" . $email . "' OR driversLicence LIKE '" . $driversLicence . "' OR nationalID LIKE '" . $idNumber . "'";
    $result = $mySqli->query($queryCheck);

    if ($result->num_rows>0) {
        echo json_encode(["success" => false, "message" => "There is already user with this Data"]);
        exit;
    }
    else {
        if ($password === $passwordRepeat) {
            $upit = "INSERT INTO `customer`(`name`, `lastName`, `email`, `password`, `driversLicence`, `nationalID`) VALUES ('$firstName','$lastName','$email','$password','$driversLicence','$idNumber')";
            if ($rez = $mySqli->query($upit)) 
            {
                // header("Location: ../index.html");
                echo json_encode(["success" => true, "redirect" => "../index.php"]);
            }
            else 
            {
                echo json_encode(["success" => false, "message" => "Registration failed, please try again"]);
            }
        }
        else {
            echo json_encode(["s" => false, "message" => "Passwords do not match! Repeat the password."]);
            exit();
        }
    }

?>