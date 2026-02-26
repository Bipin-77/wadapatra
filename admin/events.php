<?php
// session_start();
// if (!isset($_SESSION['username']) && !isset($_SESSION['is_admin'])) {
//     header("Location:index.php");
// }

require 'classes/User.php';
$informations = new User();

$listsEvents = $informations->listEvents();
$listsNotices = $informations->listNotices();
if(isset($_GET['search'])){
    $listsEvents = $informations->searchEvents($_GET);
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
                    <h1>Events</h1>
                    <div class="date">
                        <?php echo date("d/m/y"); ?>
                    </div>
                </div>

               

            </div>
            <!-- top section end -->
            <div class="content">


                <div class="top">
                    <!-- search form -->
                    <div class="search">
                        <form action="" method="get">
                            <input type="text" name="search" id="">
                            <button type="submit"><span class="material-symbols-sharp">search </span></button>

                        </form>
                    </div>
                    <a href="eventsadd.php">
                        <span class="material-symbols-sharp">add </span>
                        <h3>Events</h3>
                    </a>

                    
                </div>

                <div class="events">


                    <!-- Event Card 1 -->
                    <?php
                    $i = 1;
                    foreach ($listsEvents as $listEvent) {

                        ?>
                    <div class="card">
                        <img src="./images/<?php echo $listEvent['image'];?>" alt="Event Image">
                        <div class="card-content">
                            <h2><?php echo $listEvent['name']; ?></h2>
                            <span class="date">Date:<?php echo $listEvent['date']; ?></span>
                            <!-- <span class="category">Entertainment</span> -->
                            <p> <?php echo $listEvent['description']; ?></p><br>
                            <a href="eventsupdate.php?id=<?php echo $listEvent['id']; ?>">Edit</a> &nbsp;&nbsp;&nbsp;
                            <a href="eventsdelete.php?id=<?php echo $listEvent['id']; ?>"
                                            onclick="return confirm('Are you sure want to delete this record?');">
                                            Delete</a>
                        </div>
                       
                    </div>
                    <?php $i++;
                    } ?>

                    <!-- Event Card 2 -->
                   
                    <!-- Event Card 3 -->
                    
                    
                    <!-- Event Card 4 -->
                    
                </div>

                <!-- Notices Section -->
                


               
            </div>

            <!-- content end -->

        </main>

        <!-- main area end -->
        <!-- start right -->

        <!-- right end -->



    </div>
    <!-- container -->
</body>

</html>