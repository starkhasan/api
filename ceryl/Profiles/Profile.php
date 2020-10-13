<?php
class Profile{
    private $conn;
    public $table_name = "profile";
    public $email;
    public $phone;
    public $image;
    public $name;
    public $birthday;
    public $address1;
    public $address2;
    public $pincode;
    public $state;

    function __construct($db){
        $this->conn = $db;
    }

    function createProfile(){
        $query = "INSERT INTO profile(email, name,birthday,image,address1,address2,pincode,state,phone) VALUES ('$this->email','$this->name','$this->birthday','$this->image','$this->address1','$this->address2','$this->pincode','$this->state','$this->phone')";
        $stmt = $this->conn->prepare($query);
        if($stmt->execute()){
            return true;
        }
        return false;
    }

}
?>