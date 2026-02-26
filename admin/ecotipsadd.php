<?php


require 'classes/Waste.php';
$informations = new Waste();



if (isset($_POST['name'])) {
    
    $cerated = $informations->addEcoTips($_POST);
    if ($cerated) {
        header("Location:ecotracker.php");
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

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin </title>
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
        .form-group input[type="time"],
        .form-group input[type="number"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-group input[type="text"]:focus,
        .form-group input[type="number"]:focus {
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
                    <h1>Add Schedule</h1>
                    <div class="date">
                        <?php echo date("d/m/y"); ?>
                    </div>
                </div>

               

            </div>
            <!-- top section end -->
            <!-- content area start -->
            <div class="content">
            <div class="form-container">
                    <h2>Waste tips Form</h2>
                    <form action="" method="post" >
                        <!-- Event Name -->
                        <div class="form-group">
                            <label for="event_name">Enter Tip:</label>
                            <input type="text" id="event_name" name="name" placeholder="Enter a tip "
                                required>
                        </div>

                       
                       

                        <!-- Submit Button -->
                        <button type="submit" class="submit-btn">Submit</button>
                    </form>
                </div>



            </div>

            <!-- content sec end -->

        </main>

        <!-- main area end -->
        <!-- start right -->

        <!-- right end -->



    </div>
    <!-- container -->
</body>

</html>