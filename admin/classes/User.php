<?php
include_once "../config/Database.php";
class User{


 public $user='';
 public $email='';
 private $password='';
 public $connection;
 public $conn;
 public function __construct(){
    $this->connection = new Database();
    $this->conn=$this->connection->getConnection();
 }
 public function login($data){
    $username=$data['username'];
    $password=md5($data['password']); //encrypt the password using md5

    
    $result=$this->conn->prepare("select * from users where username = :username and password= :pass");
    $result->bindParam(':username',$username);
    $result->bindParam(':pass',$password);
    $result->execute();

    $data =$result->fetch(PDO::FETCH_ASSOC);

    if ($result->rowCount()>0){
        if($data['role']=='admin'){
            $_SESSION ['username']=$username;
            $_SESSION['is_admin']=true;
            header('location:dashboard.php');
        }else{
            $_SESSION['username']=$username;
            $_SESSION['is_user']=true;
             header("Location:../index.php");
            echo "admin not available please enter admin credintials";
        }
        
    }else{
        echo "invalid username or password";
    }
    

 }
 public function logout(){
    

 }
 public function searchUser($search)
        {
            $result = $this->conn->prepare ("select * from users where  id LIKE CONCAT('%', :search1, '%') OR name LIKE CONCAT('%', :search, '%')  ");
            $result->bindParam(':search1',$search['search']);
            $result->bindParam(':search',$search['search']);
            $result->execute();
            return $result->fetchAll();
 }

