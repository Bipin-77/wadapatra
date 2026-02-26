<?php
include_once "config/Database.php";
class Users
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
    public function login($data)
    {
        $username = $data['username'];
        $password = md5($data['password']); //encrypt the password using md5


        $result = $this->conn->prepare("select * from users where username = :username and password= :pass");
        $result->bindParam(':username', $username);
        $result->bindParam(':pass', $password);
        $result->execute();

        $data = $result->fetch(PDO::FETCH_ASSOC);

        if ($result->rowCount() > 0) {
            if ($data['role'] == 'admin') {
                $_SESSION['username'] = $username;
                $_SESSION['is_admin'] = true;
                header('location:dashboard.php');
            } else {
                $_SESSION['username'] = $username;
                $_SESSION['is_user'] = true;
                header("Location:./index.php");
            }

        } else {
            echo "invalid username or password";
        }


    }
    public function logout()
    {


    }
    public function searchUser($search)
    {
        $result = $this->conn->prepare("select * from users where  id LIKE CONCAT('%', :search1, '%') OR name LIKE CONCAT('%', :search, '%')  ");
        $result->bindParam(':search1', $search['search']);
        $result->bindParam(':search', $search['search']);
        $result->execute();
        return $result->fetchAll();
    }

    public function listUser()
    {
        $result = $this->conn->prepare("select * from users where deleted_at is null order by id desc");
        $result->execute();
        return $result->fetchAll();
    }
    public function registerUser($data)
{
    $result = $this->conn->prepare("insert into users (name,username,password,email,address,contact,dob) 
    values (:name,:username,:password,:email,:address,:contact,:dob)");

    $result->bindParam(':name', $data['name']);
    $result->bindParam(':address', $data['address']);
    $result->bindParam(':email', $data['email']);
    $result->bindParam(':contact', $data['contact']);
    $result->bindParam(':password', md5($data['confirm']));
    $result->bindParam(':username', $data['username']);
    $result->bindParam(':dob', $data['dob']);
   
    if ($result->execute()) {
        return true;
    } else {
        return false;
    }
}
    public function register($data)

    {
        
        $result = $this->conn->prepare("insert into users (name,username,password, email,address, contact,dob) 
    values (:name,:username,:password,:email,:address,:contact,:dob,)");

        $result->bindParam(':name', $data['name']);
        $result->bindParam(':address', $data['address']);
        $result->bindParam(':email', $data['email']);
        $result->bindParam(':contact', $data['contact']);
        $result->bindParam(':password', md5($data['confirm']));
        $result->bindParam(':username', $data['username']);

        $result->bindParam(':dob', $data['dob']);
       
        if ($result->execute()) {
            return true;
        } else {
            return false;
        }


    }

    public function contact($data)
    {
        $result = $this->conn->prepare("INSERT INTO contactus(name, email, address, ward, tole, query, details) 
    VALUES (:name,:email,:address,:ward,:tole,:query,:details)");

        $result->bindParam(':name', $data['name']);
        $result->bindParam(':address', $data['address']);
        $result->bindParam(':email', $data['email']);
        $result->bindParam(':ward', $data['ward']);
        $result->bindParam(':tole', $data['tole']);
        $result->bindParam(':query', $data['query']);

        $result->bindParam(':details', $data['details']);

        if ($result->execute()) {
            return true;
        } else {
            return false;
        }


    }
    public function listBudgets()
    {
        $result = $this->conn->prepare("select * from budgets where deleted_at is null order by id desc");
        $result->execute();
        return $result->fetchAll();
    }
    public function getRecordById($id)
    {
        $result = $this->conn->prepare("select * from users where id = :id");
        $result->bindParam(':id', $id);
        $result->execute();
        return $result->fetch();
    }

    public function updateUser($data, $id)
    {

        $result = $this->conn->prepare("update users set name = :name,username=:username,password=:password,email=:email, address=:address,  contact=:contact,dob=:dob,role=:role where id =:id");

        $result->bindParam(':name', $data['name']);
        $result->bindParam(':address', $data['address']);
        $result->bindParam(':email', $data['email']);
        $result->bindParam(':contact', $data['contact']);
        $result->bindParam(':password', md5($data['password']));
        $result->bindParam(':username', $data['username']);

        $result->bindParam(':dob', $data['dob']);
        $result->bindParam(':role', $data['role']);
        $result->bindParam(':id', $id);
        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function deleteUser($id)
    {
        $result = $this->conn->prepare("update users set deleted_at = :date where id = :id");
        $result->bindParam(':date', date('Y-m-d H:i:s'));
        $result->bindParam(':id', $id);
        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function addEvents($data, $filename)
    {

        $result = $this->conn->prepare("insert into events (name,date,description,image) values(:name,:date,:desc,:image) ");

        $result->bindParam(':name', $data['name']);
        $result->bindParam(':date', $data['date']);
        $result->bindParam(':desc', $data['description']);
        $result->bindParam(':image', $filename);

        if ($result->execute()) {
            return true;

        } else {
            return false;
        }




    }




    public function addNotices($data)
    {
        $result = $this->conn->prepare("insert into notices (name,date,description) 
    values (:name,:date,:desc)");

        $result->bindParam(':name', $data['name']);
        $result->bindParam(':date', $data['date']);
        $result->bindParam(':desc', $data['description']);

        if ($result->execute()) {
            return true;
        } else {
            return false;
        }


    }
    public function listEvents()
    {
        $result = $this->conn->prepare("select * from events  where deleted_at is null order by id desc");
        $result->execute();
        return $result->fetchAll();
    }
    public function searchEvents($search)
    {
        $result = $this->conn->prepare("select * from events where  id LIKE CONCAT('%', :search1, '%') OR name LIKE CONCAT('%', :search, '%')  ");
        $result->bindParam(':search1', $search['search']);
        $result->bindParam(':search', $search['search']);
        $result->execute();
        return $result->fetchAll();



    }

    public function listNotices()
    {
        $result = $this->conn->prepare("select * from notices  where deleted_at is null order by id desc");
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
    public function listOfficials()
    {
        $result = $this->conn->prepare("select * from officials where deleted_at is null order by id desc");
        $result->execute();
        return $result->fetchAll();
    }

}
?>