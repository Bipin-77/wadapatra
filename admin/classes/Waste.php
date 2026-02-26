<?php
include_once "../config/Database.php";
class Waste
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

    public function searchSchedule($search)
    {
       
    $query = "
        SELECT * FROM wastes WHERE id LIKE CONCAT('%', :search, '%') OR area LIKE CONCAT('%', :search, '%')
        UNION
        SELECT id, name FROM wastetips WHERE id LIKE CONCAT('%', :search, '%') OR name LIKE CONCAT('%', :search, '%')
        UNION
        SELECT id, name FROM wastenotices WHERE id LIKE CONCAT('%', :search, '%') OR name LIKE CONCAT('%', :search, '%')
    ";

    $result = $this->conn->prepare($query);
    $result->bindParam(':search', $search['search']);
    $result->execute();
    return $result->fetchAll();

    }


    public function listEco()
    {
        $result = $this->conn->prepare("select * from wastes where deleted_at is null order by id desc");
        $result->execute();
        return $result->fetchAll();
    }
    public function listEcoNotice()
    {
        $result = $this->conn->prepare("select * from wastenotices where deleted_at is null order by id desc");
        $result->execute();
        return $result->fetchAll();
    }
    public function listEcoTips()
    {
        $result = $this->conn->prepare("select * from wastetips where deleted_at is null order by id desc");
        $result->execute();
        return $result->fetchAll();
    }
    public function getRecordById($id)
    {
        $result = $this->conn->prepare("select * from wastes where id = :id");
        $result->bindParam(':id', $id);
        $result->execute();
        return $result->fetch();
    }
    public function deleteEco($id)
    {
        $result = $this->conn->prepare("update wastes set deleted_at = :date where id = :id");
        $result->bindParam(':date', date('Y-m-d H:i:s'));
        $result->bindParam(':id', $id);
        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function addEco($data)
    {

        $result = $this->conn->prepare("insert into wastes (area,day,start,end,fee) values(:area,:day,:start,:end,:fee) ");

        $result->bindParam(':area', $data['area']);
        $result->bindParam(':day', $data['day']);
        $result->bindParam(':start', $data['start']);
        $result->bindParam(':end', $data['end']);
        $result->bindParam(':fee', $data['fee']);
        if ($result->execute()) {
            return true;

        } else {
            return false;
        }
    }
    public function updateEco($data, $id)
    {

        $result = $this->conn->prepare("update wastes set area=:area,day=:day,start=:start,end=:end,fee=:fee where id=:id ");

        $result->bindParam(':area', $data['area']);
        $result->bindParam(':day', $data['day']);
        $result->bindParam(':start', $data['start']);
        $result->bindParam(':end', $data['end']);
        $result->bindParam(':fee', $data['fee']);
        $result->bindParam(':id', $id);
        if ($result->execute()) {
            return true;

        } else {
            return false;
        }
    }


    public function addEcoNotice($data)
    {

        $result = $this->conn->prepare("insert into wastenotices (name) values(:notice) ");

        $result->bindParam(':notice', $data['name']);
        // $result->bindParam(':fine', $data['fine']);


        if ($result->execute()) {
            return true;

        } else {
            return false;
        }
    }
    public function getRecordByIdEcoNotices($id)
    {
        $result = $this->conn->prepare("select * from wastenotices where id = :id");
        $result->bindParam(':id', $id);
        $result->execute();
        return $result->fetch();
    }
    public function updateEcoNotices($data ,$id)
    {

        $result = $this->conn->prepare("update  wastenotices set name= :tip where id=:id ");

        $result->bindParam(':tip', $data['name']);
        $result->bindParam(':id', $id);


        if ($result->execute()) {
            return true;

        } else {
            return false;
        }

    }
    public function deleteEcoNotice($id)
    {
        $result = $this->conn->prepare("update wastenotices set deleted_at = :date where id = :id");
        $result->bindParam(':date', date('Y-m-d H:i:s'));
        $result->bindParam(':id', $id);
        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function addEcoTips($data )
    {

        $result = $this->conn->prepare("insert into wastetips (name) values(:tip) ");

        $result->bindParam(':tip', $data['name']);


        if ($result->execute()) {
            return true;

        } else {
            return false;
        }

    }
    public function getRecordByIdecoTips($id)
    {
        $result = $this->conn->prepare("select * from wastetips where id = :id");
        $result->bindParam(':id', $id);
        $result->execute();
        return $result->fetch();
    }
    public function updateEcoTips($data,$id)
    {

        $result = $this->conn->prepare("update  wastetips set name= :tip where id=:id ");

        $result->bindParam(':tip', $data['name']);
        $result->bindParam(':id', $id);


        if ($result->execute()) {
            return true;

        } else {
            return false;
        }

    }
    public function deleteEcoTips($id)
    {
        $result = $this->conn->prepare("update wastetips set deleted_at = :date where id = :id");
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