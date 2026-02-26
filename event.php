<?php
include 'onavbar.php';

require 'classes/Users.php';

$informations = new Users();
$listsEvents = $informations->listEvents();
if (isset($_GET['search'])) {
    $listsEvents = $informations->searchEvents($_GET);
}

// Calculate the total number of pages
$totalPages = ceil(count($listsEvents) / 9);

// Calculate the current page number
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the start and end indices for the current page
$startIndex = ($current_page - 1) * 9;
$endIndex = $startIndex + 9;

// Slice the events and notices array to get the current page's items
$currentPageItems = array_slice($listsEvents, $startIndex, 9);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .events-container {
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
            display: flex;
            gap: 0.5rem;
            justify-content: center;
        }

        .search-bar input {
            border-radius: 5px;
            border: 1px solid #ced4da;
            padding: 0.75rem 1rem;
            width: 60%;
            font-size: 1.2rem;
        }

        .search-bar button {
            border-radius: 5px;
            padding: 0.75rem 1.5rem;
            background-color: #0d6efd;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 1.2rem;
            transition: background-color 0.3s ease;
        }

        .search-bar button:hover {
            background-color: #0b5ed7;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            height: 400px;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card img {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            height: 180px;
            object-fit: cover;
        }

        .card-body {
            padding: 1rem;
            height: 200px;
            position: relative;
        }

        .card-title {
            color: #007bff;
            font-size: 1.5rem;
            /* Increased font size */
        }

        .card-text {
            font-size: 1.1rem;
            /* Increased font size */
            color: #6c757d;
            height: 40px;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
        }

        .event-date {
            font-size: 1rem;
            /* Increased font size */
            color: #6c757d;
            margin-bottom: 10px;
        }

        .read-more {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 0.5rem 1rem;
            font-size: 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
        }

        .read-more:hover {
            background-color: #218838;
        }

        .modal-dialog {
            max-width: 900px;
            /* Increased modal width */
        }

        .modal-content {
            border-radius: 10px;
        }

        .modal-header {
            border-bottom: none;
            padding: 1rem;
        }

        .modal-body {
            padding: 2rem;
        }

        .modal-body img {
            width: 100%;
            border-radius: 10px;
            height: auto;
        }

        .modal-title {
            font-size: 1.75rem;
            /* Increased title font size */
        }

        .modal-description {
            font-size: 1.2rem;
            /* Increased description font size */
            color: #6c757d;
            margin-top: 1rem;
            white-space: pre-wrap;
            /* Preserve whitespace and line breaks */
            word-wrap: break-word;
            /* Break long words */
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
        }

        .pagination a {
            padding: 10px 15px;
            margin: 0 5px;
            background-color: #0d6efd;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1.2rem;
        }

        .pagination a.active {
            background-color: #0b5ed7;
        }
    </style>
</head>

<body>
    <div class="events-container">
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search for events or notices...">
            <button onclick="searchContent()">Search</button>
        </div>
        <section class="events">
            <h2>Upcoming Events</h2>
            <div class="row row-cols-1 row-cols-md-3 g-4" id="eventsList">
                <?php foreach ($currentPageItems as $listEvent) {
                    $description = $listEvent['description'];
                    $eventDate = $listEvent['date']; // Assuming 'date' is the column name
                   // $imagePath = "admin/imges/". $listEvent['image']; // Set the image path
                    ?>
                    <div class="col">
                        <div class="card position-relative">
                            <img src="admin/images /<?php echo $listEvent['image']; ?>" alt="Event Image">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $listEvent['name']; ?></h5>
                                <p class="event-date"><?php echo date('F j, Y', strtotime($eventDate)); ?></p>
                                <p class="card-text"><?php echo $description; ?></p>
                                <button class="read-more" data-bs-toggle="modal"
                                    data-bs-target="#eventModal-<?php echo $listEvent['id']; ?>">Read More</button>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="eventModal-<?php echo $listEvent['id']; ?>" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"><?php echo $listEvent['name']; ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <img src="<?php  ?>" alt="Event Image"
                                        onerror>
                                    <p class="event-date"><strong>Date:</strong>
                                        <?php echo date('F j, Y', strtotime($eventDate)); ?></p>
                                    <p class="modal-description"><?php echo nl2br(htmlspecialchars($description)); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </section>
        <div class="pagination">
            <?php if ($current_page > 1) { ?>
                <a href="?page=<?php echo $current_page - 1; ?>" class="prev">Previous</a>
            <?php } ?>
            <?php for ($page = 1; $page <= $totalPages; $page++) { ?>
                <a href="?page=<?php echo $page; ?>" class="<?php echo $page == $current_page ? 'active' : ''; ?>">
                    <?php echo $page; ?> </a>
            <?php } ?>
            <?php if ($current_page < $totalPages) { ?>
                <a href="?page=<?php echo $current_page + 1; ?>" class="next">Next</a>
            <?php } ?>
        </div>
    </div>

    <footer
        style="background-color: #17a2b8; color: #fff; text-align: center; padding: 15px; font-size: 16px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 3rem 3rem 1rem; border-radius: 10px; box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.2);">
        <p style="margin: 0;">Developed by <span style="font-weight: bold; color: #000dff;">Lovies

        </span> |
            &copy; 
            2026 | Contact Us: <a href="mailto:curiouserios@gmail.com"
                style="color: #fff; text-decoration: none; font-weight: bold;">curiouserios@gmail.com</a> | Phone: <a
                href="tel:9708077117" style="color: #fff; text-decoration: none; font-weight: bold;">9708077117
                (Bipin)</a></p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>