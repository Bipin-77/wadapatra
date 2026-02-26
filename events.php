<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events and Notices - </title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
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
        }

        .search-bar input {
            border-radius: 5px;
            border: 1px solid #ced4da;
            padding: 0.5rem 1rem;
            width: 70%;
            font-size: 1rem;
        }

        .search-bar button {
            border-radius: 5px;
            padding: 0.5rem 1rem;
            background-color: #0d6efd;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 1rem;
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
            padding: 1.5rem;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 0.75rem;
        }

        .card-text {
            font-size: 0.9rem;
            color: #555;
            margin-bottom: 0.5rem;
        }

        .date {
            font-size: 0.8rem;
            color: #888;
            margin-bottom: 0.5rem;
        }

        .category {
            display: inline-block;
            background-color: #FFD700;
            color: #333;
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 5px;
            text-transform: uppercase;
        }

        .notices {
            margin-top: 2rem;
        }

        .notices ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .notices ul li {
            margin-bottom: 0.75rem;
            font-size: 0.9rem;
            color: #555;
        }

        .notices ul li a {
            text-decoration: none;
            color: #374785;
        }

        .notices ul li a:hover {
            text-decoration: underline;
            color: #FFD700;
        }

        .view-more {
            text-align: center;
            margin-top: 2rem;
        }

        .view-more a {
            text-decoration: none;
            font-size: 1rem;
            color: #2c3e50;
            font-weight: bold;
        }

        .view-more a:hover {
            color: #FFD700;
        }

        /* Carousel Styles */
        .carousel {
            position: relative;
            margin-top: 2rem;
        }

        .carousel-inner {
            display: flex;
            overflow: hidden;
        }

        .carousel-item {
            flex: 0 0 33.33%;
            transition: transform 0.5s ease;
        }

        .carousel-control {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: #fff;
            border: none;
            padding: 0.5rem;
            cursor: pointer;
            border-radius: 50%;
            font-size: 1.5rem;
            z-index: 1;
        }

        .carousel-control.prev {
            left: 10px;
        }

        .carousel-control.next {
            right: 10px;
        }
    </style>
</head>

