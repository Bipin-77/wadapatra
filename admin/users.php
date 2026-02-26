<?php
// session_start();
//  if (!isset($_SESSION['username']) && !isset($_SESSION['is_admin'])) {
//      header("Location:index.php");
// }

require 'classes/User.php';
$informations = new User();

$lists = $informations->listUser();
 if(isset($_GET['search'])){
     $lists = $informations->searchUser($_GET);
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
                    <h1>Users</h1>
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
                    <a href="usersadd.php">
                        <span class="material-symbols-sharp">person_add </span>
                        <h3>Add users</h3>
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
                                <th>userName</th>
                                <th>Email</th>

                                <th>Role</th>
                                <th>Address</th>
                                <th>Edit | Delete</th>

                            </tr>

                            <?php
                            $i = 1;
                            foreach ($lists as $list) {
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $list['name']; ?></td>
                                    <td><?php echo $list['username']; ?></td>

                                    <td><?php echo $list['email']; ?></td>

                                    <td><?php echo $list['role']; ?></td>
                                    <td><?php echo $list['address']; ?></td>


                                    <td>
                                        <a href="userupdate.php?id=<?php echo $list['id']; ?>">Edit</a>
                                        |
                                        <a href="usersdelete.php?id=<?php echo $list['id']; ?>"
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
