<?php
include_once "classes/Users.php";
$user = new Users();
if (isset($_POST['name'])) {

    $cerated = $user->contact($_POST);
    if ($cerated) {
        ?>
      
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                title: "Good job!",
                text: "Your inquery is registered!",
                icon: "success"
                timer: 2000, // Display the alert for 2 seconds
                showConfirmButton: false // Hide the confirm button
            }).then(() => {
                // Redirect after the alert is closed
                setTimeout(() => {
                    window.location.href = "contactus.php";
                }, 3000); // Redirect after 3 seconds
            
            });</script>
        <?php
       // header("Location:contactus.php");
    } else {
        echo "try again";
    }

}

?>

<!doctype html>
<html lang="en">

<!-- Include the navbar -->
<?php include 'onavbar.php'; ?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Us</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Custom CSS for Navbar -->
    <style>
        /* Custom CSS for navbar */
        .navbar {
            padding: 0.5rem 1rem;
            /* Reverted to original padding */
        }

        /* Circular logo styling */
        .logo-circle {
            width: 50px;
            /* Adjust size as needed */
            height: 50px;
            /* Adjust size as needed */
            border-radius: 50%;
            /* Makes it circular */
            overflow: hidden;
            /* Ensures the image stays within the circle */
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #ffffff;
            /* White background for the circle */
            border: 2px solid #ffcc00;
            /* Neon yellow border */
        }

        .logo-circle img {
            width: 100%;
            /* Ensures the image fills the circle */
            height: auto;
            /* Maintains aspect ratio */
        }

        /* Neon effect for MyCityHub */
        .navbar-brand .neon-text {
            font-family: 'Arial', sans-serif;
            font-weight: bold;
            font-size: 1.8rem;
            /* Slightly larger font size */
            text-transform: uppercase;
            color: #ffffff;
            /* White text for clarity */
            text-shadow: 0 0 5px #00ffcc, 0 0 10px #00ffcc, 0 0 20px #00ffcc;
            /* Neon cyan glow */
        }

        .navbar-brand .neon-text .mycity {
            color: rgb(242, 140, 8);
            /* Neon cyan for "MyCity" */
        }

        .navbar-brand .neon-text .hub {
            color: rgb(250, 12, 131);
            /* Neon yellow for "Hub" */
        }

        /* Navbar item styling */
        .navbar-nav .nav-item {
            margin-right: 1rem;
            /* Reverted to original spacing */
        }

        .navbar-nav .nav-link {
            font-size: 1rem;
            /* Reverted to original font size */
            font-weight: 500;
            /* Semi-bold */
            color: #ffffff;
            /* White color for better contrast */
            transition: all 0.3s ease;
            /* Smooth transition */
            padding: 0.5rem 1rem;
            /* Added padding for better click area */
            border-radius: 5px;
            /* Rounded corners */
        }

        .navbar-nav .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            /* Light background on hover */
            color: #ffffff;
            /* White text on hover */
        }

        .navbar-nav .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
            /* Slightly darker background for active state */
            color: #ffffff;
            /* White text for active state */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* Subtle shadow for depth */
        }

        /* Login button styling */
        .btn-danger {
            background-color: #dc3545;
            /* Red background */
            border: none;
            font-size: 1rem;
            /* Reverted to original font size */
        }

        .btn-danger:hover {
            background-color: #bb2d3b;
            /* Darker red on hover */
        }
    </style>
</head>

<body>
    <div
        style="border: 2px solid rgba(13, 165, 236, 0.927); margin-left: 3rem; margin-right: 3rem; margin-top: 3rem; margin-bottom: 3rem;">
        <div class="container my-4" style="margin-top: 1rem;">
            <h2>Contact Us</h2>
            <form method="post">
                <div class="row" style="margin-top: 1rem;">
                    <label for="exampleInputEmail1" class="form-label">Enter Your Name</label>

                    <div class="col">
                        <input type="text" class="form-control" placeholder="First name" aria-label="First name"
                            name="name">
                    </div>

                </div>
                <div class="col-12" style="margin-top: 1rem;">
                    <label for="inputAddress" class="form-label">Address</label>
                    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" name="address">
                </div>
                <div class="col-md-6" style="margin-top: 1rem;">
                    <label for="inputCity" class="form-label">City</label>
                    <input type="text" class="form-control" id="inputCity" name="city">
                </div>
                <div class="col-md-6" style="margin-top: 1rem;">
                    <label for="inputCity" class="form-label">Tole</label>
                    <input type="text" class="form-control" id="inputCity" name="tole">
                </div>
                <div class="col-md-4" style="margin-top: 1rem;">
                    <label for="inputWard" class="form-label">Ward No.</label>
                    <select id="inputWard" class="form-select" name="ward">
                        <option selected>Choose...</option>
                        <option value="1">1</optionval>
                        <option value="2">2</option>
                        <option vlaue="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                    </select>
                </div>
                <div class="mb-3" style="margin-top: 1rem;">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        name="email">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div style="margin-top: 1rem;">
                    <label for="exampleInputEmail1" class="form-label">Select Your Query</label>
                    <select class="form-select" aria-label="Select Your Query" name="query">
                        <option selected>Open this select menu</option>
                        <option value="event">About Events</option>
                        <option value="emmergency">About Emergency Contacts</option>
                        <option value="ecotracker">About Eco-Tracker</option>
                        <option value="polls">About Polls and Survey</option>
                        <option value="other">Others</option>
                    </select>
                </div>
                <div class="form-group" style="margin-top: 1rem;">
                    <label for="exampleFormControlTextarea1">Elaborate Your Concern</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="details"></textarea>
                </div>

                <button type="submit" class="btn btn-primary" style="margin-top: 2rem;">Submit</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer style="background-color: #17a2b8; color: #fff; text-align: center;
     padding: 15px; font-size: 16px; font-family: 'Segoe UI', Tahoma, Geneva, 
     Verdana, sans-serif; margin: 3rem 3rem 1rem; border-radius: 10px;
      box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.2);">
        <p style="margin: 0;">Developed by <span style="font-weight: bold; 
    color: #FFD700;">Lovies</span> | &copy;
            2026 | Contact Us: <a href="mailto:curiouserios@gmail.com"
                style="color: #fff; text-decoration: none; font-weight: bold;">lovies292@gmail.com</a> | Phone: <a
                href="tel:9825629489" style="color: #fff; text-decoration: none; font-weight: bold;">9708077117
                (bipin)</a></p>
    </footer>

    <!-- Bootstrap JS (with Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>