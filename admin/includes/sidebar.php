
<?php
session_start();

if (!isset($_SESSION['username']) && !isset($_SESSION['is_admin'])) {
    header("Location:./index.php");
}
$id=$_SESSION['username'];

require 'classes/UserProfile.php';
$informations = new UserProfile();

$listsProfile = $informations->listUserProfile($id);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sidebar</title>
    <style>
        @media (max-width: 768px) {
            .sidebar {
                left: -250px;
            }

            .sidebar.open {
                left: 0;
            }

            .sidebar {
                position: relative;
            }

            .main-content {
                margin-left: 0;
            }
            aside .top{
    display: flex;
    justify-content: space-around;
    align-items: center;
   
    
}
        }
    </style>

</head>

<body>

    <!-- aside section start -->

    <aside>
        <div class="top">
            <button id="menu_bar">
                <span class="material-symbols-sharp">menu</span>
            </button>
            <div class="logo">
                <div class="profile">
                    <p><b><a href="myprofile.php"><?php echo $_SESSION['username'];?></b></p></a>

                </div>
                <!-- <div class="profile_photo">
                    <a href="myprofile.php"><img src="./profileimages/<?php echo $listsProfile;?>" alt="photo"></a>
                </div> -->
            </div>
            <div class="close" id="close_btn">
                <span class="material-symbols-sharp">close </span>
            </div>
        </div>
        <!-- top end -->
        <div class="sidebar">
            <a href="dashboard.php" class="active">
                <span class="material-symbols-sharp">home </span>
                <h3>Home</h3>
            </a>

            <a href="events.php">
                <span class="material-symbols-sharp">celebration </span>
                <h3>Events</h3>
            </a>

            <a href="notices.php">
                <span class="material-symbols-sharp">circle_notifications</span>
                <h3>Notice</h3>
            </a>

            <a href="budgets.php">
                <span class="material-symbols-sharp">paid </span>
                <h3>Budget</h3>
            </a>

            <a href="messages.php">
                <span class="material-symbols-sharp">message </span>
                <h3>Messages</h3>
            </a>

            <!-- <a href="polls.php">
                <span class="material-symbols-sharp">ballot </span>
                <h3>Polls</h3>
            </a> -->

            <a href="users.php">
                <span class="material-symbols-sharp">person </span>
                <h3>Users</h3>
            </a>

            <a href="ecotracker.php">
                <span class="material-symbols-sharp">cleaning_services </span>
                <h3>Waste schedule</h3>
            </a>

            <!-- <a href="">
                    <span class="material-symbols-sharp">analytics </span>
                    <h3>Analytics</h3>
                    </a> -->

            <a href="emergency_contact.php">
                <span class="material-symbols-sharp">contacts </span>
                <h3>Emergency contact</h3>
            </a>

            <a href="officials.php">
                <span class="material-symbols-sharp">person </span>
                <h3>Officials</h3>
            </a>

            <!-- <a href="">
                <span class="material-symbols-sharp">settings </span>
                <h3>settings</h3>
            </a> -->

            <a href="logout.php">
                <span class="material-symbols-sharp">logout </span>
                <h3>Logout</h3>
            </a>
            <!-- Profile Section -->
            <!-- <div class="profile" onclick="toggleDropdown()">
                <div class="avatar" id="profile-avatar"
                    data-profile-image="<?php echo htmlspecialchars($profileImageUrl); ?>">RO</div>
                <span>My Account</span>
                <div class="dropdown" id="dropdown-menu">
                    <a href=Admin/profile.php"><span>&#128100;</span> My Profile</a>
                    <a href="#" onclick="logout()"><span>&#x23FB;</span> Log Out</a>
                    <a href="#" onclick="changepass()"><span>&#x23FB;</span> change Password</a>
                </div>
                
            </div> -->

        </div>

    </aside>

    <!-- aside end -->
    <script>
        const menuBar = document.getElementById("menu_bar");
        const menuBarMobile = document.getElementById("menu_bar_mobile");
        const closeBtn = document.getElementById("close_btn");
        const sidebar = document.querySelector(".sidebar");

        // Open sidebar
        menuBar.addEventListener("click", () => {
            sidebar.classList.add("open");
        });

        menuBarMobile.addEventListener("click", () => {
            sidebar.classList.add("open");
        });

        // Close sidebar
        closeBtn.addEventListener("click", () => {
            sidebar.classList.remove("open");
        });

        // Close sidebar when clicking outside
        document.addEventListener("click", (event) => {
            if (!sidebar.contains(event.target) && !menuBar.contains(event.target) && !menuBarMobile.contains(event.target)) {
                sidebar.classList.remove("open");
            }
        });
        document.addEventListener("DOMContentLoaded", () => {
            const menuItems = document.querySelectorAll(".sidebar a"); // Select all sidebar links

            // Get current page filename from the URL
            let currentPage = window.location.pathname.split("/").pop().toLowerCase();

            // If no filename (default index page), set it to 'dashboard.php'
            if (currentPage === "") {
                currentPage = "dashboard.php";
            }

            // Loop through sidebar links
            menuItems.forEach((item) => {
                let linkHref = item.getAttribute("href").toLowerCase();

                // If link matches current page, add the 'active' class
                if (currentPage === linkHref) {
                    item.classList.add("active");
                } else {
                    item.classList.remove("active"); // Ensure no other link is active
                }
            });
        });

        //for the profile section at last #
        function toggleDropdown() {
            var dropdown = document.getElementById("dropdown-menu");
            dropdown.style.display = dropdown.style.display === "flex" ? "none" : "flex";
        }

        // Logout functionality
        function logout() {
            //alert("Logging out...");
            window.location.href = "../Logout/logout.php"; // Redirect to logout page
        }
    </script>
</body>

</html>