<body>
    <!-- Include the navbar -->
    <?php include 'onavbar.php'; ?>

    <!-- Main Content -->
    <div class="events-container">
        <!-- Search Bar -->
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search for events or notices...">
            <button onclick="searchContent()">Search</button>
        </div>

        <!-- Events Section -->
        <section class="events">
            <h2>Upcoming Events</h2>
            <!-- First 6 Events in Grid -->
            <div class="row row-cols-1 row-cols-md-3 g-4" id="eventsList">
                <!-- Event Card 1 -->
                <div class="col">
                    <div class="card">
                        <img src="uploads/party.jpg" alt="Event Image">
                        <div class="card-body">
                            <h5 class="card-title">Music Festival</h5>
                            <p class="card-text">Join us for an evening filled with music, food, and fun at the annual
                                music festival held in City Park.</p>
                            <p class="date">Date: January 15, 2025</p>
                            <span class="category">Entertainment</span>
                        </div>
                    </div>
                </div>
                <!-- Event Card 2 -->
                <div class="col">
                    <div class="card">
                        <img src="uploads/blood.jpg" alt="Event Image">
                        <div class="card-body">
                            <h5 class="card-title">Blood Donation Camp</h5>
                            <p class="card-text">Help save lives by participating in the blood donation camp at
                                Community Hall.</p>
                            <p class="date">Date: January 20, 2025</p>
                            <span class="category">Social Cause</span>
                        </div>
                    </div>
                </div>
                <!-- Event Card 3 -->
                <div class="col">
                    <div class="card">
                        <img src="uploads/sport.jpg" alt="Event Image">
                        <div class="card-body">
                            <h5 class="card-title">Sports Meet</h5>
                            <p class="card-text">Show your athletic skills and team spirit by participating in the
                                annual sports meet.</p>
                            <p class="date">Date: February 5, 2025</p>
                            <span class="category">Sports</span>
                        </div>
                    </div>
                </div>
                <!-- Event Card 4 -->
                <div class="col">
                    <div class="card">
                        <img src="uploads/art.jpg" alt="Event Image">
                        <div class="card-body">
                            <h5 class="card-title">Art Exhibition</h5>
                            <p class="card-text">Discover local talent and enjoy amazing artwork at the city art
                                gallery.</p>
                            <p class="date">Date: March 10, 2025</p>
                            <span class="category">Art</span>
                        </div>
                    </div>
                </div>
                <!-- Event Card 5 -->
                <div class="col">
                    <div class="card">
                        <img src="uploads/event5.jpg" alt="Event Image">
                        <div class="card-body">
                            <h5 class="card-title">Tech Conference</h5>
                            <p class="card-text">Explore the latest in technology and innovation at the annual tech
                                conference.</p>
                            <p class="date">Date: April 12, 2025</p>
                            <span class="category">Technology</span>
                        </div>
                    </div>
                </div>
                <!-- Event Card 6 -->
                <div class="col">
                    <div class="card">
                        <img src="uploads/event6.jpg" alt="Event Image">
                        <div class="card-body">
                            <h5 class="card-title">Food Festival</h5>
                            <p class="card-text">Taste delicious cuisines from around the world at the city food
                                festival.</p>
                            <p class="date">Date: May 20, 2025</p>
                            <span class="category">Food</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Carousel for Remaining Events -->
            <div class="carousel">
                <div class="carousel-inner" id="carouselInner">
                    <!-- Event Card 7 -->
                    <div class="carousel-item">
                        <div class="card">
                            <img src="uploads/event7.jpg" alt="Event Image">
                            <div class="card-body">
                                <h5 class="card-title">Book Fair</h5>
                                <p class="card-text">Discover a wide range of books and meet your favorite authors at
                                    the annual book fair.</p>
                                <p class="date">Date: June 5, 2025</p>
                                <span class="category">Books</span>
                            </div>
                        </div>
                    </div>
                    <!-- Event Card 8 -->
                    <div class="carousel-item">
                        <div class="card">
                            <img src="uploads/event8.jpg" alt="Event Image">
                            <div class="card-body">
                                <h5 class="card-title">Film Festival</h5>
                                <p class="card-text">Watch award-winning films from around the world at the city film
                                    festival.</p>
                                <p class="date">Date: July 15, 2025</p>
                                <span class="category">Movies</span>
                            </div>
                        </div>
                    </div>
                    <!-- Event Card 9 -->
                    <div class="carousel-item">
                        <div class="card">
                            <img src="uploads/event9.jpg" alt="Event Image">
                            <div class="card-body">
                                <h5 class="card-title">Fashion Show</h5>
                                <p class="card-text">Experience the latest fashion trends at the city fashion show.</p>
                                <p class="date">Date: August 10, 2025</p>
                                <span class="category">Fashion</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Carousel Controls -->
                <button class="carousel-control prev" onclick="moveCarousel(-1)">&#10094;</button>
                <button class="carousel-control next" onclick="moveCarousel(1)">&#10095;</button>
            </div>
        </section>

        <!-- Notices Section -->
        <section class="notices">
            <h2>Latest Notices</h2>
            <ul id="noticesList">
                <li><a href="#">Emergency Water Supply Notice (Jan 2025)</a></li>
                <li><a href="#">City Electricity Maintenance Schedule</a></li>
                <li><a href="#">Public Meeting on Community Safety - Feb 2025</a></li>
                <li><a href="#">Recycling Collection Updates for 2025</a></li>
                <li><a href="#">Election Poll Notice and Guidelines</a></li>
            </ul>
        </section>

        <!-- View More Link -->
        <div class="view-more">
            <a href="#">View All Events and Notices</a>
        </div>
    </div>

    <!-- Footer -->
    <footer style="background-color: #17a2b8; color: #fff; text-align: center;
     padding: 15px; font-size: 16px; font-family: 'Segoe UI', Tahoma, Geneva, 
     Verdana, sans-serif; margin: 3rem 3rem 1rem; border-radius: 10px;
      box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.2);">
        <p style="margin: 0;">Developed by <span style="font-weight: bold; 
    color: #5900ff;">Lovies</span> | &copy;
            2026 | Contact Us: <a href="mailto:curiouserios@gmail.com"
                style="color: #fff; text-decoration: none; font-weight: bold;">curiouserios@gmail.com</a> | Phone: <a
                href="tel:9708077117" style="color: #fff; text-decoration: none; font-weight: bold;">9708077117 (Bipin)</a></p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Search Functionality -->
    <script>
        function searchContent() {
            const input = document.getElementById("searchInput").value.toLowerCase();
            const events = document.querySelectorAll("#eventsList .col");
            const notices = document.querySelectorAll("#noticesList li");

            // Search in Events
            events.forEach(event => {
                const eventText = event.textContent.toLowerCase();
                if (eventText.includes(input)) {
                    event.style.display = "";
                } else {
                    event.style.display = "none";
                }
            });

            // Search in Notices
            notices.forEach(notice => {
                const noticeText = notice.textContent.toLowerCase();
                if (noticeText.includes(input)) {
                    notice.style.display = "";
                } else {
                    notice.style.display = "none";
                }
            });
        }

        // Carousel Functionality
        let currentIndex = 0;

        function moveCarousel(direction) {
            const carouselInner = document.getElementById("carouselInner");
            const items = document.querySelectorAll(".carousel-item");
            const totalItems = items.length;

            currentIndex = (currentIndex + direction + totalItems) % totalItems;
            const offset = -currentIndex * 33.33;
            carouselInner.style.transform = `translateX(${offset}%)`;
        }
    </script>
</body>

</html>