<?php

  include_once 'moderatorConnection.php';
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
    <link rel="stylesheet" href="moderator.css">
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
                      <span id="userDropdown"><?php echo $_SESSION['user_name'] . " | Moderator"; ?></span>
                    </div>
                  <?php  } ?>
                </div>
              </header>
            </div>
        </div>

        <div class="container total">
          <h3 style="font-weight: bold;">VIEW AGENCY DATA</h3>
        </div>
        <hr>
    </section>

    <main id="main" class="container">
      <div class="row g-5">

        <div class="col-md-8 col-lg-9">
          <h4 class="mb-5">Database Tables</h4>
          <div class="row g-3">

            <div id="customer-list" class="col-12 mb-5">
              <h5 class="mb-4"><strong>Customer / User List:</strong></h5>
              <div class="inner p-3">
                  <div class="table-responsive">
                      <table class="custom-table">
                          <tr class="custom-table">
                              <td><strong>Customer ID</strong></td>
                              <td><strong>Name</strong></td>
                              <td><strong>Last Name</strong></td>
                              <td><strong>Email</strong></td>
                              <td><strong>Drivers Licence</strong></td>
                              <td><strong>National ID</strong></td>
                              <td><strong>Role</strong></td>
                          </tr>
                      </table>
                  </div>

                  <hr class="my-4">

                  <?php
                    $sql = "SELECT * FROM customer";
                    $rez = $mySqli -> query($sql);

                    while ($customer = $rez -> fetch_assoc()) {
                  ?>
                    <div class="table-responsive">
                        <table class="custom-table">
                            <tr>
                                <td><?php echo $customer['customer_id']; ?></td>
                                <td><?php echo $customer['name']; ?></td>
                                <td><?php echo $customer['lastName']; ?></td>
                                <td><?php echo $customer['email']; ?></td>
                                <td><?php echo $customer['driversLicence']; ?></td>
                                <td><?php echo $customer['nationalID']; ?></td>
                                <td><?php echo $customer['role']; ?></td>
                            </tr>
                        </table>
                    </div>
                    <hr class="my-4">
                  <?php } ?>

                </div>  
              
            </div>

            <div id="vehicles-list" class="col-12 mb-5">
                <h5 class="mb-4"><strong>Vehicle List:</strong></h5>
                <div class="inner p-3">
                    <table class="custom-table">
                      <tr>
                        <td><strong>Vehicle ID</strong></td>
                        <td><strong>Name</strong></td>
                        <td><strong>Year</strong></td>
                        <td><strong>Type</strong></td>
                        <td><strong>Transmission</strong></td>
                        <td><strong>Price</strong></td>
                        <td><strong>Unlimited Km Price</strong></td>
                      </tr> 
                    </table>

                    <hr class="my-4">

                    <?php
                        $sql = "SELECT * FROM vehicles";
                        $rez = $mySqli -> query($sql);
                        while ($vehicle = $rez -> fetch_assoc()) {
                      ?>
                        <table class="custom-table">
                            <tr>
                            <td><?php echo $vehicle['vehicle_id']; ?></td>
                            <td><?php echo $vehicle['name']; ?></td>
                            <td><?php echo $vehicle['year']; ?></td>
                            <td><?php echo $vehicle['type']; ?></td>
                            <td><?php echo $vehicle['transmission']; ?></td>
                            <td><?php echo $vehicle['price'] . "€"; ?></td>
                            <td><?php echo $vehicle['unlimited_km'] . "€"; ?></td>
                            </tr> 
                        </table>
                        <hr class="my-4">
                    <?php } ?>
                </div>  
            </div>


            <div id="reservations-list" class="col-12 mb-5">
              <h5 class="mb-4"><strong>Reservations List:</strong></h5>
              <div class="inner p-3">
                <table class="custom-table">
                  <tr>
                    <td><strong>Reservation ID</strong></td>
                    <td><strong>Customer ID</strong></td>
                    <td><strong>Vehicle ID</strong></td>
                    <td><strong>Rent Location</strong></td>
                    <td><strong>Pickup Date</strong></td>
                    <td><strong>Return Date</strong></td>
                    <td><strong>Total Price</strong></td>
                  </tr> 
                </table>

                <hr class="my-4">

                            
                <?php
                    $sql = "SELECT * FROM reservation";
                    $rez = $mySqli -> query($sql);
                    while ($reservation = $rez -> fetch_assoc()) {
                    ?>
                      <table class="custom-table">
                          <tr>
                          <td><?php echo $reservation['reservation_id']; ?></td>
                          <td><?php echo $reservation['customer_id']; ?></td>
                          <td><?php echo $reservation['vehicle_id']; ?></td>
                          <td><?php echo $reservation['pickup_return_location']; ?></td>
                          <td><?php echo $reservation['pickup_date']; ?></td>
                          <td><?php echo $reservation['return_date']; ?></td>
                          <td><?php echo $reservation['price'] . "€"; ?></td>
                          </tr> 
                      </table>
                      <hr class="my-4">
                <?php } ?>
              </div>    
            </div>

          </div>
        </div>

        <!-- Right Div -->
        <div class="col-md-4 col-lg-3 order-md-last" id="right">
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
    <script src="moderator.js"></script>
</body>
</html>