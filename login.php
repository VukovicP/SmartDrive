<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require_once "./Register/connection.php";
    session_start();

    // Omogućava JSON output
    header("Content-Type: application/json");

    // Čitanje podataka iz zahteva
    $email_login = $_POST["email"];
    $password_login = $_POST["password"];

    // Priprema upita - tražimo korisnika samo po emailu
    $stmt = $mySqli->prepare("SELECT * FROM customer WHERE email = ?");
    $stmt->bind_param("s", $email_login);
    $stmt->execute();
    $result = $stmt->get_result();

    // Provera da li korisnik postoji
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if ($password_login === $user['password']) {

            // Postavljanje sesije
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['customer_id'] = $user['customer_id'];
            $_SESSION['role'] = $user['role'];

            // Redirekcija na osnovu role
            if ($user['role'] === 'admin') {
                echo json_encode(["success" => true, "redirect" => "./Admin/admin.php"]);
            } elseif ($user['role'] === 'moderator') {
                echo json_encode(["success" => true, "redirect" => "index.php"]);
            } else {
                echo json_encode(["success" => true, "redirect" => "index.php"]);
            }
            exit;
        } else {
            echo json_encode(["success" => false, "message" => "Incorrect password."]);
            exit;
        }
    } else {
        echo json_encode(["success" => false, "message" => "There's no such user, try register"]);
        exit;
    }
?>
