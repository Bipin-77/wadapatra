<?php

include_once "../config/Database.php";
class Budget{


 public $user='';
 public $email='';
 private $password='';
 public $connection;
 public $conn;
 public function __construct(){
    $this->connection = new Database();
    $this->conn=$this->connection->getConnection();
 }

public function searchBudget($search)
{
    $result = $this->conn->prepare ("select * from budgets where  id LIKE CONCAT('%', :search1, '%') OR name LIKE CONCAT('%', :search, '%')  ");
    $result->bindParam(':search1',$search['search']);
    $result->bindParam(':search',$search['search']);
    $result->execute();
    return $result->fetchAll();
}

public function listBudget()
{
$result = $this->conn->prepare("select * from budgets where deleted_at is null order by id desc");
$result->execute();
return $result->fetchAll();
}
public function addBudget($data ,$filename){
$result = $this->conn->prepare("insert into budgets (name,area,sector, budget,start,end,duration, progress,description,image) 
values (:name,:area,:sector,:budget,:start,:end,:duration,:progress,:desc,:image)");

$result->bindParam(':name', $data['name']);
$result->bindParam(':area', $data['area']);
$result->bindParam(':sector', $data['sector']);
$result->bindParam(':budget', $data['budget']);
$result->bindParam(':start', $data['start']);
$result->bindParam(':end', $data['end']);
$result->bindParam(':duration',$data['duration']);
$result->bindParam(':progress', $data['progress']);

$result->bindParam(':desc', $data['description']);
$result->bindParam(':image', $filename);

if($result->execute()){
return true;
}else{
return false;
}


}
public function getRecordById($id)
{
$result = $this->conn->prepare("select * from budgets where id = :id");
$result->bindParam(':id', $id);
$result->execute();
return $result->fetch();
}

public function updateBudget($data, $id)
{

$result = $this->conn->prepare("update budgets set name = :name,area=:area,sector=:sector,budget=:budget, start=:start,end=:end,duration=:duration,  progress=:progress,description=:desc where id =:id");

$result->bindParam(':name', $data['name']);
$result->bindParam(':area', $data['area']);
$result->bindParam(':sector', $data['sector']);
$result->bindParam(':budget', $data['budget']);
$result->bindParam(':start', $data['start']);
$result->bindParam(':end', $data['end']);

$result->bindParam(':duration',$data['duration']);
$result->bindParam(':progress', $data['progress']);

$result->bindParam(':desc', $data['description']);

$result->bindParam(':id', $id);
if($result->execute()){
return true;
}else{
return false;
}
}
public function deleteBudget($id){
$result = $this->conn->prepare("update budgets set deleted_at = :date where id = :id");
$result->bindParam(':date', date('Y-m-d H:i:s'));
$result->bindParam(':id', $id);
if($result->execute()){
return true;
}else{
return false;
}
}

}
?>