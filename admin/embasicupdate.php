<?php
require_once '../config/Database.php';
include_once "classes/Emergency.php";
    $user = new Emergency();
    $id = $_GET['id'];
$listRecord = $user->getRecordById($id);
// session_start();
// if (!isset($_SESSION['username']) && !isset($_SESSION['is_admin'])) {
//     header("Location:index.php");
// }
$db = new Database();
$conn = $db->getConnection();

// if ($_POST){
if (isset($_POST['service'])) {
    
    $cerated = $user->editBasic($_POST,$id);
    if ($cerated) {
        header("Location:emergency_contact.php");
    } else {
        echo "try again";
    }
    
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="assets/css/adminstyle.css">
    <!-- Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emergency contacts update Basic  </title>
    <!-- Custom CSS -->
    <style>


.form-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input[type="text"],
        .form-group input[type="tel"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-group input[type="text"]:focus,
        .form-group input[type="tel"]:focus {
            border-color: #66afe9;
            outline: none;
        }
        .submit-btn {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .submit-btn:hover {
            background-color: #45a049;
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
                    <h1>Emergency Contacts</h1>
                    <div class="date">
                        <?php echo date("d/m/y"); ?>
                    </div>
                </div>

               

            </div>
            <!-- top section end -->
            <div class="content">
                <div class="form-container">
                    <h2>Emergency Contact Form</h2>
                    <form action="#" method="post">
                        <!-- Service Field -->
                        <div class="form-group">
                            <label for="service">Service:</label>
                            <input type="text" id="service" name="service"
                            value="<?php echo $listRecord['service'] ?>" required>
                        </div>

                        <!-- Address Field -->
                        <!-- <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="text" id="address" name="address" placeholder="Enter address" required>
                        </div> -->

                        <!-- Contact Field -->
                        <div class="form-group">
                            <label for="contact">Contact:</label>
                            <input type="tel" id="contact" name="contact" value="<?php echo $listRecord['contact'] ?>" required>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="submit-btn">Submit</button>
                    </form>
                </div>









            </div>
            <!-- content end -->
        </main>

        <!-- main area end -->




    </div>
    <!-- container -->
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Search Functionality -->
    <script>
        function searchTable() {
            const input = document.getElementById("searchInput").value.toLowerCase();
            const tables = document.querySelectorAll(".table tbody");

            tables.forEach(table => {
                const rows = table.getElementsByTagName("tr");
                for (let i = 0; i < rows.length; i++) {
                    const rowText = rows[i].textContent.toLowerCase();
                    if (rowText.includes(input)) {
                        rows[i].style.display = "";
                    } else {
                        rows[i].style.display = "none";
                    }
                }
            });
        }

        function toggleDropdown() {
            var dropdownContent = document.getElementById("myDropdown");
            dropdownContent.classList.toggle("show");
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function (event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
</body>

</html>