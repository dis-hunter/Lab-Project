<?php
require_once 'Database.php';

class User{
    private $conn;
    public function __construct(){
        $database=new Database();
        $this->conn=$database->getConnection();
    }

    public function createUser($username, $email, $password){
        $query ="INSERT INTO users (email, username, password) VALUES (:email, :username, :password)";
        $stmt=$this->conn->prepare($query);

        $hashedPassword=password_hash($password, PASSWORD_BCRYPT);


        //binding parameters
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);

        if($stmt->execute()){
            return true;
    }else{
        return false;
    }
    }
    public function getUsers(){
        $query="SELECT * FROM users";
        $stmt=$this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}








?>