
<?php


require 'classes/Users.php';
$informations = new Users();

$listsOfficias = $informations->listOfficials();



?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nagarik Wadapatra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Custom CSS for circular logo */
        .navbar-brand img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        /* Neon effect for wodapatra */
        .navbar-brand .neon-text {
            font-family: 'Arial', sans-serif;
            font-weight: bold;
            font-size: 1.8rem;
            /* Increased font size */
            text-transform: uppercase;
            animation: neonGlow 1.5s infinite alternate;
        }

        .navbar-brand .neon-text .mycity {
            color: #00ffcc;
        }

        .navbar-brand .neon-text .hub {
            color: #ff00ff;
        }

        @keyframes neonGlow {
            0% {
                text-shadow: 0 0 5px #00ffcc, 0 0 10px #00ffcc, 0 0 20px #00ffcc, 0 0 40px #ff00ff, 0 0 80px #ff00ff;
            }

            100% {
                text-shadow: 0 0 10px #00ffcc, 0 0 20px #00ffcc, 0 0 40px #00ffcc, 0 0 80px #ff00ff, 0 0 120px #ff00ff;
            }
        }

        /* Navbar item styling */
        .navbar-nav .nav-item {
            margin-right: 1rem;
            /* Increased spacing between navbar items */
        }

        .navbar-nav .nav-link {
            font-size: 1.1rem;
            /* Increased font size */
            font-weight: 500;
            /* Semi-bold */
            color: #333;
            /* Darker color for better readability */
        }

        .navbar-nav .nav-link:hover {
            color: #0d6efd;
            /* Change color on hover */
        }

        /* Highlight for Respected Officials section */
        .officials-section {
            background-color: #f8f9fa;
            /* Light background */
            padding: 2rem;
            border-radius: 10px;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        .officials-section h2 {
            font-size: 2rem;
            font-weight: bold;
            color: #0d6efd;
            /* Blue color for heading */
            margin-bottom: 1.5rem;
        }

        /* Footer styling */
        footer {
            text-align: center;
            padding: 1rem;
            background-color: #f8f9fa;
            margin-top: 2rem;
        }
    </style>
</head>

<body>
    <!-- Include Navbar -->
    <?php include 'navbar.php'; ?>

    <!-- Carousel -->
    <div style="margin-left: 3rem; margin-right: 3rem; margin-bottom: 2rem;">
        <div id="carouselExampleCaptions" class="carousel slide carousel-fade">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="3cr.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h2>WELCOME TO Nagarik Wadapatra</h2>
                        <p>Stay Connected, Informed and Engaged.</p>
                        <a href="event.php" class="btn btn-primary">Local Events</a>
                        <a href="sos.php" class="btn btn-danger">Emergency Contacts</a>
                        <a href="eco.php" class="btn btn-success">Eco-Tracker</a>
                        
                        <a href="budget.php" class="btn btn-light">Budget Transparency</a>
                        <a href="notice.php" class="btn btn-dark">Notices</a>


                    </div>
                </div>
                <div class="carousel-item">
                    <img src="2cr.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h2>WELCOME TO Nagarik Wadapatra</h2>
                        <p>Stay Connected, Informed and Engaged.</p>
                        <a href="event.php" class="btn btn-primary">Local Events</a>
                        <a href="sos.php" class="btn btn-danger">Emergency Contacts</a>
                        <a href="eco.php" class="btn btn-success">Eco-Tracker</a>
                        
                        <a href="budget.php" class="btn btn-light">Budget Transparency</a>
                        <a href="notice.php" class="btn btn-dark">Notices</a>


                    </div>
                </div>
                <div class="carousel-item">
                    <img src="1cr.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h2>WELCOME TO Nagarik Wadapatra</h2>
                        <p>Stay Connected, Informed and Engaged.</p>
                        <a href="event.php" class="btn btn-primary">Local Events</a>
                        <a href="sos.php" class="btn btn-danger">Emergency Contacts</a>
                        <a href="eco.php" class="btn btn-success">Eco-Tracker</a>
                       
                        <a href="budget.php" class="btn btn-light">Budget Transparency</a>
                        <a href="notice.php" class="btn btn-dark">Notices</a>


                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <!-- Respected Officials Section -->
    <div class="officials-section container">
        <h2>Respected Officials</h2>

        <div class="row mb-2">
        <?php
                    $i = 1;
                    foreach ($listsOfficias as $listEvent) {

                        ?>
            <div class="col-md-6">
                <div
                    class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 text-primary-emphasis"><?php echo $listEvent['post']; ?></strong>
                        <h3 class="mb-0"><?php echo $listEvent['name']; ?><Cha/h3>
                        <div class="mb-1 text-body-secondary">Elected date:<?php echo $listEvent['elected_date']; ?><br> Retire date:<?php echo $listEvent['end_date']; ?></div>
                        <p class="card-text mb-auto"><?php echo $listEvent['details']; ?></p>
                    </div>
                    <div class="col-auto d-none d-lg-block">
                        <img class="bd-placeholder-img" width="200" height="250" src="./admin/images/<?php echo $listEvent['image'];?>" alt="">
                    </div>
                </div>
            </div>
            <?php $i++;
                    } ?>
            <div class="col-md-6">
             
                    
        </div>
    </div>

    <!-- Footer -->
    <footer style="background-color: #17a2b8; color: #fff; text-align: center;
     padding: 15px; font-size: 16px; font-family: 'Segoe UI', Tahoma, Geneva, 
     Verdana, sans-serif; margin: 3rem 3rem 1rem; border-radius: 10px;
      box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.2);">
        <p style="margin: 0;">Developed by <span style="font-weight: bold; 
    color: #4400ff;">Lovies</span> | &copy;
            2026 | Contact Us: <a href="mailto:bipinbohara2@gmail.com"
                style="color: #fff; text-decoration: none; font-weight: bold;">lovies292@gmail.com</a> | Phone: <a
                href="tel:9825629489" style="color: #fff; text-decoration: none; font-weight: bold;">9708077117 (bipin)</a></p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>