<?php

include_once "../config/Database.php";
class Officials
{


    public $user = '';
    public $email = '';
    private $password = '';
    public $connection;
    public $conn;
    public function __construct()
    {
        $this->connection = new Database();
        $this->conn = $this->connection->getConnection();
    }

    public function searchOfficials($search)
    {
        $result = $this->conn->prepare("select * from officials where  id LIKE CONCAT('%', :search1, '%') OR name LIKE CONCAT('%', :search, '%')  ");
        $result->bindParam(':search1', $search['search']);
        $result->bindParam(':search', $search['search']);
        $result->execute();
        return $result->fetchAll();
    }

    public function listOfficials()
    {
        $result = $this->conn->prepare("select * from officials where deleted_at is null order by id desc");
        $result->execute();
        return $result->fetchAll();
    }
    public function addOfficials($data, $filename)
    {


        $result = $this->conn->prepare("insert into officials (name,image,post,elected_date,end_date,details) values(:name,:image,:post,:elected,:end,:details) ");

        $result->bindParam(':name', $data['name']);
        $result->bindParam(':post', $data['post']);
        $result->bindParam(':elected', $data['elected_date']);
        $result->bindParam(':end', $data['end_date']);
        $result->bindParam(':details', $data['details']);
        $result->bindParam(':image', $filename);

        if ($result->execute()) {
            return true;

        } else {
            return false;
        }




    }
    public function getRecordById($id)
    {
        $result = $this->conn->prepare("select * from officials where id = :id");
        $result->bindParam(':id', $id);
        $result->execute();
        return $result->fetch();
    }

    public function updateOfficials($data, $id, $filename)
    {

        $result = $this->conn->prepare("update officials set name = :name,post=:post,image=:image,elected_date=:elected, end_date=:end,details=:details where id =:id");

        $result->bindParam(':name', $data['name']);
        $result->bindParam(':post', $data['post']);
        $result->bindParam(':elected', $data['elected_date']);
        $result->bindParam(':end', $data['end_date']);
        $result->bindParam(':details', $data['details']);
        $result->bindParam(':image', $filename);

  

        $result->bindParam(':id', $id);
        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function deleteOfficiLs($id)
    {
        $result = $this->conn->prepare("update officials set deleted_at = :date where id = :id");
        $result->bindParam(':date', date('Y-m-d H:i:s'));
        $result->bindParam(':id', $id);
        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }

}
?>