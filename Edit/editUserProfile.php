<?php

  include_once 'editConnection.php';
  session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartDrive | Edit Profile</title>


    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" href="editUserProfile.css">
</head>
<body>
    
    <!-- HEADER -->
    <section id="header">
        <div class="container-fluid black-background-cover">
            <div class="container logo-nav">
              <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4">
                <div class="col-md-3 mb-2 mb-md-0">
                    
                  <a href="../index.php" class="d-inline-flex  text-decoration-none" style="color: white;">
                    SmartDrive
                  </a>
                </div>

                <div class="col-md-3 text-end">
                  <?php
                      if (isset($_SESSION['user_name'])) { ?>
                        <div class="user-menu">
                        <span id="userDropdown"><?php echo $_SESSION['user_name']; ?></span>
                      </div>
                  <?php  } ?>
                </div>
              </header>
            </div>
        </div>

        <div class="container total">
          <h3 style="font-weight: bold;">VIEW YOUR PROFILE DETAILS</h3>
        </div>
        <hr>
    </section>

    <main id="main" class="container">
      <div class="row g-5">

        <div class="col-md-7 col-lg-8">
          <h4 class="mb-5">Your Rental History</h4>
          <div class="row g-3">

            <div class="col-12">
              <table>
                <tr>
                  <td><strong>Vehicle</strong></td>
                  <td><strong>City</strong></td>
                  <td><strong>Pickup Date</strong></td>
                  <td><strong>Return Date</strong></td>
                  <td><strong>Total Price Paid</strong></td>
                </tr> 
              </table>

              <hr class="my-4">

            </div>

            <?php
              $sql = "SELECT vehicles.name, reservation.pickup_return_location, reservation.pickup_date, reservation.return_date, reservation.price FROM `reservation` INNER JOIN vehicles ON reservation.vehicle_id = vehicles.vehicle_id WHERE customer_id LIKE '" . $_SESSION['customer_id'] . "'";

              $rez = $mySqli -> query($sql);

              while ($user = $rez -> fetch_assoc()) {
              ?>
                <div class="col-12">
                  <table>
                    <tr>
                      <td><?php echo $user['name'] ?></td>
                      <td><?php echo $user['pickup_return_location'] ?></td>
                      <td><?php echo $user['pickup_date'] ?></td>
                      <td><?php echo $user['return_date'] ?></td>
                      <td><?php echo $user['price'] . "€"; ?></td>
                    </tr> 
                  </table>

                  <hr class="my-4">
                </div>

            <?php } ?>

          </div>
        </div>

        <!-- Right Div -->
        <div class="col-md-5 col-lg-4 order-md-last" id="right">
          <?php
            $sql = "SELECT * FROM customer WHERE customer_id LIKE '" . $_SESSION['customer_id'] . "'";
            $rez = $mySqli -> query($sql);

            if ($user = $rez -> fetch_assoc()) {
              $username = $user['name'] . " " . $user['lastName'];
              $email = $user['email'];
              $driversLicence = $user['driversLicence'];
              $nationalID = $user['nationalID'];


              // Primer vrednosti username-a
              $fullName = $username; 
              // Razdvajanje imena i prezimena
              $nameParts = explode(" ", $fullName);
              // Generisanje inicijala
              $initials = strtoupper(substr($nameParts[0], 0, 1)) . strtoupper(substr($nameParts[1], 0, 1));
            }
          ?>

          <div id="inner-right">
            <div id="basic-info">
              <div class="userIcon"><p><?php echo $initials; ?></p></div>

              <div class="username">
                <h4><strong id=""><?php echo $username; ?> </strong></h4>
              </div>

            </div>

            <hr class="my-4">

            <div id="other-info">
              <div class="informations email">
                <p><strong>Email:</strong></p>
                <p><?php echo $email; ?></p>
              </div>

              <div class="informations driversLicence">
                <p><strong>Drivers Licence:</strong></p>
                <p><?php echo $driversLicence; ?></p>
              </div>

              <div class="informations nationalID">
                <p><strong>National ID:</strong></p>
                <p><?php echo $nationalID; ?></p>
              </div>
            </div>

            <hr class="my-4">

            <div id="session_off">
              <form action="../logout.php" method="POST">
                <button type="submit" class="btn btn-secondary">Logout</button>
              </form>
            </div>
          </div>
        </div>  
        
      </div>

    </main>


    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- JavaScript -->
    <script src="editUserProfile.js"></script>
</body>
</html>