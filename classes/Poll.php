<?php
include_once "config/Database.php";
class Poll{


 public $user='';
 public $email='';
 private $password='';
 public $connection;
 public $conn;
 public function __construct(){
    $this->connection = new Database();
    $this->conn=$this->connection->getConnection();
 }


 

public function getRecordById($id)
{
    $result = $this->conn->prepare("select * from polls where id = :id");
    $result->bindParam(':id', $id);
    $result->execute();
    return $result->fetch();
}


public function getRecords()
{
    $result = $this->conn->prepare("select * from polls");
    $result->execute();
    return $result->fetch();
}

public function updatePolls($data, $id, $usernme)
{
    $result = $this->conn->prepare("update polls set choice = :name,comment=:desc,username=:username where id =:id");

    $result->bindParam(':name', $data['poll1']);
    $result->bindParam(':desc', $data['comment']);


    
 $result->bindParam(':username', $usernme);
    $result->bindParam(':id', $id);
   
    if($result->execute()){
        return true;
    }else{
        return false;
    }
}


public function searchPolls($search)
        {
            $result = $this->conn->prepare ("select * from users where  id LIKE CONCAT('%', :search1, '%') OR name LIKE CONCAT('%', :search, '%')  ");
            $result->bindParam(':search1',$search['search']);
            $result->bindParam(':search',$search['search']);
            $result->execute();
            return $result->fetchAll();
 }

 public function listPolls()
 {
     $result = $this->conn->prepare("select * from polls where deleted_at is null order by id desc");
     $result->execute();
     return $result->fetchAll();
 }

 public function getTotalComments($pollId)
{
    $result = $this->conn->prepare("SELECT COUNT(comment) as total_comments FROM polls WHERE id = :id");
    $result->bindParam(':id', $pollId);
    $result->execute();
    $row = $result->fetch();
    return $row['total_comments'];

}

public function getTotalVotes($pollId)
{
    $result = $this->conn->prepare("SELECT COUNT(choice) as total_votes FROM polls WHERE id = :id");
    $result->bindParam(':id', $pollId);
    $result->execute();
    $row = $result->fetch();
    return $row['total_votes'];

}
}

?>