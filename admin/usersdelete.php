<?php
   
    require 'classes/User.php';
    $informations = new User();
   
    $id = $_GET['id'];
    $deleted = $informations->deleteUser($id);
    if($deleted){
        header("Location:users.php");
    }else{
        echo "try again";
    }
    
   
    
?>