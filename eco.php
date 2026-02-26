
 <!-- Include the navbar -->
 <?php 
  
  include 'onavbar.php';
 require 'classes/Users.php';
 $informations = new Users();
 
 $lists = $informations->listEco();
 $listsecoNotices= $informations->listEcoNotice();
 $listsecoTips= $informations->listecoTips();
 
 
 ?>
 
 <!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eco Tracker </title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #444; /* Soft dark gray for text */
        }

        .eco-container {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin: 2rem 3rem;
        }

        h2 {
            color: #2c3e50; /* Dark blue-gray for headings */
            font-weight: bold;
            margin-bottom: 1.5rem;
        }

        /* Modern Centered Search Bar */
        .search-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 2rem;
        }

        .search-bar {
            display: flex;
            align-items: center;
            background-color: #fff;
            border-radius: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 0.5rem 1rem;
            width: 100%;
            max-width: 500px;
        }

        .search-bar input {
            border: none;
            outline: none;
            flex: 1;
            padding: 0.5rem;
            font-size: 1rem;
            background: transparent;
        }

        .search-bar button {
            border: none;
            background: transparent;
            cursor: pointer;
            color: #0d6efd;
            font-size: 1.2rem;
            transition: color 0.3s ease;
        }

        .search-bar button:hover {
            color: #0b5ed7;
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
            color: #444; /* Soft dark gray for table text */
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

        .scrollable-table {
            max-height: 300px;
            overflow-y: auto;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .scrollable-table-large {
            max-height: 500px; /* Larger height for Waste Schedule */
            overflow-y: auto;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        footer {
            background-color: #17a2b8;
            color: #fff;
            text-align: center;
            padding: 15px;
            font-size: 16px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 3rem 3rem 1rem;
            border-radius: 10px;
            box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.2);
        }

        footer a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        footer a:hover {
            color: #FFD700; /* Gold color for hover */
        }

        /* Accent colors for links and highlights */
        a {
            color: #17a2b8; /* Teal for links */
            text-decoration: none;
        }

        a:hover {
            color: #0d6efd; /* Blue for hover */
        }

        .highlight {
            color: #28a745; /* Green for highlights */
            font-weight: bold;
        }

        /* Section Links Styling */
        .section-links {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .section-links a {
            padding: 0.5rem 1rem;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .section-links a i {
            font-size: 1.2rem;
        }

        .section-links a.waste-schedule {
            background-color: #28a745; /* Green for Waste Schedule */
        }

        .section-links a.eco-tips {
            background-color: #17a2b8; /* Teal for Eco Tips */
        }

        .section-links a.notices {
            background-color: #dc3545; /* Red for Notices */
        }

        .section-links a:hover {
            opacity: 0.9;
        }
    </style>
</head>

<body>

    <!-- Eco Tracker Content -->
    <div class="eco-container">
        <!-- Modern Centered Search Bar -->
        <div class="search-container">
            <div class="search-bar">
                <input type="text" id="searchInput" placeholder="Search for waste schedules, eco tips, or notices...">
                <button onclick="searchContent()">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>

        <!-- Section Links -->
        <div class="section-links">
            <a href="#waste-schedule" class="waste-schedule">
                <i class="fas fa-trash-alt"></i> Waste Schedule
            </a>
            <a href="#notices" class="notices">
                <i class="fas fa-bell"></i> Notices
            </a>
            <a href="#eco-tips" class="eco-tips">
                <i class="fas fa-leaf"></i> Eco Tips
            </a>
        </div>

        <!-- Waste Collection Schedule Table -->
        <h2 id="waste-schedule">Waste Collection Schedule</h2>
        <div class="scrollable-table-large">
            <table class="table">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Area</th>
                        <th>Day</th>
                        <th>Time</th>
                        <th>Fee</th>
                    </tr>
                </thead>
                <tbody>
                    <dy>
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
                                    


                                   
                                </tr>
                                <?php $i++;
                            } ?>

                    
                </tbody>
            </table>
        </div>

        <!-- Important Notices Table -->
        <h2 id="notices">Important Notices</h2>
        <div class="scrollable-table">
            <table class="table">
                <thead>
                    <tr>
                        <th>Notice</th>
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
                                   
                                    


                                    
                                </tr>
                                <?php $i++;
                            } ?>
                 
                </tbody>
            </table>
        </div>

        <!-- Eco Tips Table -->
        <h2 id="eco-tips">Eco Tips</h2>
        <div class="scrollable-table">
            <table class="table">
                <thead>
                    <tr>
                        <th>Tip</th>
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
                                   
                                    


                                   
                                </tr>
                                <?php $i++;
                            } ?>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p style="margin: 0;">Developed by <span style="font-weight: bold; color: #FFD700;">Lovies</span> | &copy; 2026 | Contact Us: <a href="mailto:curiouserios@gmail.com">curiouserios@gmail.com</a> | Phone: <a href="tel:9708077117">9708077117 (Bipin)</a></p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Search Functionality -->
    <script>
        function searchContent() {
            const input = document.getElementById("searchInput").value.toLowerCase();
            const tables = document.querySelectorAll(".scrollable-table table tbody, .scrollable-table-large table tbody");

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

        // Smooth Scroll to Section
        document.querySelectorAll('.section-links a').forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href').substring(1);
                const targetSection = document.getElementById(targetId);
                if (targetSection) {
                    targetSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    </script>
</body>

</html>