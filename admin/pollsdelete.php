<?php
   
   
    
    include_once "classes/Poll.php";
    $user = new Poll();
   
    $id = $_GET['id'];
    $deleted =$user->deletePolls($id);
    if($deleted){
        header("Location:polls.php");
    }else{
        echo "try again";
    }
    
   
    
?>