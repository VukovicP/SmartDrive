<?php
    include_once 'successConnection.php';
    session_start();
    
    // echo "Sesija: " . $_SESSION['user_name'];
    // echo "Sesija: " . $_SESSION['customer_id'];
    // echo "Sesija: " . $_SESSION['vehicle_id'];
    // echo "Sesija: " . $_SESSION['pickup_city'];
    // echo "Sesija: " . $_SESSION['pickup-date'];
    // echo "Sesija: " . $_SESSION['return-date'];
    // echo "Sesija: " . $_SESSION['totalPrice'];

    $sql = "INSERT INTO `reservation`(`customer_id`, `vehicle_id`, `pickup_return_location`, `pickup_date`, `return_date`, `price`) 
    VALUES ('" . $_SESSION['customer_id'] . "','" . $_SESSION['vehicle_id'] . "','" . $_SESSION['pickup_city'] . "','" . $_SESSION['pickup-date'] . "','" . $_SESSION['return-date'] . "', '" . $_SESSION['totalPrice'] . "')";

    $rez = $mySqli->query($sql);
    if ($rez) {
    
?>


        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>SmartDrive</title>

            <!-- Bootstrap -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
            <!-- CSS -->
            <link rel="stylesheet" href="success.css">

        </head>
        <body>

            <!-- PRELOADER -->
            <div id="preloader">
                <div class="spinner"></div>
            </div>

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
                                    <div class="dropdown-content">
                                        <a href="../Edit/editUserProfile.php">Your Profile</a>
                                        <a href="../logout.php">Logout</a>
                                    </div>
                                </div>

                                <?php  } else { ?>
                                <button type="button" class="btn me-2" id="openPopup">Login | Register</button>
                            <?php  } ?>
                        </div>
                    </header>
                    </div>
                </div>
            

            <!-- MAIN -->
            <div class="container py-5">
                <div class="row align-items-center g-md-5 py-5">
                    <div class="col-lg-7 text-center text-lg-start">
                        <h1 class="display-4 fw-bold lh-1 text-body-emphasis mb-3">Your reservation has been created</h1>
                        <p id="typewriter" class="col-lg-10 fs-4"></p>
                    </div>
                    <div class="col-md-10 mx-auto col-lg-5">
                        <form class="p-4 p-md-5 border rounded-3 bg-body-tertiary" method="POST" action="../logout.php">
                        <div class="form-floating mb-3">
                            <h3>Register on our Newsletter</h3>
                            <p>And don't miss promotions and new vehicles</p>
                        </div>  

                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Email address | Will be able in version 2.0</label>
                        </div>

                        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign up</button>
                        <hr class="my-4">
                        <p class="text-body-secondary">Or go back to our homepage and check on our fleet for the next time</p>
                        <button class="w-100 btn btn-lg btn-primary" type="submit">Go Back to Homepage</button>
                        </form>
                    </div>
                </div>
            </div>


            <!-- Bootstrap -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
            <!-- JavaScript -->
            <script src="success.js"></script>

        </body>
        </html>

<?php } 
    else {
        die("Could not execute query to database!");
    }
?>
