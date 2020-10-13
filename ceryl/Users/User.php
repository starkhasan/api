<?php
class User{
    private $conn;
    public $table_name = "user";
    public $email;
    public $password;
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function login(){
        $query = "SELECT * FROM user WHERE email = '$this->email'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $isLogin = false;
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            if($row['password'] == $this->password){
                $isLogin = true;
            }
        }
        return $isLogin;
    }

    function userAvail(){
        $query = "SELECT * FROM user";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $isUser = false;
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            if($row['email'] == $this->email){
                $isUser = true;
            }
        }
        return $isUser;
    }

    function createUser(){
        $query = "INSERT INTO user (email,password) VALUES('$this->email','$this->password')";
        $stmt = $this->conn->prepare($query);
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    function deleteUser(){
        $query = "DELETE FROM user WHERE email = '$this->email'";
        $stmt = $this->conn->prepare($query);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
}
?>