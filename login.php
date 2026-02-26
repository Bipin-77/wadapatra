<?php
session_start(); // Start the session
require_once 'config/Database.php'; // Include the database connection file

// Create a database instance and get the connection
$db = new Database();
$conn = $db->getConnection();

$error = ""; // Initialize error message

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get username and password from the form
    $username = trim($_POST['username']); // Trim whitespace
    $password = md5(trim($_POST['password'])); // Encrypt the password using md5

    // Validate inputs (basic validation)
    if (empty($username) || empty($password)) {
        $error = "Username and password are required.";
    } else {
        // Prepare the SQL statement to fetch user details
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Store the username in the session
           // $_SESSION['username'] = $user['username']; // Use the username from the database

            // Check the role (assuming the role is stored in the database)
            if ($stmt->rowCount()>0){
                if($user['role']=='admin'){
                    $_SESSION ['username']=$username;
                    $_SESSION['is_admin']=true;
                    header('location:admin/dashboard.php');
                    exit;
                }else{
                    $_SESSION['username']=$username;
                    $_SESSION['is_user']=true;
                    header("Location:index.php");
                    exit;
                }
                
            }else{
                echo "invalid username or password";
            }
        } else {
            $error = "Invalid username or password."; // Set error message
        }
    }
}

// If there's an error or the form hasn't been submitted, stay on the login page
// You can handle the error display in your HTML form
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nagarik Wadapatra Login</title>
    <!-- Include Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* General Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        /* Full-page background with a beautiful picture */
        body {
            background: url('uploads/loginbg.jpg') no-repeat center center fixed; /* Add your beautiful background image */
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Dark overlay for better readability */
        body::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* Dark overlay */
            z-index: 1;
        }

        /* Wrapper for the entire page */
        .page-wrapper {
            position: relative;
            z-index: 2;
            width: calc(100% - 2rem); /* Subtract 2rem for the gap on both sides */
            height: calc(100% - 2rem); /* Subtract 2rem for the gap on both sides */
            margin: 1rem; /* 1rem gap on all sides */
            border: 2px solid white; /* White border */
            border-radius: 15px; /* Rounded corners */
            overflow: hidden; /* Ensure content stays within the border */
        }

        /* Login Container - Bigger and Slightly Down */
        .login-container {
            position: absolute;
            top: 50%;
            right: 10%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.1); /* Semi-transparent white background */
            padding: 50px; /* Increased padding for more space */
            border-radius: 15px; /* Less rounded corners for rectangle shape */
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px); /* Blur effect */
            text-align: center;
            width: 450px; /* Increased width */
            color: #fff;
        }

        /* Cross Button */
        .cross-button {
            position: absolute;
            top: 20px;
            right: 20px;
            background: none;
            border: none;
            font-size: 24px;
            color: #fff;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .cross-button:hover {
            color: #ff4d4d; /* Red color on hover */
        }

        /* Logo and MyCityHub Label */
        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
        }

        .logo img {
            width: 80px; /* Bigger logo */
            height: 80px;
            border-radius: 50%;
            margin-right: 15px;
            border: 2px solid #ffcc00;
        }

        .logo .mycityhub {
            font-size: 28px; /* Bigger text */
            font-weight: 600;
        }

        .logo .mycityhub .mycity {
            color: #ffcc00; /* Neon yellow for "MyCity" */
        }

        .logo .mycityhub .hub {
            color: #ff0099; /* Neon pink for "Hub" */
        }

        /* Input Fields */
        .field {
            position: relative;
            height: 50px;
            width: 100%;
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.2); /* Semi-transparent white background */
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .field span {
            color: #fff; /* Icon color */
            width: 50px;
            line-height: 50px;
            text-align: center;
            font-size: 20px; /* Bigger icons */
        }

        .field input {
            height: 100%;
            width: 100%;
            background: transparent;
            border: none;
            outline: none;
            color: #fff;
            font-size: 16px;
            padding-right: 50px;
        }

        .field input::placeholder {
            color: rgba(255, 255, 255, 0.7); /* Placeholder color */
        }

        /* Eye Icon for Password */
        .eye-icon {
            position: absolute;
            right: 15px;
            font-size: 18px;
            color: #fff;
            cursor: pointer;
            display: none; /* Hidden by default */
        }

        .eye-icon:hover {
            color: #ffcc00; /* Neon yellow on hover */
        }

        /* Forgot Password Link */
        .pass {
            text-align: right;
            margin-bottom: 20px;
        }

        .pass a {
            color: #ff4d4d; /* Red color */
            text-decoration: none;
            font-size: 14px;
        }

        .pass a:hover {
            text-decoration: underline;
        }

        /* Login Button */
        .field input[type="submit"] {
            background: linear-gradient(135deg, #ffcc00, #ff9900); /* Gradient button */
            border: none;
            color: #000;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .field input[type="submit"]:hover {
            background: linear-gradient(135deg, #ff9900, #ffcc00); /* Reverse gradient on hover */
        }

        /* Sign Up Link */
        .signup {
            margin-top: 20px;
            font-size: 14px;
        }

        .signup a {
            color: #ffcc00; /* Neon yellow */
            text-decoration: none;
            font-weight: 600;
        }

        .signup a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Wrapper for the entire page -->
    <div class="page-wrapper">

        <!-- Login Container -->
        <div class="login-container">
            <!-- Cross Button -->
            <button class="cross-button" onclick="window.location.href='index.php'">
                <i class="fas fa-times"></i> <!-- Font Awesome cross icon -->
            </button>

            <!-- Logo and MyCityHub Label -->
            <div class="logo">
                <img src="about/logo.png" alt="Nagarik Wadapatra Logo">
                <div class="mycityhub">
                    <span class="mycity">Nagarik</span><span class="hub">Wadapatra</span>
                </div>
            </div>

            <!-- Display error message -->
            <?php if (!empty($error)): ?>
                <div style="color: red; margin-bottom: 20px;"><?php echo $error; ?></div>
            <?php endif; ?>

            <!-- Login Form -->
            <form id="loginForm" action="" method="POST">
                <!-- Username Field -->
                <div class="field">
                    <span class="fas fa-user-astronaut"></span> <!-- Modern stylish icon for username -->
                    <input type="text" name="username" placeholder="Username" required>
                </div>

                <!-- Password Field -->
                <div class="field">
                    <span class="fas fa-fingerprint"></span> <!-- Modern stylish icon for password -->
                    <input type="password" name="password" class="pass-key" placeholder="Password" required>
                    <span class="eye-icon fas fa-eye" onclick="togglePassword()"></span> <!-- Eye icon -->
                </div>

                <!-- Forgot Password Link -->
                <div class="pass">
                    <a href="forgot.php">Forgot Password?</a>
                </div>

                <!-- Login Button -->
                <div class="field">
                    <input type="submit" value="LOGIN">
                </div>
            </form>

            <!-- Sign Up Link -->
            <div class="signup">
                Don't have an account? <a href="register.php">Signup Now</a>
            </div>
        </div> 
    </div>

    <!-- Show/Hide Password Script -->
    <script>
        const passwordField = document.querySelector('.pass-key');
        const eyeIcon = document.querySelector('.eye-icon');

        // Function to toggle password visibility
        function togglePassword() {
            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash'); // Change to closed eye
            } else {
                passwordField.type = "password";
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye'); // Change to open eye
            }
        }

        // Show/hide eye icon based on input value
        passwordField.addEventListener('input', function () {
            if (passwordField.value.length > 0) {
                eyeIcon.style.display = 'block'; // Show eye icon
            } else {
                eyeIcon.style.display = 'none'; // Hide eye icon
            }
        });
    </script>
</body>
</html>