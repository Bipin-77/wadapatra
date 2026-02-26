<!-- Include the navbar -->
<?php include 'onavbar.php';
if (!isset($_SESSION['username']) && !isset($_SESSION['is_admin'])) {
    header("Location:index.php");
}

require 'classes/Users.php';
$informations = new Users();

$listsNotices = $informations->listNotices();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notices</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
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
    <!-- Notices Section -->
    <div class="container notice-container">
        <h1 class="text-center mb-4">Public Notices</h1>

        <!-- Search Bar -->
        <div class="search-bar">
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search notices..." aria-label="Search">
                <button class="btn btn-outline-success" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>

        <!-- Notices List -->
        <div id="notices-list">
            <!-- Notice 1 -->
            <?php
            $i = 1;
            foreach ($listsNotices as $listNotice) {

                ?>

                <div id="notices-list">
                    <!-- Notice 1 -->
                    <div class="notice-card">
                        <div class="notice-title"> <?php echo $listNotice['name']; ?></div>
                        <div class="notice-subject"></div>
                        <div class="notice-description">
                            <?php echo $listNotice['description']; ?>

                        </div>
                        <div class="notice-date">
                            <i class="fas fa-calendar-alt me-2"></i><?php echo $listNotice['date']; ?>
                        </div>

                    </div>
                </div>
                <?php $i++;
            } ?>

        </div>
    </div>

    <!-- Pagination -->
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>
    </nav>
    </div>

    <footer
        style="background-color: #17a2b8; color: #fff; text-align: center; padding: 15px; font-size: 16px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 3rem 3rem 1rem; border-radius: 10px; box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.2);">
        <p style="margin: 0;">Developed by <span style="font-weight: bold; color: #1900ff;">AMR-Creations</span> |
            &copy; 2026 | Contact Us: <a href="mailto:bipinbohara@gmail.com"
                style="color: #171ad8; text-decoration: none; font-weight: bold;">bipinbohara@gmail.com</a> | Phone: <a
                href="tel:9708077117" style="color: #fff; text-decoration: none; font-weight: bold;">9708077117
                (Bipin)</a></p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>