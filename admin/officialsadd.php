<?php
require_once '../config/Database.php';
// session_start();
// if (!isset($_SESSION['username']) && !isset($_SESSION['is_admin'])) {
//     header("Location:index.php");
// }


// if ($_POST){
if (isset($_POST['name'])) {
    include_once "classes/Officials.php";
    $user = new Officials();
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
                    
                    $cerated = $user->addOfficials($_POST, $filename);
                    if ($cerated) {
                        header("Location:officials.php");
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
    <link rel="stylesheet" href="assets/css/userstyle.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin </title>
    <style>
        form {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }


        input[type="text"],
        input[type="number"],
        input[type="file"],
        input[type="date"],
        textarea,
        select  {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
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
                    <h1>Add officials</h1>
                    <div class="date">
                        <?php echo date("d/m/y"); ?>
                    </div>
                </div>

                

            </div>
            <!-- top section end -->
            <div class="content">
                <div class="form-container">
                    <!-- <div class="close-btn">
                        <button class="close-btn" onclick="closeForm()"><span class="material-symbols-sharp">close
                            </span></button>


                    </div> -->
                    <h2> Add Officials details</h2>

                    <form action="#" method="post" enctype="multipart/form-data">
                        <div>
                            <label for="budgetTitle">Name of Officials:</label>
                            <input type="text" id="budgetTitle" name="name" required>
                        </div>

                        <div>
                            <label for="area">Post:</label>
                            <input type="text" id="area" name="post" required>
                        </div>

                       

                        <div>
                            <label for="startDate">Elected Date:</label>
                            <input type="date" id="elected_date" name="elected_date" required>
                        </div>

                        <div>
                            <label for="endDate">End Date:</label>
                            <input type="date" id="end_date" name="end_date" required>
                        </div>

                        

                        <div>
                            <label for="description">Description:</label>
                            <textarea id="description" name="details" rows="4" required></textarea>
                        </div>
                        <div >
                            <label for="image">Upload Image:</label>
                            <input type="file" id="image" name="image" accept="image/*" required>
                        </div>

                        <div>
                            <input type="submit" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
            <!-- content end -->

        </main>

       




    </div>
    <!-- container -->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        let today = new Date();
        let minElectedDate = new Date();
        minElectedDate.setDate(today.getDate() - 30); // Set min to 30 days before today

        let formattedMinElectedDate = minElectedDate.toISOString().split('T')[0];
        let formattedMaxElectedDate = today.toISOString().split('T')[0]; // Max is today

        let electedDateInput = document.getElementById("elected_date");
        let endDateInput = document.getElementById("end_date");

        // Set the min and max date for elected_date
        electedDateInput.setAttribute("min", formattedMinElectedDate);
        electedDateInput.setAttribute("max", formattedMaxElectedDate);

        electedDateInput.addEventListener("change", function() {
            if (electedDateInput.value) {
                let electedDate = new Date(electedDateInput.value);
                let endDate = new Date(electedDate);
                endDate.setFullYear(endDate.getFullYear() + 5); // Add 5 years
                
                let formattedEndDate = endDate.toISOString().split('T')[0];

                endDateInput.value = formattedEndDate; // Auto-fill the end date
                endDateInput.setAttribute("min", formattedEndDate);
                endDateInput.setAttribute("max", formattedEndDate);
            }
        });
    });
</script>
</body>

</html>