<?php
require_once '../config/Database.php';
$db = new Database();
$conn = $db->getConnection();
include_once "classes/Budget.php";
$user = new Budget();



$id = $_GET['id'];
$listRecord = $user->getRecordById($id);

// if ($_POST){
if (isset($_POST['name'])) {
   
    $cerated = $user->updateBudget($_POST ,$id);
    if ($cerated) {
        header("Location:budgets.php");
    } else {
        echo "try again";
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="assets/css/adminstyle.css">
    <link rel="stylesheet" href="assets/css/userstyle.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin </title>
    <style>
        form {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        input[type="file"],
        input[type="date"],
        textarea,
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
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
                    <h1>Update Budget</h1>
                    <div class="date">
                        <?php echo date("d/m/y"); ?>
                    </div>
                </div>

              

            </div>
            <!-- top section end -->
            <div class="content">
                <div class="form-container">
                    <!-- <div class="close-btn">
                        <button class="close-btn" onclick="closeForm()"><span class="material-symbols-sharp">close
                            </span></button>


                    </div> -->
                    <h2> Add Budget details</h2>

                    <form action="#" method="post" enctype="multipart/form-data">
                        <div>
                            <label for="budgetTitle">Budget Title:</label>
                            <input type="text" id="budgetTitle" name="name" value="<?php echo $listRecord['name'] ?>" required>
                        </div>

                        <div>
                            <label for="area">Area:</label>
                            <input type="text" id="area" name="area" value="<?php echo $listRecord['area'] ?>" required>
                        </div>

                        <div>
                            <label for="sector">Sector:</label>
                            <select id="sector" name="sector" value="<?php echo $listRecord['sector'] ?>" required>
                                <option value="<?php echo $listRecord['sector'] ?>">Select Sector</option>
                                <option value="Education">Education</option>
                                <option value="Healthcare">Healthcare</option>
                                <option value="Infrastructure">Infrastructure</option>
                                <option value="Agriculture">Agriculture</option>
                                <option value="Technology">Technology</option>
                            </select>
                        </div>

                        <div>
                            <label for="totalBudget">Total Budget:</label>
                            <input type="number" id="totalBudget" name="budget" step="0.01" value="<?php echo $listRecord['budget'] ?>" required>
                        </div>

                        <div>
                            <label for="startDate">Start Date:</label>
                            <input type="date" id="startDate" name="start" required>
                        </div>

                        <div>
                            <label for="endDate">End Date:</label>
                            <input type="date" id="endDate" name="end" required>
                        </div>

                        <div>
                            <label for="duration">Duration (in months):</label>
                            <input type="number" id="duration" name="duration" value="<?php echo $listRecord['duration'] ?>" required>
                        </div>

                        <div>
                            <label for="progress">Progress (%):</label>
                            <input type="number" id="progress" name="progress" min="0" max="100" value="<?php echo $listRecord['progress'] ?>" required>
                        </div>

                        <div>
                            <label for="description">Description:</label>
                            <textarea id="description" name="description" rows="4" value="<?php echo $listRecord['description'] ?>" required></textarea>
                        </div>

                        <!-- <div >
                            <label for="image">Upload Image:</label>
                            <input type="file" id="image" name="image" accept="image/*" required>
                        </div> -->

                        <div>
                            <input type="submit" value="Update">
                        </div>
                    </form>
                </div>
            </div>
            <!-- content end -->

        </main>

        <!-- main area end -->
        <!-- start right -->

        <!-- top end -->

        <!-- recent updates -->









        <!-- end recent updates -->

        <!-- start analytics -->

        <!-- start analytics -->


        <!-- end right -->

    </div>
    <!-- container -->
    <script>
        // JavaScript to close the form
        function closeForm() {
            document.querySelector('.form-container').style.display = 'none';
        }

        function calculateDuration() {
        const startDate = document.getElementById("startDate").value;
        const endDate = document.getElementById("endDate").value;
        const durationField = document.getElementById("duration");

        if (startDate && endDate) {
            const start = new Date(startDate);
            const end = new Date(endDate);

            if (end >= start) {
                const diffInMonths = (end.getFullYear() - start.getFullYear()) * 12 + (end.getMonth() - start.getMonth());
                durationField.value = diffInMonths;
            } else {
                durationField.value = "";
            }
        }
    }

    document.getElementById("startDate").addEventListener("change", calculateDuration);
    document.getElementById("endDate").addEventListener("change", calculateDuration);

    function setMinMaxEndDate() {
        const startDateInput = document.getElementById("startDate");
        const endDateInput = document.getElementById("endDate");

        if (!startDateInput.value) return;

        const startDate = new Date(startDateInput.value);
        const today = new Date();
        const maxEndDate = new Date(startDate);
        maxEndDate.setFullYear(startDate.getFullYear() + 5); // Max 5 years from start date

        // Set constraints for end date
        const minDate = today.toISOString().split("T")[0]; // Today
        const maxDate = maxEndDate.toISOString().split("T")[0]; // 5 years from start

        endDateInput.setAttribute("min", minDate);
        endDateInput.setAttribute("max", maxDate);
    }

    function calculateDuration() {
        const startDate = document.getElementById("startDate").value;
        const endDate = document.getElementById("endDate").value;
        const durationField = document.getElementById("duration");

        if (startDate && endDate) {
            const start = new Date(startDate);
            const end = new Date(endDate);

            if (end >= start) {
                const diffInMonths = (end.getFullYear() - start.getFullYear()) * 12 + (end.getMonth() - start.getMonth());
                durationField.value = diffInMonths;
            } else {
                durationField.value = "";
            }
        }
    }

    document.getElementById("startDate").addEventListener("change", function () {
        setMinMaxEndDate();
        calculateDuration();
    });

    document.getElementById("endDate").addEventListener("change", calculateDuration);

    </script>
</body>

</html>