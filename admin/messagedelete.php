<?php
   
    require 'classes/User.php';
    $informations = new User();
  
    $id = $_GET['id'];
    $deleted = $informations->deletMessage($id);
    if($deleted){
        header("Location:messages.php");
    }else{
        echo "try again";
    }
    
   
    
?>