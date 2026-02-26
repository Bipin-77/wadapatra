<?php
   
    require 'classes/Emergency.php';
    $informations = new Emergency ();
   
    $id = $_GET['id'];
    $deleted = $informations->deleteBasic($id);
    if($deleted){
        header("Location:emergency_contact.php");
    }else{
        echo "try again";
    }
    
   
    
?>