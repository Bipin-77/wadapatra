<?php

require 'classes/waste.php';
$informations = new Waste();

$lists = $informations->listEco();
$listsecoNotices= $informations->listEcoNotice();
$listsecoTips= $informations->listecoTips();
//  if(isset($_GET['search'])){
//      $lists = $informations->searchSchedule($_GET);
// }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="assets/css/adminstyle.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eco Tracker </title>
    <style>
        .content .top {

            display: flex;
            justify-content: space-around;

            background-color: rgb(153, 233, 217);
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);

        }
        .content .top .add  {
            display: flex;
            margin-left: 2rem;
            gap: 2px;
            align-items: center;
            height: 3.2rem;
        }
        .content .top .add a {
            display: flex;
            margin-left: 2rem;
            gap: 2px;
            align-items: center;
            height: 3.2rem;
        }

        .search-bar {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #fff;
            border-radius: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 0.5rem 1rem;
            width: 100%;
            max-width: 500px;
            height: 40px;
            margin-top: 5px;
        }

        .search-bar input {
            border: none;
            outline: none;
            flex: 1;
            padding: 0.5rem;
            font-size: 1rem;
            background: transparent;
        }

        .content .eco {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin: 2rem 3rem;
        }

        .table {
            margin-bottom: 2rem;
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .table thead {
            background-color: rgb(205, 216, 234);
            color: #fff;
        }

        .table th,
        .table td {
            padding: 1rem;
            text-align: left;
            color: #444;
            /* Soft dark gray for table text */
        }

        .table tbody tr:nth-child(odd) {
            background-color: #f8f9fa;
        }

        .table tbody tr:hover {
            background-color: #e9ecef;
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
                    <h1>EcoTracker</h1>
                    <div class="date">
                        <?php echo date("d/m/y"); ?>
                    </div>
                </div>

               

            </div>
            <!-- top section end -->
            <!-- content area start -->
            <div class="content">
                <div class="top">
                    <!-- Search Bar -->
                    <div class="search-bar">
                    <input type="text" id="searchInput" placeholder="Search for services or contacts...">
                    <button onclick="searchTable()"><span class="material-symbols-sharp">search</span></button>
                        
                    </div>
                    <!-- <form action="" method="get">
                        <input type="text" name="search" id="">
                        <button type="submit"><span class="material-symbols-sharp">search </span></button>
                        
                        </form> -->

                    <div class="add">
                        <a href="ecoadd.php">
                            <span class="material-symbols-sharp">add </span>
                            <h3>schedule</h3>
                        </a>

                        <a href="econoticesadd.php">
                            <span class="material-symbols-sharp">add </span>
                            <h3>Notices</h3>
                        </a>

                        <a href="ecotipsadd.php">
                            <span class="material-symbols-sharp">add </span>
                            <h3>tips</h3>
                        </a>

                    </div>
                </div>
                <!-- top end -->
                <div class="eco">
                    <h2 id="waste-schedule">Waste Collection Schedule</h2>
                    <div class="ecoschedule">
                        <table class="table">
                            <thead>
                                <th>Sn</th>
                                <th>Area</th>
                                <th>Day</th>
                                <th>Time</th>
                                <th>Fee</th>
                                <th>Edit | Delete</th>
                            </thead>
                            <tbody>
                                <tr>
                                <?php
                            $i = 1;
                            foreach ($lists as $list) {
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $list['area']; ?></td>
                                    <td><?php echo $list['day']; ?></td>

                                    <td><?php echo $list['start']; echo "-"; echo $list['end'];?></td>

                                    <td><?php echo $list['fee']; ?></td>
                                    


                                    <td>
                                        <a href="ecoupdate.php?id=<?php echo $list['id']; ?>">Edit</a>
                                        |
                                        <a href="ecodelete.php?id=<?php echo $list['id']; ?>"
                                            onclick="return confirm('Are you sure want to delete this record?');">
                                            Delete</a>
                                    </td>
                                </tr>
                                <?php $i++;
                            } ?>

                            </tbody>
                        </table>

                    </div>
                    <!-- ecoshedule end -->
                    <h2 id="waste-schedule">Important Notices</h2>
                    <div class="econotice">
                        <div class="scrollable-table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Notice</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <?php
                            $i = 1;
                            foreach ($listsecoNotices as $listN) {
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $listN['name']; ?></td>
                                   
                                    


                                    <td>
                                        <a href="econoticesupdate.php?id=<?php echo $listN['id']; ?>">Edit</a>
                                        |
                                        <a href="econoticesdelete.php?id=<?php echo $listN['id']; ?>"
                                            onclick="return confirm('Are you sure want to delete this record?');">
                                            Delete</a>
                                    </td>
                                </tr>
                                <?php $i++;
                            } ?>

                                </tbody>
                            </table>
                        </div>

                    </div>
                    <!-- econotice end -->
                    <div class="ecotips">
                        <h2 id="eco-tips">Eco Tips</h2>
                        <div class="scrollable-table">
                            <table class="table">
                                <thead>
                                    <tr>

                                        <th>S.N</th>
                                        <th>Tip</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    
                                    <?php
                            $i = 1;
                            foreach ($listsecoTips as $listTip) {
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $listTip['name']; ?></td>
                                   
                                    


                                    <td>
                                        <a href="ecotipsupdate.php?id=<?php echo $listTip['id']; ?>">Edit</a>
                                        |
                                        <a href="ecotipsdelete.php?id=<?php echo $listTip['id']; ?>"
                                            onclick="return confirm('Are you sure want to delete this record?');">
                                            Delete</a>
                                    </td>
                                </tr>
                                <?php $i++;
                            } ?>
                                    <!-- Add more rows as needed -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <!-- ecotips end -->




            </div>

    </div>

    <!-- content sec end -->

    </main>

    <!-- main area end -->
    <!-- start right -->

    <!-- right end -->



    </div>
    <!-- container -->
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
     </script>
</body>

</html>