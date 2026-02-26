<?php
include_once "../config/Database.php";
class Emergency
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

    public function search($search)
    {
        $result = $this->conn->prepare("select * from econtactsbasic where  id LIKE CONCAT('%', :search1, '%') OR service LIKE CONCAT('%', :search, '%')  ");
        $result->bindParam(':search1', $search['search']);
        $result->bindParam(':search', $search['search']);
        $result->execute();
        return $result->fetchAll();
    }

    public function listBasic()
    {
        $result = $this->conn->prepare("select * from econtactsbasic where deleted_at is null order by id desc");
        $result->execute();
        return $result->fetchAll();
    }
    public function listPrivate()
    {
        $result = $this->conn->prepare("select * from econtactsprivate where deleted_at is null order by id desc");
        $result->execute();
        return $result->fetchAll();
    }
    public function getRecordById($id)
    {
        $result = $this->conn->prepare("select * from econtactsbasic where id = :id");
        $result->bindParam(':id', $id);
        $result->execute();
        return $result->fetch();
    }
    public function getRecordByIdPrivate($id)
    {
        $result = $this->conn->prepare("select * from econtactsprivate where id = :id");
        $result->bindParam(':id', $id);
        $result->execute();
        return $result->fetch();
    }
    public function deleteBasic($id)
    {
        $result = $this->conn->prepare("update econtactsbasic set deleted_at = :date where id = :id");
        $result->bindParam(':date', date('Y-m-d H:i:s'));
        $result->bindParam(':id', $id);
        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function deletePrivate($id)
    {
        $result = $this->conn->prepare("update econtactsprivate set deleted_at = :date where id = :id");
        $result->bindParam(':date', date('Y-m-d H:i:s'));
        $result->bindParam(':id', $id);
        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function addBasic($data)
    {

        $result = $this->conn->prepare("insert into econtactsbasic (service,contact) values(:service,:contact) ");

        $result->bindParam(':service', $data['service']);
        $result->bindParam(':contact', $data['contact']);
        if ($result->execute()) {
            return true;

        } else {
            return false;
        }




    }

    public function addPrivate($data)
    {

        $result = $this->conn->prepare("insert into econtactsprivate (service,address,contact) values(:service,:address,:contact) ");

        $result->bindParam(':service', $data['service']);
        $result->bindParam(':address', $data['address']);
        $result->bindParam(':contact', $data['contact']);


        if ($result->execute()) {
            return true;

        } else {
            return false;
        }





    }
    public function editPrivate( $data,$id){
        $result = $this->conn->prepare('update econtactsprivate set service=:service,address=:address,contact=:contact where id=:id');
        $result->bindParam(':id', $id);
        $result->bindParam(':service', $data['service']);
        $result->bindParam(':address', $data['address']);
        $result->bindParam(':contact', $data['contact']);


        if ($result->execute()) {
            return true;

        } else {
           return false;
        }
}
public function editBasic( $data,$id){
    $result = $this->conn->prepare('update econtactsbasic set service=:service,contact=:contact where id=:id');
    $result->bindParam(':id', $id);
    $result->bindParam(':service', $data['service']);
    $result->bindParam(':contact', $data['contact']);


    if ($result->execute()) {
        return true;

    } else {
       return false;
    }
}

}
?>