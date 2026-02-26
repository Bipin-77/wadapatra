<?php
require_once '../config/Database.php';
// session_start();
// if (!isset($_SESSION['username']) && !isset($_SESSION['is_admin'])) {
//     header("Location:login.php");
// }
$db = new Database();
$conn = $db->getConnection();


// if ($_POST){
if (isset($_POST['name'])) {
    
    include_once "classes/User.php";
    $user = new User();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       
        if (
            isset($_FILES["image"]) &&
            $_FILES["image"]["error"] == UPLOAD_ERR_OK
        ) {
            
              // Add name of upload directory
            $uploadDirectory = "./images/";
            $filename = $_FILES["image"]["name"];
            if (move_uploaded_file(
                $_FILES["image"]["tmp_name"],
                $uploadDirectory . $filename
                )){
                    
                    $cerated = $user->addEvents($_POST, $filename);
                    if ($cerated) {
                    header("Location:events.php");
                    } else {
                    echo "try again";
                    }

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
    <link rel="stylesheet" href="assets/css/eventstyle.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events </title>
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
                    <h1>Dashboard</h1>
                    <div class="date">
                        <?php echo date("d/m/y"); ?>
                    </div>
                </div>

               

            </div>
            <!-- top section end -->
            <div class="content">

                <div class="form-container">
                    <h2>Event Form</h2>
                    <form action="" method="post" enctype="multipart/form-data">
                        <!-- Event Name -->
                        <div class="form-group">
                            <label for="event_name">Event Name:</label>
                            <input type="text" id="event_name" name="name" placeholder="Enter event name"
                                required>
                        </div>

                        <!-- Event Date -->
                        <div class="form-group">
                            <label for="event_date">Event Date:</label>
                            <input type="date" id="event_date" name="date" required>
                        </div>

                        <!-- Description -->
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea id="description" class="description" name="description" placeholder="Enter event description" 
                                required ></textarea>
                        </div>

                        <!-- Upload Image -->
                        <div class="form-group">
                            <label for="image">Upload Image:</label>
                            <input type="file" id="image" name="image" accept="image/*" required>
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
        
        <!-- right end -->



    </div>
    <!-- container -->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        let today = new Date();
        let minDate = new Date();
        minDate.setDate(today.getDate() ); // Set minimum date to tomorrow
        let maxDate = new Date();
        maxDate.setDate(today.getDate() + 30); // Set maximum date to 30 days from today

        let formattedMinDate = minDate.toISOString().split('T')[0];
        let formattedMaxDate = maxDate.toISOString().split('T')[0];

        let eventDateInput = document.getElementById("event_date");
        eventDateInput.setAttribute("min", formattedMinDate);
        eventDateInput.setAttribute("max", formattedMaxDate);
    });
</script>
</body>

</html>