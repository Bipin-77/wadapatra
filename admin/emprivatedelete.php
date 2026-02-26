<?php
   
    require 'classes/Emergency.php';
    $informations = new Emergency ();
    // session_start();
    // if(!isset($_SESSION['username']) && !isset($_SESSION['is_admin'])){
    //     header("Location:index.php");
    // }
    $id = $_GET['id'];
    $deleted = $informations->deletePrivate($id);
    if($deleted){
        header("Location:emergency_contact.php");
    }else{
        echo "try again";
    }
    
   
    
?>