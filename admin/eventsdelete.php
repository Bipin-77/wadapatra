<?php
   
    require 'classes/User.php';
    $informations = new User ();
   
    $id = $_GET['id'];
    $deleted = $informations->deleteEvents($id);
    if($deleted){
        header("Location:events.php");
    }else{
        echo "try again";
    }
    
   
    
?>