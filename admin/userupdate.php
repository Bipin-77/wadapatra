<?php
require_once '../config/Database.php';
include_once "classes/User.php";
$user = new User();
//session_start();
// if (!isset($_SESSION['username']) && !isset($_SESSION['is_admin'])) {
//     header("Location:index.php");
// }
$db = new Database();
$conn = $db->getConnection();

$id = $_GET['id'];
$listRecord = $user->getRecordById($id);

if (isset($_POST['name'])) {
   
    if (
        isset($_FILES["image"]) &&
        $_FILES["image"]["error"] == UPLOAD_ERR_OK
    ) {
        
          // Add name of upload directory
        $uploadDirectory = "./profileimages/";
        $filename = $_FILES["image"]["name"];
        if (move_uploaded_file(
            $_FILES["image"]["tmp_name"],
            $uploadDirectory . $filename
            )){
                
                $cerated = $user->updateUser($_POST,$id, $filename);
                if ($cerated) {
                    header("Location:users.php");
                } else {
                echo "try again";
                }

            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="assets/css/adminstyle.css">
    <link rel="stylesheet" href="assets/css/userstyle.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin </title>
    <style>
  

  .close-btn {
      position: fixed;
     margin-top: 100px; 
      left: 120px;
      background: none;
      border: none;
      cursor: pointer;
      font-size: 24px;
      color: #333;
  }
  
  .close-btn:hover {
      color: #ff0000; /* Change color on hover for better visibility */
  }
      </style>
</head>

<body>
    <div class="container">
        <!-- aside section start -->

        <div class="left">
            <?php
            include_once 'includes/sidebar.php'
                ?>

        </div>


        <!-- aside end -->

        <!-- main area start -->
        <main class="main">
            <div class="topsection">
                <div class="leftsection">
                    <h1>Update User</h1>
                    <div class="date">
                        <?php echo date("d/m/y"); ?>
                    </div>
                </div>

               

            </div>
            <!-- top section end -->
            <div class="content">
                <div class="form-container">
                    <!-- Close Button -->
                   
                    <button class="close-btn" onclick="redirectToUsers()">
                            <span class="material-symbols-sharp">close</span>
                        </button>

                    <form action="" method="post" enctype="multipart/form-data">
                        <!-- Name -->
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" value="<?php echo $listRecord['name'] ?>">
                        </div>

                        <!-- Username -->
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username"
                                value="<?php echo $listRecord['username'] ?>">
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password"
                                value="<?php echo $listRecord['password'] ?>">
                        </div>

                        <!-- Address -->
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea id="address" name="address"
                                value="<?php echo $listRecord['address'] ?>"></textarea>
                        </div>

                        <!-- Gender -->


                        <!-- Date of Birth -->
                        <div class="form-group">
                            <label for="dob">Date of Birth</label>
                            <input type="date" id="dob" name="dob" value="<?php echo $listRecord['dob'] ?>">
                            <span id="dob-error" style="color: red; display: none;">User must be at least 10 years old.</span>
                        </div>

                        <!-- Role -->
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select id="role" name="role" value="<?php echo $listRecord['role'] ?>">
                                <option value="">Select your role</option>
                                <option value="admin">admin</option>
                                <option value="user">user</option>

                            </select>
                        </div>

                        <!-- Email -->
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="<?php echo $listRecord['email'] ?>">
                        </div>

                        <!-- Contact -->
                        <div class="form-group">
                            <label for="contact">Contact</label>
                            <input type="tel" id="contact" name="contact" value="<?php echo $listRecord['contact'] ?>">
                        </div>
                         <!-- Image Upload -->
                         <div class="form-group">
                            <label for="image">Upload Image:</label>
                            <input type="file" id="image" name="image" accept="image/*">
                        </div>

                        <!-- Submit Button -->
                        <button type="submit">Submit</button>
                    </form>
                </div>
            </div>
            <!-- content area end -->

        </main>

        <!-- main area end -->
        <!-- start right -->

        <!-- top end -->

        <!-- recent updates -->









        <!-- end recent updates -->

        <!-- start analytics -->

        <!-- start analytics -->


        <!-- end right -->

    </div>
    <!-- container -->
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
            window.location.href = "users.php";
        }
</script>
</body>

</html>