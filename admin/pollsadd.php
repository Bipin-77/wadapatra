<?php
/*session_start();
if (!isset($_SESSION['username']) && !isset($_SESSION['is_admin'])) {
  header("Location:index.php");
  exit();
}*/
if (isset($_POST['title'])) {

    include_once "classes/Poll.php";
    $user = new Poll();
    if (
        isset($_FILES["image"]) &&
        $_FILES["image"]["error"] == UPLOAD_ERR_OK
    ) {

        // Add name of upload directory
        $uploadDirectory = "./images/";
        $filename = $_FILES["image"]["name"];
        if (
            move_uploaded_file(
                $_FILES["image"]["tmp_name"],
                $uploadDirectory . $filename
            )
        ) {

            $cerated = $user->registerPoll($_POST, $filename);
            if ($cerated) {
                header("Location:polls.php");
            } else {
                echo "try again";
            }

        }
    }
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
    <title>Admin </title>
    <style>
      
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input[type="text"],
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-group input[type="file"] {
            width: 100%;
            padding: 8px;
        }
        .form-group .choice {
            margin-bottom: 10px;
        }
        .form-group .choice input[type="text"] {
            width: calc(100% - 30px);
            display: inline-block;
        }
        .form-group .choice button {
            display: inline-block;
            padding: 5px 10px;
            background-color: #ff4444;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-group .choice button:hover {
            background-color: #cc0000;
        }
        .form-group button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-group button[type="submit"]:hover {
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
                    <h1>Add Polls</h1>
                    <div class="date">
                        <?php echo date("d/m/y"); ?>
                    </div>
                </div>



            </div>
            <!-- top section end -->
            <!-- content area start -->
            <div class="content">
                <div class="form-container">
                    <h2>Poll and Survey Form</h2>
                    <form action="" method="post" enctype="multipart/form-data">
                        <!-- Title -->
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" id="title" name="title" required>
                        </div>

                        <!-- Description -->
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea id="description" name="description" rows="4" required></textarea>
                        </div>

                        <!-- Choices -->
                        <!-- <div class="form-group">
                            <label>Choices:</label>
                            <div id="choices-container">
                                <div class="choice">
                                    <input type="text" name="choice[]" placeholder="Enter a choice" required>
                                    <button type="button" onclick="removeChoice(this)">Remove</button>
                                </div>
                            </div>
                            <button type="button" onclick="addChoice()">Add Choice</button>
                        </div> -->

                        <!-- Comment -->
                       

                        <!-- Image Upload -->
                        <div class="form-group">
                            <label for="image">Upload Image:</label>
                            <input type="file" id="image" name="image" accept="image/*">
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group">
                            <button type="submit">Submit</button>
                        </div>
                    </form>
                </div>


            </div>

            <!-- content sec end -->

        </main>

        <!-- main area end -->
        <!-- start right -->

        <!-- right end -->



    </div>
    <!-- container -->
    <!-- <script>
        // Function to add a new choice field
        function addChoice() {
            const container = document.getElementById("choices-container");
            const newChoice = document.createElement("div");
            newChoice.className = "choice";
            newChoice.innerHTML = `
                <input type="text" name="choice[]" placeholder="Enter a choice" required>
                <button type="button" onclick="removeChoice(this)">Remove</button>
            `;
            container.appendChild(newChoice);
        }

        // Function to remove a choice field
        function removeChoice(button) {
            const choiceDiv = button.parentElement;
            choiceDiv.remove();
        }
    </script> -->
</body>

</html>