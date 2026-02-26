<?php
   
    require 'classes/Waste.php';
    $informations = new Waste();
    
    $id = $_GET['id'];
    $deleted = $informations->deleteEcoNotice($id);
    if($deleted){
        header("Location:ecotracker.php");
    }else{
        echo "try again";
    }
    
   
    
?>