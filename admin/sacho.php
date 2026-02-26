<?php
session_start();
if (!isset($_SESSION['username']) && !isset($_SESSION['is_admin'])) {
    header("Location:index.php");
}

require 'classes/waste.php';
$informations = new Waste();


if (isset($_GET['search'])) {
    $lists = $informations->search($_GET);
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
                    <h1>EcoTracker</h1>
                    <div class="date">
                        <?php echo date("d/m/y"); ?>
                    </div>
                </div>

               

            </div>
            <!-- top section end -->
            <!-- content area start -->
            <div class="content">


            </div>

            <!-- content sec end -->

        </main>

        <!-- main area end -->
        <!-- start right -->

        <!-- right end -->



    </div>
    <!-- container -->
    echo "<pre>";print_r($listsProfile); echo"</pre>"; exit;
</body>

</html>