<?php
include_once "../config/Database.php";
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


 
 public function registerPoll($data,$filename){
    $result = $this->conn->prepare("insert into polls (title,description,image) 
    values (:title,:description,:image)");
        
    $result->bindParam(':title', $data['title']);
    $result->bindParam(':description', $data['description']);
    
   
    $result->bindParam(':image', $filename);
    if($result->execute()){
        return true;
    }else{
        return false;
    }
    

}
public function getRecordById($id)
{
    $result = $this->conn->prepare("select * from polls where id = :id");
    $result->bindParam(':id', $id);
    $result->execute();
    return $result->fetch();
}

public function updatePolls($data, $id,$filename)
{
    
    $result = $this->conn->prepare("update polls set title = :name,description=:desc,image=:image where id =:id");

    $result->bindParam(':name', $data['title']);
    $result->bindParam(':desc', $data['description']);

    

    $result->bindParam(':id', $id);
    $result->bindParam('image', $filename);
    if($result->execute()){
        return true;
    }else{
        return false;
    }
}
public function deletePolls($id){
    $result = $this->conn->prepare("update polls set deleted_at = :date where id = :id");
    $result->bindParam(':date', date('Y-m-d H:i:s'));
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