<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    die("User not logged in."); // Stop execution if the user is not logged in
}

// Include the database connection file
require_once 'config/Database.php';

// Create a database instance and get the connection
$db = new Database();
$conn = $db->getConnection();

// Fetch user details from the database, including dob
$username = $_SESSION['username'];
$stmt = $conn->prepare("SELECT name, username, address, email, contact, dob, image FROM users WHERE username = :username");
$stmt->bindParam(':username', $username);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if user data was found
if (!$user) {
    die("User not found."); // Handle the case where the user is not found in the database
}

// Set profile image
$profileImage = !empty($user['image']) ? $user['image'] : 'uploads/default.jpg'; // Use user's image or default
?>
<style>
    
</style>
<!-- Profile Content -->
<div class="profile-container">
    <!-- Profile Picture and Edit Button -->
    <div class="profile-picture-container">
        <div class="profile-picture">
            <img src=".uploads/<?php echo htmlspecialchars($profileImage); ?>" alt="Profile Picture">
        </div>
        <!-- Edit Profile Button -->
        <button class="edit-profile-btn" onclick="window.location.href='editprofile.php'">
            <i class="fas fa-edit"></i>
        </button>
    </div>

    <!-- User Name -->
    <div class="profile-name">
        <?php echo htmlspecialchars($user['name']); ?>
    </div>

    <!-- User Details -->
    <div class="profile-details">
        <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
        <p><strong>Address:</strong> <?php echo htmlspecialchars($user['address']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p><strong>Contact:</strong> <?php echo htmlspecialchars($user['contact']); ?></p>
        <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($user['dob']); ?></p> <!-- Added DOB -->
    </div>

    <!-- Logout Button -->
    <button class="btn btn-danger w-100 mt-3" onclick="window.location.href='logout.php'">
        <i class="fas fa-sign-out-alt me-2"></i>Logout
    </button>
</div>