<?php
include_once "classes/User.php";
$user=new User();
$totoalusers=$user->getTotalUser();
$totoalevents=$user->getTotalEvents();
$totoalnotices=$user->getTotalNotices();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="assets/css/adminstyle.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard </title>
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
                <div class="overview">
                    <!-- card 1 -->
                    <div class="users">
                        <span class="material-symbols-sharp">person </span>
                        <div class="items">
                            <div class="left">
                            <h3>total users</h3>
                            <h2><?php echo $totoalusers;?></h2>
                            </div>
                            <div class="progress">
                                <svg>
                                    <circle r="30" cy="40" cx="40" ></circle> 
                                </svg>
                                <div class="number"><?php echo $totoalusers;?>%</div>
                            </div>
                        </div>
                    </div>
                    <!-- card1 end -->

                    <!-- card 2 -->
                    <div class="events">
                        <span class="material-symbols-sharp">celebration </span>
                        <div class="items">
                            <div class="left">
                            <h3>total Events</h3>
                            <h2><?php echo $totoalevents;?></h2>
                            </div>
                            <div class="progress">
                                <svg>
                                    <circle r="30" cy="40" cx="40" ></circle> 
                                </svg>
                                <div class="number"><?php echo $totoalevents;?>%</div>
                            </div>
                        </div>
                    </div>
                    <!-- card1 end -->

                    <!-- card 3 -->
                    <div class="notices">
                        <span class="material-symbols-sharp"> info</span>
                        <div class="items">
                            <div class="left">
                            <h3>total Noticess</h3>
                            <h2><?php echo $totoalnotices;?></h2>
                            </div>
                            <div class="progress">
                                <svg>
                                    <circle r="30" cy="40" cx="40" ></circle> 
                                </svg>
                                <div class="number"><?php echo $totoalnotices;?>%</div>
                            </div>
                        </div>
                    </div>
                    <!-- card1 end -->
                      <!-- card 1 -->
                    <!-- <div class="polls">
                        <span class="material-symbols-sharp">ballot </span>
                        <div class="items">
                            <div class="left">
                            <h3>total polls</h3>
                            <h2>42</h2>
                            </div>
                            <div class="progress">
                                <svg>
                                    <circle r="30" cy="40" cx="40" ></circle> 
                                </svg>
                                <div class="number">75%</div>
                            </div>
                        </div>
                    </div> -->
                    <!-- card1 end -->

                </div>
                <!-- overview end -->


            </div>

        </main>

        <!-- main area end -->
        <!-- start right -->

        <!-- end right -->

    </div>
    <!-- container end -->
<!-- script for mobile responsive sidebar -->
     <script src="includes/script.js"></script>
</body>

</html>