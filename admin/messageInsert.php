<?php
if (isset($_POST['name'])) {
    include_once "classes/User.php";
    $user = new User();
    $cerated = $user->addMessages($_GET);
    if ($cerated) {
        header("Location:messages.php");
    } else {
        echo "try again";
    }
    
}
?>