 public function listUser()
 {
     $result = $this->conn->prepare("select * from users where deleted_at is null order by id desc");
     $result->execute();
     return $result->fetchAll();
 }
 public function register($data,$filename){
    $result = $this->conn->prepare("insert into users (name,username,password, email,address, contact,dob,role,image) 
    values (:name,:username,:password,:email,:address,:contact,:dob,:role ,:image)");
        
    $result->bindParam(':name', $data['name']);
    $result->bindParam(':address', $data['address']);
    $result->bindParam(':email', $data['email']);
    $result->bindParam(':contact', $data['contact']);
    $result->bindParam(':password', md5($data['password']));
    $result->bindParam(':username', $data['username']);
    
    $result->bindParam(':dob', $data['dob']);
    $result->bindParam(':role', $data['role']);
    $result->bindParam(':image', $filename);
    if($result->execute()){
        return true;
    }else{
        return false;
    }
    

}
public function getRecordById($id)
{
    $result = $this->conn->prepare("select * from users where id = :id");
    $result->bindParam(':id', $id);
    $result->execute();
    return $result->fetch();
}

public function updateUser($data, $id,$filename)
{
    
    $result = $this->conn->prepare("update users set name = :name,username=:username,password=:password,email=:email, address=:address,  contact=:contact,dob=:dob,role=:role,image=:image where id =:id");

    $result->bindParam(':name', $data['name']);
    $result->bindParam(':address', $data['address']);
    $result->bindParam(':email', $data['email']);
    $result->bindParam(':contact', $data['contact']);
    $result->bindParam(':password', md5($data['password']));
    $result->bindParam(':username', $data['username']);
    
    $result->bindParam(':dob', $data['dob']);
    $result->bindParam(':role', $data['role']);
    $result->bindParam(':id', $id);
    $result->bindParam('image', $filename);
    if($result->execute()){
        return true;
    }else{
        return false;
    }
}
public function deleteUser($id){
    $result = $this->conn->prepare("update users set deleted_at = :date where id = :id");
    $result->bindParam(':date', date('Y-m-d H:i:s'));
    $result->bindParam(':id', $id);
    if($result->execute()){
        return true;
    }else{
        return false;
    }
}

public function getRecordByIdEvents($id)
{
    $result = $this->conn->prepare("select * from events where id = :id");
    $result->bindParam(':id', $id);
    $result->execute();
    return $result->fetch();
}
public function addEvents($data, $filename)
{
                
                $result = $this->conn->prepare("insert into events (name,date,description,image) values(:name,:date,:desc,:image) ");

                $result->bindParam(':name', $data['name']);
                $result->bindParam(':date', $data['date']);
                $result->bindParam(':desc', $data['description']);
                $result->bindParam(':image', $filename);
                
                if($result->execute()){
                    return true;
                    
                }else{
                    return false;
                }
                
            
        
    
    }

    public function updateEvents($data, $id, $filename)
    {

        $result = $this->conn->prepare("update events set name = :name,date=:date,image=:image,description=:desc where id =:id");

        $result->bindParam(':name', $data['name']);
        $result->bindParam(':date', $data['date']);
        $result->bindParam(':desc', $data['description']);
        $result->bindParam(':image', $filename);

  

        $result->bindParam(':id', $id);
        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteEvents($id){
        $result = $this->conn->prepare("update events set deleted_at = :date where id = :id");
        $result->bindParam(':date', date('Y-m-d H:i:s'));
        $result->bindParam(':id', $id);
        if($result->execute()){
            return true;
        }else{
            return false;
        }
    }
    
    

    public function getRecordByIdNotices($id)
    {
        $result = $this->conn->prepare("select * from notices where id = :id");
        $result->bindParam(':id', $id);
        $result->execute();
        return $result->fetch();
    }
public function addNotices($data){
    $result = $this->conn->prepare("insert into notices (name,date,description) 
    values (:name,:date,:desc)");
        
    $result->bindParam(':name', $data['name']);
    $result->bindParam(':date', $data['date']);
    $result->bindParam(':desc', $data['description']);
    
    if($result->execute()){
        return true;
    }else{
        return false;
    }
    

}
public function updateNotices($data,$id){
    $result = $this->conn->prepare("update notices  set name=:name,date=:date,description=:desc where id=:id ");
        
    $result->bindParam(':name', $data['name']);
    $result->bindParam(':date', $data['date']);
    $result->bindParam(':desc', $data['description']);
    $result->bindParam(':id', $id);
    
    if($result->execute()){
        return true;
    }else{
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
            $result = $this->conn->prepare ("select * from events where  id LIKE CONCAT('%', :search1, '%') OR name LIKE CONCAT('%', :search, '%')  ");
            $result->bindParam(':search1',$search['search']);
            $result->bindParam(':search',$search['search']);
            $result->execute();
            return $result->fetchAll();
 }

public function listNotices()
{
    $result = $this->conn->prepare("select * from notices  where deleted_at is null order by id desc");
    $result->execute();
    return $result->fetchAll();
}
public function deleteNotices($id){
    $result = $this->conn->prepare("update notices set deleted_at = :date where id = :id");
    $result->bindParam(':date', date('Y-m-d H:i:s'));
    $result->bindParam(':id', $id);
    if($result->execute()){
        return true;
    }else{
        return false;
    }
}
public function searchNotices($search)
        {
            $result = $this->conn->prepare ("select * from notices where  id LIKE CONCAT('%', :search1, '%') OR name LIKE CONCAT('%', :search, '%')  ");
            $result->bindParam(':search1',$search['search']);
            $result->bindParam(':search',$search['search']);
            $result->execute();
            return $result->fetchAll();
 }
 public function searchMessages($search)
 {
     $result = $this->conn->prepare ("select * from contactus where  query LIKE CONCAT('%', :search1, '%') OR name LIKE CONCAT('%', :search, '%')  ");
     $result->bindParam(':search1',$search['search']);
     $result->bindParam(':search',$search['search']);
     $result->execute();
     return $result->fetchAll();
}
public function listMessages()
{
    $result = $this->conn->prepare("select * from contactus  where deleted_at is null order by email desc");
    $result->execute();
    return $result->fetchAll();
}

public function deletMessage($email){
    $result = $this->conn->prepare("update contactus set deleted_at = :date where email = :id");
    $result->bindParam(':date', date('Y-m-d H:i:s'));
    $result->bindParam(':id', $email);
    if($result->execute()){
        return true;
    }else{
        return false;
    }
}
public function addMessages($data){
    $result = $this->conn->prepare("insert into contactus (name,email,address,ward,tole,query,details) 
    values (:name,:email,:address,:ward,:tole,:query,:details)");
        
    $result->bindParam(':name', $data['name']);
    $result->bindParam(':email', $data['email']);
    $result->bindParam(':address', $data['address']);
    $result->bindParam(':ward', $data['ward']);
    $result->bindParam(':tole', $data['tole']);
    $result->bindParam(':query', $data['query']);
    $result->bindParam(':details', $data['details']);
    
    if($result->execute()){
        return true;
    }else{
        return false;
    }
    

}
public function getTotalUser()
{
    $result = $this->conn->prepare("SELECT COUNT(username) as total_users FROM users WHERE deleted_at is null");
    $result->execute();
    $row = $result->fetch();
    return $row['total_users'];

}
public function getTotalEvents()
{
    $result = $this->conn->prepare("SELECT COUNT(id) as total_events FROM events WHERE deleted_at is null");
    
    $result->execute();
    $row = $result->fetch();
    return $row['total_events'];

}
public function getTotalNotices()
{
    $result = $this->conn->prepare("SELECT COUNT(id) as total_notices FROM notices WHERE deleted_at is null");
   
    $result->execute();
    $row = $result->fetch();
    return $row['total_notices'];

}
public function getTotalComments($pollId)
{
    $result = $this->conn->prepare("SELECT COUNT(comment) as total_comments FROM polls WHERE id = :id");
    $result->bindParam(':id', $pollId);
    $result->execute();
    $row = $result->fetch();
    return $row['total_comments'];

}

}
?>