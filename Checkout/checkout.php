<?php

  include_once 'checkoutConnection.php';
  session_start();

  // $_SESSION['userIsLogged'];
  // $_SESSION['customer_id'];

  if (isset($_POST['currentPrice'])) {
      $currentPrice = floatval(str_replace(",", ".", $_POST['currentPrice'])); // Konvertuje u float
  }

  $startDate = new DateTime($_SESSION['pickup-date']);
  $endDate = new DateTime($_SESSION['return-date']);
  $interval = $startDate->diff($endDate);
  $daysDiff = $interval->days;

  $totalPrice = isset($currentPrice) ? $currentPrice * $daysDiff : 0;
  $_SESSION['totalPrice'] = $totalPrice;

  $sql = "SELECT * FROM vehicles WHERE vehicle_id LIKE '" . $_SESSION['vehicle_id'] . "'";
  $rez = $mySqli->query($sql);

  if ($row = $rez -> fetch_assoc()) {
    $vehicleName = $row['name'];
    $imgName = str_replace(" ", "", $vehicleName);
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartDrive</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="checkout.css">
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
                          <?php if ($_SESSION['role'] === 'moderator') { ?>
                            <div class="user-menu">
                                <span id="userDropdown"><?php echo $_SESSION['user_name']; ?></span>
                                <div class="dropdown-content">
                                    <a href="../Edit/editUserProfile.php">Your Profile</a>
                                    <a href="../moderator/moderator.php">Moderator</a>
                                    <a href="../logout.php">Logout</a>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="user-menu">
                                <span id="userDropdown"><?php echo $_SESSION['user_name']; ?></span>
                                <div class="dropdown-content">
                                    <a href="../Edit/editUserProfile.php">Your Profile</a>
                                    <a href="../logout.php">Logout</a>
                                </div>
                            </div>
                        <?php } ?>
                    <?php  } else { ?>
                      <button type="button" class="btn me-2" id="openPopup">Login | Register</button>
                    <?php  } ?>
                </div>
              </header>
            </div>
        </div>

        <div class="container total">
          <h3 style="font-weight: bold;">REVIEW YOUR BOOKING AND CHECKOUT</h3>
    
          <p>Total: <strong id="currentPriceDisplay"><?php echo number_format($totalPrice, 2, ",", "."); ?>€</strong></p>
          <input type="hidden" name="currentPrice" id="currentPriceInput" value="<?php echo number_format($totalPrice, 2, ",", "."); ?>">
                
        </div>
        <hr>
    </section>

    <!-- MAIN -->
    <section id="main" class="container">
      <div class="row g-5">
          <!-- Right Div -->
          <div class="col-md-5 col-lg-4 order-md-last" id="right">

            <div id="inner-right">
              <div id="vehicle-info">
                <div id="image" style="background-image: url(../Vehicles/images/<?php echo $imgName; ?>.png);"></div>
                <div id="content">
                    <h4><strong><?php echo $vehicleName; ?></strong></h4>
                    <p><?php echo $daysDiff . " rental days" ?></p>
                </div>
              </div>

              <hr class="my-4">

              <div id="pickup-return">
                <div class="date-location">
                  <p><strong>Pickup</strong></p>
                  <p><?php echo $_SESSION['pickup_city']; ?></p>
                  <p><?php echo $_SESSION['pickup-date'] . " | until 22:30 PM " ?></p>
                </div>
                <div class="date-location">
                  <p><strong>Return</strong></p>
                  <p><?php echo $_SESSION['pickup_city']; ?></p>
                  <p><?php echo $_SESSION['return-date'] . " | until 10:30 AM "; ?></p>
                </div>
              </div>

              <hr class="my-4">

              <div id="overview">
                  <div class="overview-title">
                      <h5>Your Booking Overview</h5>
                  </div>

                  <div class="items">
                      <ul>
                          <li>Third party insurance</li>
                          <li>Premium Location Fee</li>
                          <li>Booking option: Stay flexible - Pay by card, free date modification and rebooking any time before pick-up time</li>
                      </ul>
                  </div>
              </div>
            </div>
            

          </div>

          <!-- Left Div -->
          <div class="col-md-7 col-lg-8">
            <h4 class="mb-3">Who's driving?</h4>
            <form class="needs-validation" method="POST" action="../Success/success.php">
              <div class="row g-3">
                <?php
                
                if ($_SESSION['customer_id']) {
                  $sql = "SELECT * FROM customer WHERE customer_id LIKE '" . $_SESSION['customer_id'] . "'";
                  $rez = $mySqli->query($sql);

                  if ($user = $rez -> fetch_assoc()) {
                ?>
                    <div class="col-sm-6">
                      <label for="firstName" class="form-label">First name</label>
                      <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $user['name'] ?>" required>
                    </div>
        
                    <div class="col-sm-6">
                      <label for="lastName" class="form-label">Last name</label>
                      <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $user['lastName'] ?>" required>
                    </div>
                    
                    <div class="col-12">
                      <label for="email" class="form-label">Email</label>
                      <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email'] ?>">
                    </div>

                    <div class="col-12">
                      <label for="driversLicence" class="form-label">Drivers Licence Number</label>
                      <input type="text" class="form-control" id="driversLicence" name="driversLicence" value="<?php echo $user['driversLicence'] ?>">
                    </div>

                    <div class="col-12">
                      <label for="nationalID" class="form-label">National ID</label>
                      <input type="text" class="form-control" id="nationalID" name="nationalID" value="<?php echo $user['nationalID'] ?>">
                    </div>
                <?php
                    }
                  }
                  else {
                ?>

                  <div class="col-sm-6">
                    <label for="firstName" class="form-label">First name</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" value="" required>
                  </div>
      
                  <div class="col-sm-6">
                    <label for="lastName" class="form-label">Last name</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" value="" required>
                    <div class="invalid-feedback">
                      Valid last name is required.
                    </div>
                  </div>
      
                  <div class="col-12">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com">
                  </div>

                  <div class="col-12">
                    <label for="email" class="form-label">Drivers Licence Number</label>
                    <input type="email" class="form-control" id="driversLicence" name="driversLicence">
                  </div>

                  <div class="col-12">
                    <label for="email" class="form-label">National ID</label>
                    <input type="email" class="form-control" id="nationalID" name="nationalID" minlength="13">
                  </div>

                <?php
                  }
                ?>
    
                <div class="col-12">
                  <label for="address" class="form-label">Address</label>
                  <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" required>
                </div>
    
                <div class="col-12">
                  <label for="address2" class="form-label">Address for Delivery <span class="text-body-secondary">(Optional)</span></label>
                  <input type="text" class="form-control" id="deliveryAddres" name="deliveryAddress" placeholder="Enter a precise location">
                </div>
    
                <div class="col-12">
                  <label for="address2" class="form-label">Phone number (with country code)</label>
                  <input type="text" class="form-control" id="address2" name="phoneNumber" placeholder="+381 64 1234 567">
                </div>
              </div>
    
              <hr class="my-4">
    
              <div class="form-check">
                <input type="checkbox" checked class="form-check-input" id="same-address">
                <label class="form-check-label" for="same-address">I'm 24 years of age or older</label>
              </div>
    
              <div id="info" class="col-12">
                  <p> <img src="../svgs/infosvg.svg" class="svg" height="30" width="30" alt=""> Drivers must have held their driver's license for at least 2 year(s) for this vehicle</p>
              </div>
    
              <hr class="my-4">
    
              <h4 class="mb-3">Payment</h4>
    
              <div class="my-3">
                <div class="form-check">
                  <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked="" required="">
                  <label class="form-check-label" for="credit">Credit card</label>
                </div>
                <div class="form-check">
                  <input id="debit" name="paymentMethod" type="radio" class="form-check-input" required="">
                  <label class="form-check-label" for="debit">Debit card</label>
                </div>
                <div class="form-check">
                  <input id="paypal" name="paymentMethod" type="radio" class="form-check-input" required="">
                  <label class="form-check-label" for="paypal">PayPal</label>
                </div>
              </div>
    
              <div class="row gy-3">
                <div class="col-md-6">
                  <label for="cc-name" class="form-label">Name on card</label>
                  <input type="text" class="form-control" id="cc-name" name="cc-name" placeholder="" required="">
                  <small class="text-body-secondary">Full name as displayed on card</small>
                  <!-- <div class="invalid-feedback">
                    Name on card is required
                  </div> -->
                </div>
    
                <div class="col-md-6">
                  <label for="cc-number" class="form-label">Credit card number</label>
                  <input type="text" class="form-control" id="cc-number" name="cc-number" placeholder="" required="">
                  <!-- <div class="invalid-feedback">
                    Credit card number is required
                  </div> -->
                </div>
    
                <div class="col-md-3">
                  <label for="cc-expiration" class="form-label">Expiration</label>
                  <input type="text" class="form-control" id="cc-expiration" name="cc-expiration" placeholder="" required="">
                  <!-- <div class="invalid-feedback">
                    Expiration date required
                  </div> -->
                </div>
    
                <div class="col-md-3">
                  <label for="cc-cvv" class="form-label">CVV</label>
                  <input type="text" class="form-control" id="cc-cvv" name="cc-cvv" placeholder="" required="">
                  <!-- <div class="invalid-feedback">
                    Security code required
                  </div> -->
                </div>
              </div>
    
              <hr class="my-4">

              <div>
                  <div id="to-pay">
                    <h4>Total amount to pay:</h4>
                    <h4><strong><?php echo number_format($totalPrice, 2, ",", "."); ?>€</strong></h4>
                  </div>
                  <p>By clicking button bellow I agree that I have read and accept the rental information, the terms and conditions, and the privacy policy.</p>
              </div>

              <hr class="my-4">
    
              <button class="w-100 btn btn-primary btn-lg" type="submit">Checkout</button>
            </form>
          </div>

        </div>

    </section>

    <!-- FOOTER -->
    <section id="footer" class="black-background-cover container-fluid">
        <div class="container">
            <footer class="py-3 mt-4">
                <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li class="nav-item"><a href="#" class="nav-link px-2">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2">Features</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2">Pricing</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2">FAQs</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2">About</a></li>
                </ul>
                <p class="text-center" id="copyr" style="color: white;">© 2024 Company, Inc</p>
            </footer>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="checkout.js"></script>
</body>
</html>