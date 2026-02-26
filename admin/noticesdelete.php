<?php
   
    require 'classes/User.php';
    $informations = new User();
  
    $id = $_GET['id'];
    $deleted = $informations->deleteNotices($id);
    if($deleted){
        header("Location:notices.php");
    }else{
        echo "try again";
    }
    
   
    
?>