<?php
// session_start();
//  if (!isset($_SESSION['username']) && !isset($_SESSION['is_admin'])) {
//      header("Location:index.php");
// }

require 'classes/User.php';
$informations = new User();

$lists = $informations->listMessages();
 if(isset($_GET['search'])){
     $lists = $informations->searchMessages($_GET);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@24,400,0,0" />
<link rel="stylesheet" href="assets/css/adminstyle.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages </title>
    <style>
        main .top{
    display: flex;
    background-color: rgb(222, 236, 231);
    margin-bottom: 1rem;
   
}
main .top .search span{
    margin-top: 2px;
   
    
}


main .top a{
    display: flex;
    margin-left: 2rem;
    gap: 2px;
    align-items: center;
    height: 3.2rem;
    transition: all .1sec ease-in;
    color: rgb(21, 23, 21);
} 
/* search box */
.search button{
    width: 40px;
    padding: 10px;
    background-color: #28a745;
    border: none;
    border-radius: 15px;
    color: #fff;
    font-size: 16px;
    cursor: pointer;

}
.search input{
    width: 80%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 15px;
    font-size: 16px;
    margin-bottom: 2px;
}
.table {
            margin-bottom: 2rem;
            width: 100%;
        }

        .table thead {
            background-color:rgb(138, 181, 245);
            color: #fff;
        }

        .table th,
        .table td {
            padding: 1rem;
            text-align: left;
            color: #000;
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
                    <h1>Messages</h1>
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
                    <!-- <div class="buttons">
                        <a href="usersadd.php">
                            <span class="material-symbols-sharp">person_add </span>
                            <h3>Add users</h3>
                        </a>



                    </div> -->

                </div>
                <!-- top end -->
                <div class="users">
                    <div class="listUsers">
                        <table style="width: 100%;" class="table">
                            <thead>
                            <tr>
                                <th>sn</th>
                                <th>Name</th>
                                
                                <th>Email</th>
                                <th>address</th>

                                <th>ward</th>
                                <th>tole</th>
                                <th>Query</th>
                                <th>Details</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $i = 1;
                            foreach ($lists as $list) {
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $list['name']; ?></td>
                                   

                                    <td><?php echo $list['email']; ?></td>
                                    <td><?php echo $list['address']; ?></td>

                                    <td><?php echo $list['ward']; ?></td>
                                    <td><?php echo $list['tole']; ?></td>
                                    <td><?php echo $list['query']; ?></td>
                                    <td><?php echo $list['details']; ?></td>


                                    <td>
                                        <a href="messageInsert.php?id=<?php echo $list['email']; ?>">Seen</a>
                                        |
                                        <a href="messagedelete.php?id=<?php echo $list['email']; ?>"
                                            onclick="return confirm('Are you sure want to delete this record?');">
                                            Delete</a>
                                    </td>
                                </tr>
                                <?php $i++;
                            } ?>
                            </tbody>
                        </table>

                    </div>
                    <!-- lisst user end -->
                </div>

         </main>

          <!-- main area end -->
           <!-- start right -->
         
            <!-- right end -->

       

    </div>
    <!-- container -->
</body>
</html>