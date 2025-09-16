<?php 

    include_once 'vehiclesConnection.php';
    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicles</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="vehicles.css">
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
                    if (isset($_POST['checkAvailability'])) {
                        $startDate = new DateTime($_SESSION['pickup-date']);
                        $endDate = new DateTime($_SESSION['return-date']);

                        $interval = $startDate->diff($endDate);
                        $daysDiff = $interval->days;
                    }
                ?>

                <div id="date" class="">
                    <p><strong><?php echo $_SESSION['pickup_city']; ?></strong> | <?php echo $_SESSION['pickup-date'] . " - " . $_SESSION['return-date']; ?></p>
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

        <div class="container">
            <h3 style="font-weight: bold;">WHICH CAR DO YOU WANT TO DRIVE?</h3>
        </div>

        <hr />
        <!-- FILTERS -->
        <form class="container filter-section" method="post" action="vehicles.php">
            <select name="Price" id="sortBy" class="filters">
              <option value="all" selected>Price</option>
              <option value="ltoh">Price Low to Hight</option>
              <option value="htol">Price High to Low</option>
            </select>
          
            <select name="Type" id="sortBy" class="filters">
              <option value="all" selected>Type</option>
              <option value="sedan">Sedan</option>
              <option value="hatchback">Hatchback</option>
              <option value="suv">SUV</option>
              <option value="coupe">Coupe</option>
              <option value="convertable">Convertable</option>
              <option value="luxury vehicle">Luxury Vehicle</option>
            </select>
          
            <select name="Transmission" id="sortBy" class="filters">
              <option value="all" selected>Transmission</option>  
              <option value="Automatic">Automatic</option>
              <option value="Manual">Manual</option>
            </select>

            <button name="submitFilters" type="submit" class="btn btn-outline-secondary" style="color: black;">Confirm Filters</button>
        </form>

    </section>


    <!-- VEHICLES -->
    <section id="vehicles">

        <div class="container col vehicles-container">

            <?php 
                if (isset($_POST["submitFilters"])) {
                    if ($_POST["Price"] == "all" && $_POST["Type"] == "all" && $_POST["Transmission"] == "all") {
                        $sql = "
                            SELECT v.*
                            FROM vehicles v
                            WHERE v.vehicle_id NOT IN (
                                SELECT r.vehicle_id
                                FROM reservation r
                                WHERE NOT (
                                    r.return_date < '" . $_SESSION['pickup-date'] . "'
                                    OR r.pickup_date > '" . $_SESSION['return-date'] . "'
                                )
                            )
                        ";
                        if ($rezultat = $mySqli->query($sql)) {

                            while ($row = $rezultat->fetch_assoc()) {
                                $imgName = str_replace(" ", "", $row['name']);
                        ?>
                                <div class="vehicleCard" style="background-image: url(images/<?php echo $imgName?>.png);">
                                    <div class="vehicleInfo">
                                        <h3><?php echo $row["name"]?></h3>
                                        <p><?php echo $row["description"] ?></p>
                                    </div>
                                    
                                    <div class="vehiclePrice">
                                        <p><strong><?php echo $row["price"] . "€ / day" ?></strong></p>
                                    </div>
                                </div>
                        <?php
                            }
                        }
                    }
                    else {

                        $selectPrice = $_POST["Price"];
                        $selectType = $_POST["Type"];
                        $selectTransmission = $_POST["Transmission"];

                        if ($selectPrice == "htol") {
                            $sql = "
                                SELECT v.*
                                FROM vehicles v
                                WHERE v.vehicle_id NOT IN (
                                    SELECT r.vehicle_id
                                    FROM reservation r
                                    WHERE NOT (
                                        r.return_date < '" . $_SESSION['pickup-date'] . "'
                                        OR r.pickup_date > '" . $_SESSION['return-date'] . "'
                                    )
                                ) ORDER BY price DESC
                            ";
                        }
                        else if ($selectPrice == "ltoh") {
                            $sql = "
                                SELECT v.*
                                FROM vehicles v
                                WHERE v.vehicle_id NOT IN (
                                    SELECT r.vehicle_id
                                    FROM reservation r
                                    WHERE NOT (
                                        r.return_date < '" . $_SESSION['pickup-date'] . "'
                                        OR r.pickup_date > '" . $_SESSION['return-date'] . "'
                                    )
                                ) ORDER BY price ASC
                            ";
                        }
                        else if ($selectType != "all") {
                            $sql = "
                                SELECT v.*
                                FROM vehicles v
                                WHERE v.vehicle_id NOT IN (
                                    SELECT r.vehicle_id
                                    FROM reservation r
                                    WHERE NOT (
                                        r.return_date < '" . $_SESSION['pickup-date'] . "'
                                        OR r.pickup_date > '" . $_SESSION['return-date'] . "'
                                    )
                                ) AND type LIKE '" . $selectType . "'
                            ";
                        }
                        else if ($selectTransmission != "all") {
                            $sql = "
                                SELECT v.*
                                FROM vehicles v
                                WHERE v.vehicle_id NOT IN (
                                    SELECT r.vehicle_id
                                    FROM reservation r
                                    WHERE NOT (
                                        r.return_date < '" . $_SESSION['pickup-date'] . "'
                                        OR r.pickup_date > '" . $_SESSION['return-date'] . "'
                                    )
                                ) AND transmission LIKE '" . $selectTransmission . "'
                            ";
                        }
                        else {
                            $sql = "
                                SELECT v.*
                                FROM vehicles v
                                WHERE v.vehicle_id NOT IN (
                                    SELECT r.vehicle_id
                                    FROM reservation r
                                    WHERE NOT (
                                        r.return_date < '" . $_SESSION['pickup-date'] . "'
                                        OR r.pickup_date > '" . $_SESSION['return-date'] . "'
                                    )
                                )
                            ";
                        }

                        
                        if ($rezultat = $mySqli->query($sql)) {

                            while ($row = $rezultat->fetch_assoc()) {
                                $imgName = str_replace(" ", "", $row['name']);
                                $vehicleId = $row['vehicle_id'];                       
                            ?>
                                <div class="vehicleCard" onclick="openVehicleDetails(<?php echo $vehicleId; ?>)" style="background-image: url(images/<?php echo $imgName?>.png);">

                                    <div class="vehicleInfo">
                                        <h3><?php echo $row["name"]?></h3>
                                        <p><?php echo $row["description"] ?></p>
                                    </div>
                                    
                                    <div class="vehiclePrice">
                                        <p><strong><?php echo $row["price"] . "€ / day" ?></strong></p>
                                    </div>
                                </div>

                                <!-- EXTENDED INFO -->
                                <div id="vehicleDetails_<?php echo $vehicleId;?>" class="vehicle-details">
                                    <div class="details-content">
                                        
                                        <!-- Details Left -->
                                        <div class="details-left">
                                            <img
                                                src="images/<?php echo $imgName?>.png"
                                                alt="<?php echo $imgName ?> image"
                                                class="details-image"
                                            />
                                            <div class="details-overlay">
                                                <h2><?php echo $row["name"]?></h2>
                                                <p><?php echo $row["description"]?></p>
                                                <p><?php echo $row["year"]?></p>
                                            </div>
                                            <div class="vehicle-specs">
                                                <p><?php echo $row["seats"]?> Seats</p>
                                                <p><?php echo $row["suitcase"]?> Suitcase(s)</p>
                                                <p><?php echo $row["bag"]?> Bag(s)</p>
                                                <p><?php echo $row["transmission"]?></p>
                                                <p><?php echo $row["doors"]?> Doors</p>
                                            </div>
                                        </div>

                                        <!-- Details Right  -->
                                        <div class="details-right">
                                            <h3>Booking option</h3>
                                            <div class="bookingOption">
                                                <p>
                                                    Stay flexible <strong>Included</strong>
                                                </p>
                                            </div>
                                            <div class="milege">
                                                <h3>Mileage</h3>
                                                <div class="checkMilage first">
                                                    <input type="radio" id="400km_<?php echo $vehicleId; ?>" name="mileage_<?php echo $vehicleId;?>" value="400km" checked  onchange="updatePrice(<?php echo $vehicleId; ?>, <?php echo $row['price']; ?>, <?php echo $row['unlimited_km']; ?>)"/>

                                                    <label htmlFor="400km_<?php echo $vehicleId; ?>">400 km + $0.31 / km</label>
                                                </div>

                                                <div class="checkMilage second">
                                                    <input type="radio" id="unlimited_<?php echo $vehicleId; ?>" name="mileage_<?php echo $vehicleId?>" value="unlimited" onchange="updatePrice(<?php echo $vehicleId; ?>, <?php echo $row['price']; ?>, <?php echo $row['unlimited_km']; ?>)" />

                                                    <label htmlFor="unlimited">Unlimited kilometers + <?php echo $row['unlimited_km'] ?>€ / day</label>
                                                </div>
                                            </div>

                                            <div>
                                                <!-- OVO TREBA DOVRSITI -->
                                                <!-- Obratiti paznju na action -->
                                                <form action="../ProtectionPackage/protection.php" method="post" class="next-section">
                                                    <p><strong id="price_<?php echo $vehicleId; ?>">
                                                            <?php echo $row['price'] ?> / day
                                                    </strong></p>
                                                    <input type="hidden" id="selectedPrice_<?php echo $vehicleId; ?>" name="selectedPrice" value="<?php echo $row['price']; ?>">

                                                <!-- hidden input za vehicle_id -->
                                                <input type="hidden" name="vehicle_id" value="<?php echo $vehicleId; ?>">
                                                    
                                                    <button class="confirm-btn" type="submit">Next</button>
                                                </form>
                                            </div>
                                        </div>
                                        <button id="closeDetails" class="close-btn" onclick="(closeVehicleDetails(<?php echo $vehicleId; ?>))">X</button>
                                    </div>
                                </div>
                        <?php
                            }
                        }
                    }
                }
                else {
                    $sql = "
                        SELECT v.*
                        FROM vehicles v
                        WHERE v.vehicle_id NOT IN (
                            SELECT r.vehicle_id
                            FROM reservation r
                            WHERE NOT (
                                r.return_date < '" . $_SESSION['pickup-date'] . "'
                                OR r.pickup_date > '" . $_SESSION['return-date'] . "'
                            )
                        )
                    ";
                    
                    if ($rezultat = $mySqli->query($sql)) {

                        while ($row = $rezultat->fetch_assoc()) {
                            $imgName = str_replace(" ", "", $row['name']);
                            $vehicleId = $row['vehicle_id'];
                        ?>
                            <div class="vehicleCard" onclick="openVehicleDetails(<?php echo $vehicleId; ?>)" style="background-image: url(images/<?php echo $imgName?>.png);">
                                <div class="vehicleInfo">
                                    <h3><?php echo $row["name"]?></h3>
                                    <p><?php echo $row["description"] ?></p>
                                </div>
                                
                                <div class="vehiclePrice">
                                    <p><strong><?php echo $row["price"] . "€ / day" ?></strong></p>
                                </div>
                            </div>

                            <!-- EXTENDED INFO -->
                            <div id="vehicleDetails_<?php echo $vehicleId;?>" class="vehicle-details">
                                <div class="details-content">
                                    
                                    <div class="details-left">
                                        <img
                                            src="images/<?php echo $imgName?>.png"
                                            alt=""
                                            class="details-image"
                                        />
                                        <div class="details-overlay">
                                            <h2><?php echo $row["name"]?> or similar</h2>
                                            <p><?php echo $row["description"]?></p>
                                            <p><?php echo $row["year"]?></p>
                                        </div>
                                        <div class="vehicle-specs">
                                            <p><?php echo $row["seats"]?> Seats</p>
                                            <p><?php echo $row["suitcase"]?> Suitcase(s)</p>
                                            <p><?php echo $row["bag"]?> Bag(s)</p>
                                            <p><?php echo $row["transmission"]?></p>
                                            <p><?php echo $row["doors"]?> Doors</p>
                                        </div>
                                    </div>

                                    
                                    <div class="details-right">
                                        <h3>Booking option</h3>
                                        <div class="bookingOption">
                                            <p>
                                                Stay flexible <strong>Included</strong>
                                            </p>
                                        </div>
                                        <div class="milege">
                                            <h3>Mileage</h3>
                                            <div class="checkMilage first">
                                                <input 
                                                    type="radio" 
                                                    id="400km_<?php echo $vehicleId; ?>" 
                                                    name="mileage_<?php echo $vehicleId; ?>" 
                                                    value="<?php echo $row['price']; ?>" 
                                                    checked  
                                                    onchange="updatePrice(<?php echo $vehicleId; ?>, <?php echo $row['price']; ?>, <?php echo $row['unlimited_km']; ?>)"/>

                                                <label htmlFor="400km_<?php echo $vehicleId; ?>">400 km + $0.31 / km</label>
                                            </div>

                                            <div class="checkMilage second">
                                                <input 
                                                    type="radio" 
                                                    id="unlimited_<?php echo $vehicleId; ?>" 
                                                    name="mileage_<?php echo $vehicleId; ?>" 
                                                    value="<?php echo $row['price'] + $row['unlimited_km']; ?>" 
                                                    onchange="updatePrice(<?php echo $vehicleId; ?>, <?php echo $row['price']; ?>, <?php echo $row['unlimited_km']; ?>)" />

                                                <label htmlFor="unlimited">Unlimited kilometers + <?php echo $row['unlimited_km'] ?>€ / day</label>
                                            </div>
                                        </div>

                                        <div>
                                            <form action="../ProtectionPackage/protection.php" method="POST" class="next-section">
                                                <p><strong id="price_<?php echo $vehicleId; ?>">
                                                        <?php echo $row['price'] ?>€ / day
                                                </strong></p>
                                                
                                                <input type="hidden" id="selectedPrice_<?php echo $vehicleId; ?>" name="selectedPrice" value="<?php echo $row['price']; ?>">

                                                <!-- hidden input za vehicle_id -->
                                                <input type="hidden" name="vehicle_id" value="<?php echo $vehicleId; ?>">

                                                <button class="confirm-btn" type="submit">Next</button>
                                            </form>

                                            <script>
                                                document.querySelectorAll('input[name="mileage_<?php echo $vehicleId; ?>"]').forEach(radio => {
                                                    radio.addEventListener("change", function () {
                                                        document.getElementById("selectedPrice_<?php echo $vehicleId; ?>").value = this.value;
                                                    });
                                                });
                                            </script>

                                        </div>
                                    </div>
                                    <button id="closeDetails" class="close-btn" onclick="(closeVehicleDetails(<?php echo $vehicleId; ?>))">X</button>
                                </div>
                            </div>
                        <?php
                        }

                        ?>
                        
                    <?php
                    }
                }
            ?>
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
                <p class="text-center" id="copyr">© 2024 Company, Inc</p>
            </footer>
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="vehicles.js"></script>
</body>
</html>