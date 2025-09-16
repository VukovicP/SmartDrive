
<?php
    include_once 'protectionConnection.php';
    session_start();

    if (isset($_POST['selectedPrice'])) {
        $currentPrice = $_POST['selectedPrice'];

        $_SESSION['totalPrice'] = $currentPrice;
    }

    // Postavljam vehicle_id za sesiju da bih je koristio u sledecem fajlu
    if (isset($_POST['vehicle_id'])) {
        $_SESSION['vehicle_id'] = $_POST['vehicle_id'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartDrive</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="protection.css">
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

                <?php 
                    $city = $_SESSION['pickup_city'];
                    $pickup = $_SESSION['pickup-date'];
                    $return = $_SESSION['return-date'];

                    if (isset($_POST['checkAvailability'])) {
                        $startDate = new DateTime($_POST['pickup-date']);
                        $endDate = new DateTime($_POST['return-date']);

                        $interval = $startDate->diff($endDate);
                        $daysDiff = $interval->days;
                    }
                ?>

                <div id="date" class="">
                    <p><strong><?php echo $city; ?></strong> | <?php echo $pickup . " - " . $return; ?></p>
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
                        <button type="button" class="btn me-2" id="openPopup">
                            Login | Register
                        </button>
                    <?php  } ?>
                </div>
              </header>
            </div>
        </div>

        <div class="container total">
            <h3 style="font-weight: bold;">WHICH PROTECTION PACKAGE DO YOU NEED?</h3>

            <form action="../Checkout/checkout.php" method="POST" id="total-price">
                <p>Total: <strong id="currentPriceDisplay"><?php echo number_format($currentPrice, 2, ",", "."); ?>€ / day</strong></p>

                <input type="hidden" name="currentPrice" id="currentPriceInput" value="<?php echo number_format($currentPrice, 2, ",", "."); ?>">

                <button class="confirm-btn" type="submit" name="conteneue-btn">Continiue</button>
            </form>
        </div>

        <hr>
    </section>

    


    <main class="container">

        <!-- Information -->
        <div id="info">
            
            <p> <img src="../svgs/infosvg.svg" class="svg" height="35" width="35" alt=""> Drivers must have held their driver's license for at least 2 year(s) for this vehicle</p>
        </div>

        <div id="packages" class="mt-5 mb-5">
            <div id="protection_first" class="package">
                <div class="package-title">
                    <h4>No extra protection</h4>
                    <input type="radio" checked class="package-checkbox" name="protection_package">
                </div>

                <div class="package-content">
                    <ul>
                        <li>Loss Damage Waiver</li>
                        <li>Tire and Windshield Protection</li>
                        <li>Personal Accident Protection</li>
                        <li>Roadside Protection</li>
                        <li>Interior Protection</li>
                    </ul>
                </div>

                <div class="package-price">
                    <h4>Included</h4>
                </div>
            </div>

            <?php
                $sql = "SELECT * FROM protection";
                $result = $mySqli->query($sql);
                if ($result -> num_rows > 0) {
                    while ($row = $result -> fetch_assoc()) {
                        $protectionId = $row['protection_id'];
                        $protectionName = $row['name'];
                        $protectionPrice = $row['price'];

                        ?>
                        <div id="package_<?php echo $protectionId; ?>" class="package">
                            <div class="package-title">
                                <h4><?php echo $protectionName; ?></h4>
                                <input type="radio" id="protection_<?php echo $protectionId ?>" class="package-checkbox" name="protection_package">
                            </div>

                            <div class="package-content">
                                <ul>
                                    <li id="li-1">Loss Damage Waiver</li>
                                    <li id="li-2">Tire and Windshield Protection</li>
                                    <li id="li-3">Personal Accident Protection</li>
                                    <li id="li-4">Roadside Protection</li>
                                    <li id="li-5">Interior Protection</li>
                                </ul>
                            </div>

                            <div class="package-price">
                                <h4><strong><?php echo $protectionPrice; ?></strong>€ / day</h4>
                            </div>
                        </div>
                        <?php
                    }
                }
            ?>
        </div>

        <!-- BOOKING OVERVIEW -->
        <div id="overview" class="mb-5">
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

    </main>


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

    <script src="protection.js"></script>
    <script>
        let basePrice = <?php echo $currentPrice; ?>;
    </script>
</body>
</html>