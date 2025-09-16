
<?php
  session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartDrive</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    
    <!-- CSS -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <!-- PRELOADER ANIMATION -->
    <div id="preloader">
      <h1 class="preloader-name">
        <span class="line"></span>
        SmartDrive
        <span class="line"></span>
      </h1>
    </div>

    <!-- HEADER -->
    <section id="header">
      
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <!-- Logo -->
          <a class="navbar-brand text-white fw-bold" href="/">SmartDrive</a>

          <!-- Hamburger Button -->
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <!-- Collapsible Menu -->
          <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
            <ul class="navbar-nav">
              <!-- Navigation Links -->
              <li class="nav-item">
                <a class="nav-link text-white" href="#header">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="#jumbotrons">Features</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="#carousel">Reviews</a>
              </li>

              <!-- Login/Register or User Menu -->
              <?php if (isset($_SESSION['user_name'])) { ?>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php echo $_SESSION['user_name']; ?>
                  </a>
                  <?php if ($_SESSION['role'] === 'moderator') { ?>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                      <li><a class="dropdown-item" href="Edit/editUserProfile.php">Your profile</a></li>
                      <li><a class="dropdown-item" href="moderator/moderator.php">Moderator</a></li>
                    </ul>
                  <?php } else { ?>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                      <li><a class="dropdown-item" href="Edit/editUserProfile.php">Your profile</a></li>
                    </ul>
                  <?php } ?>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white" href="logout.php">Logout</a>
                </li>
              <?php } else { ?>
                <li class="nav-item">
                  <button type="button" class="btn btn-primary w-100 rounded-pill fw-semibold ms-lg-3" id="openPopup">Login | Register</button>
                </li>
              <?php } ?>
            </ul>
          </div>
        </div>
      </nav>


      <!-- Date selection -->
      <div class="container date-select">
        <div class="row align-items-center g-lg-5 py-5">
          
          <!-- LEVA STRANA -->
          <div class="col-lg-7 col-12 text-center text-lg-start strong-header mb-4 mb-lg-0">
            <h1 class="display-4 fw-bold lh-1 mb-3">Don't Rent a Car <br> <strong>Rent The Car</strong></h1>
            <p id="typewriter" class="col-lg-10 fs-4"></p>
          </div>
          
          <!-- DESNA STRANA -->
          <div class="col-lg-5 col-12 d-flex justify-content-center">
            <form 
              class="p-4 border rounded-4 shadow bg-white w-100" 
              style="max-width: 420px;" 
              method="post" 
              action="date.php" 
              name="dateSelection"
            >
              <h5 class="fw-bold mb-3 text-center">Book Your Car</h5>

              <!-- Grad -->
              <div class="mb-3 w-100">
                <label for="pickup-city" class="form-label">Pick-up & Return Location</label>
                <select name="pickup-city" id="pickup-city" class="form-select w-100">
                  <option value="all" selected>Select a City</option>
                  <option value="Belgrade">Belgrade</option>
                  <option value="Budva">Budva</option>
                  <option value="Ljubljana">Ljubljana</option>
                  <option value="Zagreb">Zagreb</option>
                </select>
              </div>

              <!-- Datum preuzimanja -->
              <div class="mb-3 w-100">
                <label for="pickup-date" class="form-label">Pick-up Date</label>
                <input type="text" name="pickup-date" id="pickup-date" class="form-control datepicker">
              </div>

              <!-- Datum vraćanja -->
              <div class="mb-3 w-100">
                <label for="return-date" class="form-label">Return Date</label>
                <input type="text" name="return-date" id="return-date" class="form-control datepicker">
              </div>

              <!-- Dugme -->
              <button 
                type="submit" 
                name="checkAvailability" 
                id="checkAvailability" 
                class="btn btn-primary w-100 rounded-pill fw-semibold"
              >
                Check Availability
              </button>
            </form>
          </div>

        </div>
      </div>
    </section>

    <!-- POPUP LOGIN -->
    <div id="popupContainer" class="popup">
      <div class="popup-content">
        <span id="closePopup" class="close">&times;</span>
        <h2 id="login-header">Login to your account</h2>
        <form method="POST" action="login.php" name="forma-login" id="forma-login">
          <div class="form-group py-3">
            <label for="email">Email:</label>
            <input type="email" id="email" class="input form-control" name="email" placeholder="Enter email" aria-describedby="email" required autofocus>
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
          </div>
          <div class="form-group py-3">
            <label for="password">Password:</label>
            <input type="password" id="password" class="input form-control" name="password" placeholder="Enter your password" required>
          </div>
            <button type="submit" class="btn btn-primary w-100 rounded-pill mb-3 fw-semibold" id="login">Login</button>

            <div class="register">
              <a href="Register/register.html">Don't have an account? Register now!</a>
            </div>
        </form>
      </div>
    </div>

    <!-- CARDS -->
    <section id="cards">
      <div class="container px-4 py-5" id="featured-3">
        <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
          <div class="feature col">
            <h3 class="fs-2 text-body-emphasis"><img src="svgs/worldsvg.svg" height="35" width="35" alt=""> Regional reach</h3>
            <h4>20+ SmartDrive stations in over 5 countries</h4>
          </div>

          <div class="feature col">
            <h3 class="fs-2 text-body-emphasis"><img src="svgs/car-svgrepo-com.svg" height="35" width="35" alt=""> Distinctive fleet</h3>
            <h4>From high-end convertibles to premium SUVs</h4>
          </div>

          <div class="feature col">
            <h3 class="fs-2 text-body-emphasis"><img src="svgs/service-svgrepo-com.svg" height="35" width="35" alt=""> Exceptional service</h3>
            <h4>Stress-free, trustworthy, no hidden costs</h4>
          </div>
        </div>
      </div>
    </section>


    <!-- JUMBOTRONS -->
    <section id="jumbotrons">

      <div class="container my-5 jumbo-div">
        <div class="p-5 text-center bg-body-tertiary rounded-3 jumbotron-1">
          <div class="jumbotron-content">
            <h1>LUXURY AND LOOKS FOR LESS</h1>
            <p class="col-lg-8 mx-auto fs-5">Book now and save up to 15% on luxury vehicles</p>
            <button class="d-inline-flex align-items-center btn btn-outline-primary btn-lg px-4 rounded-pill" type="button">
              Get offer
            </button>
          </div>
        </div>
      </div>


      <div class="container my-5 jumbo-div">
        <div class="p-5 text-center bg-body-tertiary rounded-3 jumbotron-2">
          
          <div class="jumbotron-content">
            <h1>Get Yourself the Car that Fits You the Most</h1>
            <p class="col-lg-8 mx-auto fs-5">
              Find the perfect car for your journey with our wide selection of vehicles tailored to your needs. Whether you need a compact car for city rides, a spacious SUV for family trips, or a luxury model for a special occasion, we’ve got you covered. Enjoy flexible rental plans, competitive prices, and a hassle-free experience. Drive in comfort and style—your ideal car is just a reservation away!
            </p>
            <div class="d-inline-flex gap-2 mb-5">
              <button class="d-inline-flex align-items-center btn btn-primary btn-lg px-4 rounded-pill" type="button" onclick="window.location.href='register/register.html'">
                Register
              </button>
              <button class="btn btn-outline-secondary btn-lg px-4 rounded-pill" type="button" id="openPopup2">
                Login
              </button>
            </div>
          </div>
        </div>
      </div>

    </section>


    <!-- CAROUSEL -->
    <section id="carousel">

      <div id="carouselExampleCaptions" class="carousel slide">

        <div class="carousel-outer">
          <div class="carousel-item active">
            <img src="images/carousel-image1.jpg" class="d-block w-100" alt="...">

            <div class="carousel-caption d-none d-md-block">
              <div id="captionCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">

                  <div class="carousel-item active">
                    <h5>One of the best hire car pick up experiences I’ve had. Great service and a good car.</h5>
                    <p>— Dave W., Belgrade Serbia</p>
                  </div>

                  <div class="carousel-item">
                    <h5>Very easy rental experience...so important when driving in another country. Car was great and no hidden fees.</h5>
                    <p>— Lisa R., Budva Montenegro</p>
                  </div>

                  <div class="carousel-item">
                    <h5>Seamless experience online, car handover and car return. The staff in the Munich branch are very friendly and competent.</h5>
                    <p>— Mahmoud F., Zagreb Croatia</p>
                  </div>

                  <div class="carousel-item">
                    <h5>SmartDrive is the only rental company I’ve never had an issue with. Seriously… they’ve turned me into a lifelong client.</h5>
                    <p>— P., Ljubljana Slovenia</p>
                  </div>

                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#captionCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#captionCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>



    <!-- FOOTER -->
    <section id="footer">
      
      <div class="container">
        <footer class="py-3 my-4">
          <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item"><a href="#header" class="nav-link px-2 text-body-secondary">Home</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Features</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Pricing</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">FAQs</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">About</a></li>
          </ul>
          <p class="text-center text-body-secondary" id="copyright"></p>
        </footer>
      </div>

    </section>


    

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- JavaScript -->
    <script src="index.js"></script>
</body>
</html>