<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

// Include the database connection file
require_once 'config/Database.php';

// Create a database instance and get the connection
$db = new Database();
$conn = $db->getConnection();

// Fetch user details from the database
$username = $_SESSION['username'];
$stmt = $conn->prepare("SELECT name, username, address, email, contact, image, dob FROM users WHERE username = :username");
$stmt->bindParam(':username', $username);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if user data was found
if (!$user) {
    die("User not found.");
}

// Handle form submission for updating profile
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm_update'])) {
    $new_username = $_POST['username'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $dob = $_POST['dob'];  // Add DOB
    $image = $user['image']; // Default to existing image

    // Ensure email and contact are not changed together
    if ($email != $user['email'] && $contact != $user['contact']) {
        die("You cannot change both email and contact at the same time.");
    }

    // Check if the new username already exists
    if ($new_username != $user['username']) {
        $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
        $stmt->bindParam(':username', $new_username);
        $stmt->execute();
        if ($stmt->fetchColumn() > 0) {
            die("Username is already taken. Please choose another one.");
        }
    }

    // Handle profile image upload
    if (!empty($_FILES['profile_image']['name'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['profile_image']['name']);
        move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_file);
        $image = $target_file;
    }

    // Update user details in the database
    $stmt = $conn->prepare("UPDATE users SET username = :username, name = :name, address = :address, email = :email, contact = :contact, dob = :dob, image = :image WHERE username = :current_username");
    $stmt->bindParam(':username', $new_username);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':contact', $contact);
    $stmt->bindParam(':dob', $dob);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':current_username', $username);
    $stmt->execute();

    // Update session with the new username
    $_SESSION['username'] = $new_username;

    echo "<script>
    setTimeout(function() {
        window.location.href = 'index.php';
    }, 1000); // Redirect after 1 second
       </script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f4f4f9;
            font-family: 'Arial', sans-serif;
        }

        .profile-container {
            max-width: 500px;
            background: white;
            margin: 50px auto;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: relative;
        }

        .profile-pic {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #007bff;
            display: block;
            margin: 0 auto 15px;
        }

        h3 {
            font-weight: bold;
            color: #333;
        }

        .form-label {
            margin-top: 8px;
            font-weight: 600;
            color: #555;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #ccc;
            padding: 10px;
        }

        .btn-primary {
            background: #007bff;
            border: none;
            font-weight: bold;
            padding: 10px;
            border-radius: 8px;
            transition: 0.3s;
        }

        .btn-primary:hover {
            background: #0056b3;
        }

        .close-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 18px;
            color: #ff4d4d;
            background: none;
            border: none;
            cursor: pointer;
        }

        .close-btn:hover {
            color: red;
        }

        .modal-content {
            border-radius: 12px;
            text-align: center;
        }

        .modal-header {
            background: #007bff;
            color: white;
            border-radius: 12px 12px 0 0;
        }

        .modal-body {
            font-size: 16px;
            color: #444;
        }

        .modal-footer .btn {
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="profile-container bg-light position-relative">
            <button class="btn btn-danger close-btn" onclick="window.history.back();">&times;</button>
            <h3 class="text-center">Edit Profile</h3>
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="text-center" style="margin-bottom: 1rem; margin-left: 6rem; margin-right: 6rem;">
                    <img src="<?php echo !empty($user['image']) ? $user['image'] : 'uploads/default.png'; ?>"
                        class="profile-pic" id="previewImage">
                    <input type="file" name="profile_image" id="profileImage" class="form-control mt-2"
                        accept="image/*">
                </div>

                <!-- Display label and input fields in the same row -->
                <div class="mb-3 row">
                    <div class="col-4">
                        <label class="form-label">Username</label>
                    </div>
                    <div class="col-8">
                        <input type="text" class="form-control" name="username"
                            value="<?php echo htmlspecialchars($user['username']); ?>" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col-4">
                        <label class="form-label">Name</label>
                    </div>
                    <div class="col-8">
                        <input type="text" class="form-control" name="name"
                            value="<?php echo htmlspecialchars($user['name']); ?>" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col-4">
                        <label class="form-label">Address</label>
                    </div>
                    <div class="col-8">
                        <input type="text" class="form-control" name="address"
                            value="<?php echo htmlspecialchars($user['address']); ?>" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col-4">
                        <label class="form-label">Email</label>
                    </div>
                    <div class="col-8">
                        <input type="email" class="form-control" name="email"
                            value="<?php echo htmlspecialchars($user['email']); ?>" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col-4">
                        <label class="form-label">Contact</label>
                    </div>
                    <div class="col-8">
                        <input type="text" class="form-control" name="contact"
                            value="<?php echo htmlspecialchars($user['contact']); ?>" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col-4">
                        <label class="form-label">Date of Birth</label>
                    </div>
                    <div class="col-8">
                        <input type="date" class="form-control" name="dob"
                            value="<?php echo htmlspecialchars($user['dob']); ?>" required>
                    </div>
                </div>

                <input type="hidden" name="confirm_update" value="1">
                <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal"
                    data-bs-target="#confirmModal">Save Changes</button>
            </form>
        </div>
    </div>

    <!-- Stylish Bootstrap Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirm Update</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to update your profile?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" onclick="submitForm()">Yes, Update</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('profileImage').addEventListener('change', function (event) {
            const reader = new FileReader();
            reader.onload = function () {
                document.getElementById('previewImage').src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        });

        function submitForm() {
            document.querySelector("form").submit(); // Submit the form when "Yes, Update" is clicked
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>