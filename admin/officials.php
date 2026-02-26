<?php
// session_start();
//  if (!isset($_SESSION['username']) && !isset($_SESSION['is_admin'])) {
//      header("Location:index.php");
// }

require 'classes/Officials.php';
$informations = new Officials();

$lists = $informations->listOfficials();
 if(isset($_GET['search'])){
     $lists = $informations->searchOfficials($_GET);
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
    <title>Admin Dashboard </title>
    <style>

main .top {
            display: flex;
            background-color: rgb(222, 236, 231);
            margin-bottom: 1rem;
            justify-content: space-around;

        }

        main .top .search span {
            margin-top: 2px;


        }


        main .top a {
            display: flex;
            margin-left: 2rem;
            gap: 2px;
            align-items: center;
            height: 3.2rem;
            transition: all .1sec ease-in;
            color: rgb(21, 23, 21);
        }

        /* search box */
        .search button {
            width: 40px;
            padding: 10px;
            background-color: #28a745;
            border: none;
            border-radius: 15px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;

        }

        .search input {
            width: 80%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 15px;
            font-size: 16px;
            margin-bottom: 2px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
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
                    <h1>Officials</h1>
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
                    <a href="officialsadd.php">
                        <span class="material-symbols-sharp">person_add </span>
                        <h3>Add </h3>
                    </a>

                    

                    </div>
                    
                </div>
                <!-- top end -->
                <div class="users">
                    <div class="listUsers">
                        <table style="width: 100%;">
                            <tr>
                                <th>sn</th>
                                <th>Name</th>
                                <th>Post</th>
                                <th>Tenure</th>
                                <th>Details</th>

                                <th>Edit | Delete</th>

                            </tr>

                            <?php
                            $i = 1;
                            foreach ($lists as $list) {
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $list['name']; ?></td>
                                    <td><?php echo $list['post']; ?></td>

                                    <td><?php echo $list['elected_date']; echo" To "; echo $list['end_date'] ;?></td>

                                    <td><?php echo $list['details']; ?></td>
                                    


                                    <td>
                                        <a href="officialsupdate.php?id=<?php echo $list['id']; ?>">Edit</a>
                                        |
                                        <a href="officialsdelete.php?id=<?php echo $list['id']; ?>"
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
