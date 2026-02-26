<?php

if ($_POST) {
  include_once "classes/Users.php";
  $user = new Users();


  $pass = $_POST['password'];
  $cpass = $_POST['confirm'];

  // Check if passwords are not empty and match
  if (!empty($pass) && !empty($cpass) && $pass === $cpass) {
    // Additional password validation can be added here (e.g., length, complexity)
    
    $created = $user->registerUser($_POST);
    if ($created) {
      header("Location:login.php");
    } else {
      echo "Registration failed, please try again.";
    }
  } else {
    echo "Passwords do not match or are empty. Please try again.";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Sign Up</title>
  <style>
    /* General Styles */


    .registration-form {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
      margin: 0 auto;
    }

    .registration-form h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group label {
      display: block;
      margin-bottom: 5px;
      color: #555;
    }

    .form-group input {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 16px;
    }

    .form-group input:focus {
      border-color: #007bff;
      outline: none;
    }

    button {
      width: 100%;
      padding: 10px;
      background-color: #007bff;
      border: none;
      border-radius: 4px;
      color: #fff;
      font-size: 16px;
      cursor: pointer;
    }

    button:hover {
      background-color: #0056b3;
    }
  </style>
</head>

<body>
  <div class="registration-form">
    <h2>Register</h2>
    <form action="" method="POST">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>
      </div>
      <div class="form-group">
        <label for="name">Full Name</label>
        <input type="text" id="name" name="name" required>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="phone">Phone Number</label>
        <input type="tel" id="phone" name="contact" required>
      </div>
      <div class="form-group">
        <label for="dob">Date of Birth</label>
        <input type="date" id="dob" name="dob" required>
      </div>
      <div class="form-group">
        <label for="address">Address</label>
        <input type="text" id="address" name="address" rows="3" required>
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
      </div>
      <div class="form-group">
        <label for="confirmPassword">Confirm Password</label>
        <input type="password" id="confirmPassword" name="confirm" required>
      </div>
      <button type="submit">Register</button>
    </form>
  </div>
  <script src="script.js"></script>
  <script>

        document.addEventListener("DOMContentLoaded", function () {
            let dobInput = document.getElementById("dob");
            let today = new Date();
            let minAge = 10;

            // Calculate the max allowed DOB (today - 10 years)
            let maxDOB = new Date(today.getFullYear() - minAge, today.getMonth(), today.getDate());
            let formattedMaxDOB = maxDOB.toISOString().split("T")[0];

            // Set the max attribute for the date picker
            dobInput.setAttribute("max", formattedMaxDOB);
            dobInput.removeAttribute("readonly"); // Allow user to select from calendar, but not type manually
        });
        function validateUserDOB() {
            let dobInput = document.getElementById("dob").value;
            let dobError = document.getElementById("dob-error");

            if (dobInput) {
                let dob = new Date(dobInput);
                let today = new Date();
                let age = today.getFullYear() - dob.getFullYear();
                let monthDiff = today.getMonth() - dob.getMonth();
                let dayDiff = today.getDate() - dob.getDate();

                // Adjust age if the birthday hasn't occurred yet this year
                if (monthDiff < 0 || (monthDiff === 0 && dayDiff < 0)) {
                    age--;
                }

                if (age < 10) {
                    dobError.style.display = "block"; // Show error message
                    return false; // Prevent form submission
                } else {
                    dobError.style.display = "none"; // Hide error message
                    return true; // Allow form submission
                }
            }
            return false; // Prevent form submission if no DOB is entered
        }
        function redirectToUsers() {
            window.location.href = "register.php";
        }
    </script>
</body>

</html>