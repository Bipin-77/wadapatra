
<?php
 include 'onavbar.php';


require 'classes/Users.php';
$informations = new Users();

$listsbasic = $informations->listBasic();
$listsprivate = $informations->listPrivate();


?>
<!doctype html>
<html lang="en">

<!-- Include the navbar -->
<?php ?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Emergency Contacts - Nagarik Wodapatra</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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

        h2 {
            color: #000;
            font-weight: bold;
            margin-bottom: 1.5rem;
        }

        .search-bar {
            margin-bottom: 2rem;
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
            background-color: #0d6efd;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .search-bar button:hover {
            background-color: #0b5ed7;
        }

        .table {
            margin-bottom: 2rem;
        }

        .table thead {
            background-color: #0d6efd;
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
    </style>
</head>

<body>
    <div class="emergency-container">
        <h2>Emergency Contacts in Nepal</h2>

        <!-- Search Bar -->
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search for services or contacts...">
            <button onclick="searchTable()">Search</button>
        </div>

        <!-- Table 1: Basic Emergency Contacts -->
        <h3>Basic Emergency Contacts</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Service Type</th>
                    <th>Contact Number</th>
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
                    <th>ID</th>
                    <th>Service Type</th>
                    <th>Address</th>
                    <th>Contact Number</th>
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

                                    


                                    
                                </tr>
                                <?php $i++;
                            } ?>
               

              
                    
           
            </tbody>
        </table>
    </div>

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
    </script>

    <footer
        style="background-color: #17a2b8; color: #fff; text-align: center; padding: 15px; font-size: 16px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 3rem 3rem 1rem; border-radius: 10px; box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.2);">
        <p style="margin: 0;">Developed by <span style="font-weight: bold; color: #0022ff;">Bipin Bohara</span> |
            &copy; 2026 | Contact Us: <a href="mailto:bibekmishra@gmail.com"
                style="color: #4b1afd; text-decoration: none; font-weight: bold;">bipinbohara2@gmail.com</a> | Phone: <a
                href="tel:9708077117" style="color: #fff; text-decoration: none; font-weight: bold;">9708077117
                (bipin)</a></p>
    </footer>
</body>

</html>