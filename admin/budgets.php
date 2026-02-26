<?php


require 'classes/Budget.php';
$informations = new Budget();

$lists = $informations->listBudget();
 if(isset($_GET['search'])){
     $lists = $informations->searchBudget($_GET);
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
    <title>Admin Dashboard </title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
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
                    <h1>Budgets</h1>
                    <div class="date">
                        <?php echo date("d/m/y"); ?>
                    </div>
                </div>

               

            </div>
            <!-- top section end -->
            <!-- content stsrt -->
            <div class="content">

                <div class="top">
                    <!-- search form -->
                    <div class="search">
                        <form action="" method="get">
                        <input type="text" name="search" id="">
                        <button type="submit"><span class="material-symbols-sharp">search </span></button>
                        
                        </form>
                    </div>
                    <div class="buttons">
                    <a href="budgetsadd.php">
                        <span class="material-symbols-sharp">add </span>
                        <h3>Budget</h3>
                    </a>

                    

                    </div>
                    
                </div>
                <!-- top end -->
                <div class="users">
                    <div class="listUsers">
                        <table style="width: 100%;">
                            <tr>
                                <th>sn</th>
                                <th> Budget Title</th>
                                <th>Area</th>
                                <th>Sector</th>

                                <th>Total Budget</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                
                                <th>Progress (%)
                                </th>
                                <th>Edit | Delete</th>

                            </tr>

                            <?php
                            $i = 1;
                            foreach ($lists as $list) {
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $list['name']; ?></td>
                                    <td><?php echo $list['area']; ?></td>

                                    <td><?php echo $list['sector']; ?></td>

                                    <td><?php echo $list['budget']; ?></td>
                                    <td><?php echo $list['start']; ?></td>
                                    <td><?php echo $list['end']; ?></td>
                                    
                                    <td><?php echo $list['progress']; ?></td>


                                    <td>
                                        <a href="budgetsupdate.php?id=<?php echo $list['id']; ?>">Edit</a>
                                        |
                                        <a href="budgetsdelete.php?id=<?php echo $list['id']; ?>"
                                            onclick="return confirm('Are you sure want to delete this record?');">
                                            Delete</a>
                                    </td>
                                </tr>
                                <?php $i++;
                            } ?>
                        </table>

                </div>
                    <!-- lisst user end -->
            </div>
        </main>

        <!-- main area end -->
        <!-- start right -->

        <!-- top end -->
















        <!-- end right -->

    </div>
    <!-- container -->
</body>

</html>