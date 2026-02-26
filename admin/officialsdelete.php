<?php
   
    require 'classes/Officials.php';
    $informations = new Officials();
  
    $id = $_GET['id'];
    $deleted = $informations->deleteOfficiLs($id);
    if($deleted){
        header("Location:officials.php");
    }else{
        echo "try again";
    }
    
   
    
?>