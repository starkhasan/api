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

    function readProfile(){
        $query = "SELECT * FROM profile";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $userProfile = null;
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            if($row['email'] == $this->email){
                $userProfile = $row;
            }
        }
        return $userProfile;
    }

    function deleteProfile(){
        $query = "DELETE FROM profile WHERE email = '$this->email'";
        $stmt = $this->conn->prepare($query);
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    function upgradeProfile(){
        $query = "UPDATE profile SET phone = '$this->phone',image = '$this->image',name = '$this->name',birthday = '$this->birthday',address1 = '$this->address1',address2 = '$this->address2',pincode = '$this->pincode',state = '$this->state' WHERE email = '$this->email'";
        $stmt = $this->conn->prepare($query);
        if($stmt->execute()){
            return true;
        }
        return false;
    }

}
?>