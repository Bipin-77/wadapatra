<?php
// session_start();
// if (!isset($_SESSION['username']) && !isset($_SESSION['is_admin'])) {
//     header("Location:index.php");
// }
require_once 'includes/sidebar.php';
require 'classes/Emergency.php';
$informations = new Emergency();

$listsbasic = $informations->listBasic();
$listsprivate = $informations->listPrivate();
if(isset($_GET['search'])){
    $listsEvents = $informations->search($_GET);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="assets/css/adminstyle.css">
     <!-- Bootstrap CSS -->
     <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emergency contacts </title>
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .emergency-container {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin: 2rem 3rem;
        }

        .emergency-container .top {
            width: 100%;
            display: flex;
            justify-content: space-between;
        }

        h2 {
            color: #000;
            font-weight: bold;
            margin-bottom: 1.5rem;
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
            background-color:rgb(49, 179, 142);
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .search-bar button:hover {
            background-color: #0b5ed7;
        }

        .table {
            margin-bottom: 2rem;
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
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

        .service-type-heading {
            background-color: #6ca6cd;
            color: #fff;
            font-weight: bold;
            padding: 0.5rem 1rem;
            margin-top: 1rem;
            border-radius: 5px;
        }

        /* dropdown styling add button */
/* Dropdown Button */
.dropbtn {
    background-color:rgb(154, 240, 157);
    color: white;
    padding: 10px;
    font-size: 16px;
    border: none;
    cursor: pointer;
}

/* Dropdown button on hover & focus */
.dropbtn:hover, .dropbtn:focus {
    background-color: #3e8e41;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
    position: relative;
    display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

/* Buttons inside the dropdown */
.dropdown-item {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    width: 100%;
    text-align: left;
    border: none;
    background: none;
    cursor: pointer;
}

/* Change color of dropdown buttons on hover */
.dropdown-item:hover {
    background-color: #ddd;
}

/* Show the dropdown menu (use JS to add this class when the user clicks on the dropdown button) */
.show {
    display: block;
}
.dropdown-content a{
    color: black;
    text-decoration: none;
}
        /* end ad button */
    </style>
</head>

<body>
    <div class="container">
        <!-- aside section start -->

        <div class="left">
            <?php
            
                ?>

        </div>


        <!-- aside end -->

        <!-- main area start -->
        <main class="main">
            <div class="topsection">
                <div class="leftsection">
                    <h1>Emergency Contacts</h1>
                    <div class="date">
                        <?php echo date("d/m/y"); ?>
                    </div>
                </div>

              

            </div>
            <!-- top section end -->
            <div class="content">
                <div class="emergency-container">
                    <h2>Emergency Contacts in Nepal</h2>

                    <div class="top">


                        <!-- Search Bar -->
                        <div class="search-bar">
                            <input type="text" id="searchInput" placeholder="Search for services or contacts...">
                            <button onclick="searchTable()">Search</button>
                        </div>

                        <div class="add">

                            <button onclick="toggleDropdown()" class="dropbtn">Add</button>
                            <div id="myDropdown" class="dropdown-content">
                                <a href="embasicadd.php">
                                    <button class="dropdown-item">Basic</button>
                                </a>
                                <a href="emprivateadd.php">
                                    <button class="dropdown-item">Private</button>
                                </a>
                            </div>



                        </div>
                    </div>
                    <div class="emergency">
                        <!-- Table 1: Basic Emergency Contacts -->
                        <h3>Basic Emergency Contacts</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>sn</th>
                                    <th>Service Type</th>
                                    <th>Contact Number</th>
                                    <th>Edit | delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <?php
                            $i = 1;
                            foreach ($listsbasic as $list) {
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $list['service']; ?></td>
                                    <td><?php echo $list['contact']; ?></td>


                                    <td>
                                        <a href="embasicupdate.php?id=<?php echo $list['id']; ?>">Edit</a>
                                        |
                                        <a href="embasicdelete.php?id=<?php echo $list['id']; ?>"
                                            onclick="return confirm('Are you sure want to delete this record?');">
                                            Delete</a>
                                    </td>
                                </tr>
                                <?php $i++;
                            } ?>
                               
                               
                               
                              
                            </tbody>
                        </table>

                        <!-- Table 2: Private Emergency Contacts -->
                        <h3>Private Emergency Contacts</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                
                                    <th>Service Type</th>
                                    <th>Address</th>
                                    <th>Contact Number</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Blood Banks -->
                               
                                <tr>
                                <?php
                            $i = 1;
                            foreach ($listsprivate as $listP) {
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $listP['service']; ?></td>
                                    <td><?php echo $listP['address']; ?></td>
                                    <td><?php echo $listP['contact']; ?></td>

                                    


                                    <td>
                                        <a href="emprivateupdate.php?id=<?php echo $list['id']; ?>">Edit</a>
                                        |
                                        <a href="emprivatedelete.php?id=<?php echo $list['id']; ?>"
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




            </div>
            <!-- content end -->
        </main>

        <!-- main area end -->




    </div>
    <!-- container -->
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Search Functionality -->
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

        function toggleDropdown() {
            var dropdownContent = document.getElementById("myDropdown");
            dropdownContent.classList.toggle("show");
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function (event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
</body>

</html>