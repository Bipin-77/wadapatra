<?php
session_start(); // Start the session at the beginning of the file

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    // Include the database connection file
    require_once 'config/Database.php';

    // Create a database instance and get the connection
    $db = new Database();
    $conn = $db->getConnection();

    // Fetch user details from the database
    $username = $_SESSION['username'];
    $stmt = $conn->prepare("SELECT name, username, address, email, contact FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Get the current file name
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Custom CSS for navbar */
        .navbar {
            padding: 0.5rem 1rem;
        }

        /* Circular logo styling */
        .logo-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #ffffff;
            border: 2px solid #ffcc00;
        }

        .logo-circle img {
            width: 100%;
            height: auto;
        }

        /* Neon effect for MyCityHub */
        .navbar-brand .neon-text {
            font-family: 'Arial', sans-serif;
            font-weight: bold;
            font-size: 1.8rem;
            text-transform: uppercase;
            color: #ffffff;
            text-shadow: 0 0 5px #00ffcc, 0 0 10px #00ffcc, 0 0 20px #00ffcc;
        }

        .navbar-brand .neon-text .mycity {
            color: rgb(242, 140, 8);
        }

        .navbar-brand .neon-text .hub {
            color: rgb(250, 12, 131);
        }

        /* Navbar item styling */
        .navbar-nav .nav-item {
            margin-right: 1rem;
        }

        .navbar-nav .nav-link {
            font-size: 1rem;
            font-weight: 500;
            color: #ffffff;
            transition: all 0.3s ease;
            padding: 0.5rem 1rem;
            border-radius: 5px;
        }

        .navbar-nav .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
        }

        .navbar-nav .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
            color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-nav .nav-link i {
            color: #ffcc00;
            font-size: 1.1rem;
        }

        .navbar-nav .nav-link:hover i {
            color: #ffffff;
        }

        /* Login button styling */
        .btn-danger {
            background-color: #dc3545;
            border: none;
            font-size: 1rem;
        }

        .btn-danger:hover {
            background-color: #bb2d3b;
        }

        /* Profile Popup Styling */
        .profile-popup {
            display: none;
            position: fixed;
            top: 8rem;
            /* Adjusted to 6rem from the top */
            right: 5rem;
            width: 400px;
            /* Increased width */
            height: auto;
            background-color: #ffffff;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            padding: 20px;
            z-index: 1000;
        }

        .profile-popup.show {
            display: block;
        }

        .profile-picture-container {
            position: relative;
            margin-bottom: 20px;
        }

        .profile-picture {
            width: 150px;
            /* Increased size */
            height: 150px;
            /* Increased size */
            border-radius: 50%;
            background-color: #0dcaf0;
            margin: 0 auto;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .profile-picture img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .edit-profile-btn {
            position: absolute;
            bottom: 0;
            right: 0;
            background-color: #0dcaf0;
            border: none;
            color: #ffffff;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .edit-profile-btn:hover {
            background-color: #0b5ed7;
        }

        .profile-name {
            font-size: 28px;
            /* Increased font size */
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .profile-details {
            text-align: left;
            margin-top: 20px;
        }

        .profile-details p {
            font-size: 18px;
            /* Increased font size */
            color: #555;
            margin: 10px 0;
        }

        .profile-details strong {
            color: #333;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            font-size: 24px;
            /* Increased font size */
            cursor: pointer;
            color: #333;
        }

        /* Overlay for closing popup when clicking outside */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .overlay.show {
            display: block;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-info"
        style="margin-top: 1rem; margin-left: 3rem; margin-right: 3rem;">
        <div class="container-fluid">
            <!-- Circular logo for website -->
            <a class="navbar-brand d-flex align-items-center" href="#">
                <div class="logo-circle">
                 <img src="about/logo.png" alt="Nagarik Wadapatra Logo">
                </div>
                <span class="neon-text ms-3">
                    <span class="mycity">Nagarik Wodapatra</span><span class="hub">Hub</span>
                </span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- Home with icon -->
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>"
                            aria-current="page" href="index.php">
                            <span class="nav-text">Home</span>
                        </a>
                    </li>

                    <!-- Local Events with icon -->
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'event.php') ? 'active' : ''; ?>"
                            aria-current="page" href="event.php">
                            <span class="nav-text">Events</span>
                        </a>
                    </li>


                    <!-- Notice  -->
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'notice.php') ? 'active' : ''; ?>"
                            aria-current="page" href="notice.php">
                            <span class="nav-text">Notice</span>
                        </a>
                    </li>

                    <!-- Emergency Contacts with icon -->
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'sos.php') ? 'active' : ''; ?>"
                            aria-current="page" href="sos.php">
                            <span class="nav-text">Emergency</span>
                        </a>
                    </li>

                    <!-- Eco-Tracker with icon -->
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'eco.php') ? 'active' : ''; ?>"
                            aria-current="page" href="eco.php">
                            <span class="nav-text">Eco-Tracker</span>
                        </a>
                    </li>

                    <!-- Polls and Survey with icon -->
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'surveypoll.php') ? 'active' : ''; ?>"
                            aria-current="page" href="surveypoll.php">
                            <span class="nav-text">Opinion Poll</span>
                        </a>
                    </li>

                    <!-- Budget Transparency with icon -->
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'budget.php') ? 'active' : ''; ?>"
                            aria-current="page" href="budget.php">
                            <span class="nav-text">Budgets</span>
                        </a>
                    </li>

                    <!-- About Us with icon -->
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'about.php') ? 'active' : ''; ?>"
                            aria-current="page" href="about.php">
                            <span class="nav-text">About Us</span>
                        </a>
                    </li>

                    <!-- Contact Us with icon -->
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'contactus.php') ? 'active' : ''; ?>"
                            aria-current="page" href="contactus.php">
                            <span class="nav-text">Inquiries</span>
                        </a>
                    </li>
                </ul>

                <!-- Username Button -->
                <?php //echo "<pre>"; print_r($_SESSION); exit; ?>
                <div style="margin-left: 1rem;">
                    <?php if (isset($_SESSION['username'])): ?>
                        <button type="button" class="btn btn-danger" onclick="toggleProfilePopup()">
                            <i class="fas fa-user me-1"></i><?php echo htmlspecialchars($_SESSION['username']); ?>
                        </button>
                    <?php else: ?>
                        <a href="login.php" class="btn btn-danger"><i class="fas fa-sign-in-alt me-1"></i>Login</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Profile Popup -->
    <?php if (isset($_SESSION['username'])): ?>
        <?php
        // Include the database connection file
        require_once 'config/Database.php';

        // Create a database instance and get the connection
        $db = new Database();
        $conn = $db->getConnection();

        // Fetch all user details including DOB
        $username = $_SESSION['username'];
        $stmt = $conn->prepare("SELECT name, username, address, email, contact, dob, image FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set profile image
        $profileImage = !empty($user['image']) ? $user['image'] : 'uploads/default.png';
        ?>

        <div class="overlay" id="overlay" onclick="toggleProfilePopup()"></div>
        <div class="profile-popup" id="profilePopup">
            <button class="close-btn" onclick="toggleProfilePopup()">&times;</button>
            <div class="profile-picture-container">
                <div class="profile-picture">
                    <img src="<?php echo htmlspecialchars($profileImage); ?>" alt="Profile Picture">
                </div>
                <button class="edit-profile-btn" onclick="window.location.href='edit.php'">
                    <i class="fas fa-edit"></i>
                </button>
            </div>
            <div class="profile-name"><?php echo htmlspecialchars($user['name']); ?></div>
            <div class="profile-details">
                <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                <p><strong>Contact:</strong> <?php echo htmlspecialchars($user['contact']); ?></p>
                <p><strong>Address:</strong> <?php echo htmlspecialchars($user['address']); ?></p>
                <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($user['dob']); ?></p> <!-- Added DOB -->
            </div>

            <!-- Logout Button -->
            <button class="btn btn-danger w-100 mt-3" onclick="window.location.href='logout.php'">
                <i class="fas fa-sign-out-alt me-2"></i>Logout
            </button>
        </div>
    <?php endif; ?>


    <script>
        function toggleProfilePopup() {
            const profilePopup = document.getElementById('profilePopup');
            const overlay = document.getElementById('overlay');
            profilePopup.classList.toggle('show');
            overlay.classList.toggle('show');
        }

        // Close popup when clicking outside
        document.addEventListener('click', function (event) {
            const profilePopup = document.getElementById('profilePopup');
            const overlay = document.getElementById('overlay');
            if (event.target === overlay || event.target.classList.contains('close-btn')) {
                profilePopup.classList.remove('show');
                overlay.classList.remove('show');
            }
        });
    </script>
</body>

</html>