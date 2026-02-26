<?php
session_start();
require 'classes/UserProfile.php';
$informations = new UserProfile();
$lists = $informations->listUser();

// echo"<pre>"; print_r($_SESSION);echo"</pre>"; exit;
$id = $_SESSION['username'];
$listRecord = $informations->getRecordById($id);

// Handle profile picture upload
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $uploadDir = 'profileimages/'; // Directory to store uploaded images
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true); // Create the directory if it doesn't exist
    }

    $file = $_FILES['image'];
    $fileName = basename($file['name']);
    $filePath = $uploadDir . $fileName;
    $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

    // Check if the file is an image
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    if (in_array($fileType, $allowedTypes)) {
        if (move_uploaded_file($file['tmp_name'], $filePath)) {
            // Update the profile picture path in the database
            $cerated = $informations->updateUserProfile($_POST, $id, $filename);
            if ($cerated) {


                // Refresh the page to display the new profile picture
                header("Location: ./myprofile.php");

            } else {
                echo "<script>alert('Failed to upload profile picture.');</script>";
            }
        } else {
            echo "<script>alert('Only JPG, JPEG, PNG, and GIF files are allowed.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Add Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: linear-gradient(135deg, rgb(85, 126, 202), rgb(215, 220, 229));
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }



        .profile-container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            position: relative;
            /* For positioning the back button */
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 1.5rem;
            font-size: 2rem;
            font-weight: bold;
        }

        .profile-details {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: bold;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            border: none;
        }

        .profile-details .detail {
            margin-bottom: 1rem;
        }

        .profile-details .detail label {
            font-weight: bold;
            color: #555;
        }

        .profile-details .detail p {
            margin: 0;
            font-size: 1rem;
            color: #333;
        }

        .profile-picture {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .profile-picture img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #007bff;
        }

        .profile-picture input[type="file"] {
            margin-top: 1rem;
        }

        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>


    <!-- Profile Container -->
    <div class="profile-container">
        <!-- Back Button with Icon -->
        <a href="dashboard.php" class="back-button">
            <i class="bi bi-arrow-left"></i> Back
        </a>

        <h1>Admin Profile</h1>

        <!-- Profile Picture -->
        <!-- Profile Picture -->
        <div class="profile-picture">
            <?php if (!empty($listRecord['image'])): ?>
                <img src="<?php echo htmlspecialchars($listRecord['image']); ?>" alt="Profile Picture">
            <?php else: ?>
                <img src="./profileimages/<?php echo $listRecord['image']; ?>" alt="Profile Picture">
            <?php endif; ?>

            <!-- Profile Picture Upload Form -->
            <form method="POST" enctype="multipart/form-data">
                <input type="file" name="image" accept="image/*" class="form-control mt-2">
                <button type="submit" class="btn btn-primary mt-2">Upload Profile Picture</button>
            </form>
        </div>

        <!-- Profile Details -->
        <div class="profile-details">
            <div class="detail">
                <label>Full Name:</label>
                <p><?php echo htmlspecialchars($listRecord['name']); ?></p>
            </div>
            <div class="detail">
                <label>Email:</label>
                <p><?php echo htmlspecialchars($listRecord['email']); ?></p>
            </div>

        </div>
    </div>

    
</body>

</html>