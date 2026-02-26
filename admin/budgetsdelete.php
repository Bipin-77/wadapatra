<?php
   
    require 'classes/Budget.php';
    $informations = new Budget();
   
    $id = $_GET['id'];
    $deleted = $informations->deleteBudget($id);
    if($deleted){
        header("Location:budgets.php");
    }else{
        echo "try again";
    }
    
   
    
?>