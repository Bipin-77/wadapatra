<?php
include_once "../config/Database.php";
class UserProfile{


 public $user='';
 public $email='';
 private $password='';
 public $connection;
 public $conn;
 public function __construct(){
    $this->connection = new Database();
    $this->conn=$this->connection->getConnection();
 }

 public function listUserProfile($id)
 {
     $result = $this->conn->prepare("select image from users where username=:id ");
     $result->bindParam(':id',$id);
     $result->execute();
     return $result->fetchAll();
 }
 public function listUser()
 {
     $result = $this->conn->prepare("select * from users where deleted_at is null order by id desc");
     $result->execute();
     return $result->fetchAll();
 }
 public function getRecordById($id)
{
    $result = $this->conn->prepare("select * from users where username = :id");
    $result->bindParam(':id', $id);
    $result->execute();
    return $result->fetch();
}
public function updateUserProfile($data, $id, $filename)
{

    $result = $this->conn->prepare("update users set image=:image where username =:id");

  
    $result->bindParam(':image', $filename);



    $result->bindParam(':id', $id);
    if ($result->execute()) {
        return true;
    } else {
        return false;
    }
}
}
?>