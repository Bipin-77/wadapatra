<?php
// session_start();
// if (!isset($_SESSION['username']) && !isset($_SESSION['is_admin'])) {
//     header("Location:index.php");
// }

require 'classes/User.php';
$informations = new User();

$listsNotices = $informations->listNotices();
if (isset($_GET['search'])) {
    $searchNotices = $informations->searchNotices($_GET);
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
    <title>Notices </title>
    <style>
        main .top {
            display: flex;
            background-color: rgb(222, 236, 231);
            margin-bottom: 1rem;
            justify-content: right;
        }

        .search-bar {
            margin-bottom: 2rem;
            display: flex;
        }

        .search-bar input {
            border-radius: 5px;
            border: 1px solid #ced4da;
            padding: 0.5rem 1rem;
            width: 70%;
            margin-right: 0.5rem;
        }

        .search-bar button {
            border-radius: 5px;
            padding: 0.5rem 1rem;
            background-color: rgb(49, 179, 142);
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .search-bar button:hover {
            background-color: #0b5ed7;
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

        /* Custom CSS for notices */
        .notice-container {
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        .notice-card {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .notice-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .notice-title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .notice-subject {
            font-size: 18px;
            color: #555;
            margin-bottom: 10px;
        }

        .notice-description {
            font-size: 16px;
            color: #777;
            margin-bottom: 10px;
        }

        .notice-date {
            font-size: 14px;
            color: #999;
            text-align: right;
        }

        .search-bar {
            margin-bottom: 20px;
        }

        .pagination {
            justify-content: center;
            margin-top: 20px;
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
                    <h1> Public Notices</h1>
                    <div class="date">
                        <?php echo date("d/m/y"); ?>
                    </div>
                </div>



            </div>
            <!-- top section end -->
            <div class="content">


                <div class="top">
                    <!-- search form -->

                    <div class="search-bar">
                        <input type="text" id="searchInput" name="search" placeholder="Search for notices " >
                        <button type="submit"><span class="material-symbols-sharp">search </span></button>
                        </div>
                

                    <a href="noticesadd.php" target="">
                        <span class="material-symbols-sharp">add </span>
                        <h3>Notices</h3>
                    </a>

                </div>
                <!-- Notices Section -->
                <?php
                $i = 1;
                foreach ($listsNotices as $listNotice) {

                    ?>

                    <div id="notices-list">
                        <!-- Notice 1 -->
                        <div class="notice-card">
                            <div class="notice-title"> <?php  echo $listNotice['name']; ?></div>
                            <div class="notice-subject"></div>
                            <div class="notice-description">
                                <?php echo $listNotice['description']; ?>

                            </div>
                            <div class="notice-date">
                                <i class="fas fa-calendar-alt me-2"></i><?php    echo $listNotice['date']; ?>
                            </div>
                            <div class="action">
                            <a href="noticesupdate.php?id=<?php echo $listNotice['id']; ?>">Edit</a> &nbsp;&nbsp;&nbsp;
                            <a href="noticesdelete.php?id=<?php echo $listNotice['id']; ?>"
                                            onclick="return confirm('Are you sure want to delete this record?');">
                                            Delete</a>
                            </div>
                        </div>
                    </div>
                    <?php $i++;
                } ?>
               


                


                <!-- content end -->

        </main>

        <!-- main area end -->
        <!-- start right -->

        <!-- right end -->



    </div>
    <!-- container -->
</body>

</html>