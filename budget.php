<!-- Include the navbar -->
<?php include 'onavbar.php';
require 'classes/Users.php';
$informations = new Users();

$listsBudgets = $informations->listBudgets();

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Budget Transparency</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Custom CSS for Budget Transparency Page */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .navbar {
            padding: 0.5rem 1rem;
        }

        .logo-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #ffffff;
            border: 2px solid #ffcc00;
        }

        .logo-circle img {
            width: 100%;
            height: auto;
        }

        .navbar-brand .neon-text {
            font-family: 'Arial', sans-serif;
            font-weight: bold;
            font-size: 1.8rem;
            text-transform: uppercase;
            color: #ffffff;
            text-shadow: 0 0 5px #00ffcc, 0 0 10px #00ffcc, 0 0 20px #00ffcc;
        }

        .navbar-brand .neon-text .mycity {
            color: rgb(242, 140, 8);
        }

        .navbar-brand .neon-text .hub {
            color: rgb(250, 12, 131);
        }

        .navbar-nav .nav-item {
            margin-right: 1rem;
        }

        .navbar-nav .nav-link {
            font-size: 1rem;
            font-weight: 500;
            color: #ffffff;
            transition: all 0.3s ease;
            padding: 0.5rem 1rem;
            border-radius: 5px;
        }

        .navbar-nav .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
        }

        .navbar-nav .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
            color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-nav .nav-link i {
            color: #ffcc00;
            font-size: 1.1rem;
        }

        .navbar-nav .nav-link:hover i {
            color: #ffffff;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
            font-size: 1rem;
        }

        .btn-danger:hover {
            background-color: #bb2d3b;
        }

        /* Top Section */
        .top-section {
            text-align: center;
            padding: 3rem 0;
            background: linear-gradient(135deg, rgb(13, 210, 254), rgb(39, 255, 15));
            color: #fff;
            margin: 1rem 3rem;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
        }

        .top-section::before {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 10%, transparent 10.01%);
            background-size: 20px 20px;
            animation: animateBackground 10s linear infinite;
        }

        @keyframes animateBackground {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .top-section h1 {
            font-size: 3.5rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 1;
        }

        .top-section p {
            font-size: 1.5rem;
            margin: 0;
            position: relative;
            z-index: 1;
        }

        /* Search and Filter Section */
        .search-filter-section {
            margin: 2rem 3rem;
            display: flex;
            gap: 1rem;
            justify-content: center;
            align-items: center;
        }

        .search-filter-section input,
        .search-filter-section select,
        .search-filter-section button {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
        }

        .search-filter-section input {
            flex: 1;
            max-width: 300px;
        }

        .search-filter-section select {
            background: rgb(244, 228, 8);
            color: #fff;
            cursor: pointer;
        }

        .search-filter-section button {
            background: rgb(20, 236, 240);
            color: #fff;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .search-filter-section button:hover {
            background: rgb(246, 8, 202);
        }

        /* Budget Cards */
        .budget-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
        }

        .budget-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .budget-card img {
            
            height: 300px;
            object-fit: cover;
        }

        .budget-card .card-body {
            padding: 2rem;
        }

        .budget-card h2 {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 1rem;
            color: #333;
        }

        .category-label {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #ffcc00;
            color: #fff;
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            font-weight: bold;
            border-radius: 5px;
            z-index: 2;
        }

        .budget-card p {
            font-size: 1.1rem;
            color: #555;
            line-height: 1.6;
        }

        .budget-card strong {
            color: #333;
        }

        .duration {
            display: flex;
            justify-content: space-between;
            margin: 1rem 0;
            font-size: 1rem;
            color: #666;
        }

        .duration span {
            display: block;
            text-align: center;
            flex: 1;
        }

        .duration span:not(:last-child) {
            border-right: 1px solid #ddd;
        }

        .progress-bar {
            height: 10px;
            background: #e0e0e0;
            border-radius: 5px;
            overflow: hidden;
            margin: 1rem 0;
        }

        .progress {
            height: 100%;
            background: #4caf50;
            border-radius: 5px;
            transition: width 0.5s ease;
        }

        .progress-text {
            font-size: 1rem;
            color: #666;
            text-align: center;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            margin: 2rem 0;
        }

        .pagination button {
            padding: 0.5rem 1rem;
            margin: 0 0.25rem;
            border: none;
            border-radius: 5px;
            background: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .pagination button.active {
            background: #0056b3;
        }

        .pagination button:hover {
            background: #0056b3;
        }

        /* Footer */
        footer {
            background-color: #17a2b8;
            color: #fff;
            text-align: center;
            padding: 15px;
            font-size: 16px;
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
            color: #ffcc00;
        }

        .budget-card {
            display: flex;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 80%;
            margin: 0 auto;
            margin-bottom: 1rem;
        }

        .project-image {
            width: 40%;
            object-fit: cover;
        }

        .card-content {
            padding: 20px;
            width: 60%;
        }

        .category {
            display: inline-block;
            background: #ffc107;
            color: black;
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold;
            font-size: 14px;
        }

        h2 {
            margin-top: 10px;
            font-size: 24px;
        }

        .details {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
            font-size: 14px;
            color: #555;
        }

        .progress-bar {
            height: 8px;
            background: #ddd;
            border-radius: 5px;
            overflow: hidden;
            margin-top: 10px;
        }

        .progress {
            height: 100%;
            background: #28a745;
        }

        .progress-text {
            font-size: 14px;
            color: #333;
            margin-top: 5px;
        }
    </style>
</head>

<body>

    <!-- Top Section -->
    <div class="top-section">
        <h1 id="total-budget">Total Budget: RS 50,000,000</h1>
        <p id="selected-year">Year: 2026</p>
    </div>

    <!-- Search and Filter Section -->
    <div class="search-filter-section">
        <input type="text" id="search-input" placeholder="Search projects...">
        <select id="year-filter">
            <option value="2023">2026</option>
            <option value="2022">2025</option>
        </select>
        <select id="month-filter">
            <option value="all">All Months</option>
            <option value="01">January</option>
            <option value="02">February</option>
            <option value="03">March</option>
            <option value="04">April</option>
            <option value="05">May</option>
            <option value="06">June</option>
            <option value="07">July</option>
            <option value="08">August</option>
            <option value="09">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
        </select>
        <button onclick="applyFilters()">Apply Filters</button>
    </div>

    <!-- Budget Cards -->
    <?php
    $i = 1;
    foreach ($listsBudgets as $listBudget) {


        ?>

        <div class="budget-card">
            <img src="./admin/images/<?php echo $listBudget['image']?>" alt="Project Image" class="project-image">
            <div class="card-content">
                <div class="category"><?php echo $listBudget['sector']; ?></div>
                <h2><?php echo $listBudget['name']; ?></h2>
                <p><strong>Address:</strong><?php echo $listBudget['area']; ?></p>
                <p><strong>Budget:</strong>Rs : <?php echo $listBudget['budget']; ?></p>
                <div class="details">
                    <span><strong>Start Date:</strong> <?php echo $listBudget['start']; ?></span>
                    <span><strong>End Date:</strong> <?php echo $listBudget['end']; ?></span>
                    <span><strong>Total Time:</strong><?php echo $listBudget['duration']; ?></span>
                </div>
                <p><?php echo $listBudget['description']; ?></p>
                <div class="progress-bar">
                    <div class="progress" style=""></div>
                </div>
                <p >Progress:<?php echo $listBudget['progress']; ?>%</p>
            </div>
        </div>
        <?php $i++;
    } ?>



    <div class="container" id="projects-container">
        <!-- Cards will be dynamically loaded here -->
    </div>

    <!-- Pagination -->
    <div class="pagination" id="pagination">
        <!-- Pagination buttons will be dynamically loaded here -->
    </div>

    <!-- Footer -->
    <footer>
        <p style="margin: 0;">Developed by <span style="font-weight: bold; color: #FFD700;">Lovies</span> |
            &copy; 2026 | Contact Us: <a href="mailto:bibekmishra@gmail.com"
                style="color: #fff; text-decoration: none; font-weight: bold;">bibekmishra@gmail.com</a> | Phone: <a
                href="tel:9708077117" style="color: #fff; text-decoration: none; font-weight: bold;">9708077117</a></p>
    </footer>
    <?php
    // $i = 1;
    // foreach ($listsEvents as $listEvent) {
    
    //     ?>
    <script>
        // Sample Data (Replace with actual data from your backend)




        // Function to render projects
        function renderProjects(page = 1, filter = "all", year = "2023", month = "all", query = "") {
            const container = document.getElementById("projects-container");
            const pagination = document.getElementById("pagination");
            container.innerHTML = "";
            pagination.innerHTML = "";

            // Filter projects
            let filteredProjects = projects.filter(project => {
                const matchesYear = project.startDate.startsWith(year);
                const matchesMonth = month === "all" || project.startDate.split('-')[1] === month;
                const matchesQuery = project.title.toLowerCase().includes(query.toLowerCase()) ||
                    project.description.toLowerCase().includes(query.toLowerCase());
                return matchesYear && matchesMonth && matchesQuery;
            });

            // Update total budget
            const totalBudget = filteredProjects.reduce((sum, project) => {
                return sum + parseFloat(project.budget.replace(/\$|,/g, ''));
            }, 0);
            document.getElementById("total-budget").textContent = `Total Budget: $${totalBudget.toLocaleString()}`;
            document.getElementById("selected-year").textContent = `Year: ${year}`;

            // Paginate projects
            const startIndex = (page - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const paginatedProjects = filteredProjects.slice(startIndex, endIndex);

            // Render projects
            paginatedProjects.forEach(project => {
                const card = `
                    <div class="row budget-card">
                        <div class="col-md-4">
                            <img src="${project.image}" alt="${project.title}">
                            <span class="category-label">${project.category}</span> <!-- Category label -->
                            ${project.status === "ongoing" ? `
                                <div class="progress-bar">
                                    <div class="progress" style="width: ${project.progress}%;"></div>
                                </div>
                                <p class="progress-text">${project.progress}% Complete</p>
                            ` : `
                                <p class="progress-text">Completed</p>
                            `}
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h2>${project.title}</h2>
                                <p><strong>Address:</strong> ${project.address}</p>
                                <p><strong>Budget:</strong> ${project.budget}</p>
                                <div class="duration">
                                    <span><strong>Start Date:</strong> ${project.startDate}</span>
                                    <span><strong>End Date:</strong> ${project.endDate}</span>
                                    <span><strong>Total Time:</strong> ${project.totalTime}</span>
                                </div>
                                <p>${project.description}</p>
                            </div>
                        </div>
                    </div>
                `;
                container.innerHTML += card;
            });

            // Render pagination buttons
            const totalPages = Math.ceil(filteredProjects.length / itemsPerPage);
            for (let i = 1; i <= totalPages; i++) {
                const button = `<button onclick="changePage(${i})" ${i === page ? 'class="active"' : ''}>${i}</button>`;
                pagination.innerHTML += button;
            }
        }

        // Function to change page
        function changePage(page) {
            currentPage = page;
            renderProjects(currentPage, currentFilter, currentYear, currentMonth, searchQuery);
        }

        // Function to apply filters
        function applyFilters() {
            currentYear = document.getElementById("year-filter").value;
            currentMonth = document.getElementById("month-filter").value;
            searchQuery = document.getElementById("search-input").value;
            currentPage = 1;
            renderProjects(currentPage, currentFilter, currentYear, currentMonth, searchQuery);
        }

        // Initial render
        renderProjects(currentPage, currentFilter, currentYear, currentMonth, searchQuery);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>