<?php
class Profile{
    private $conn;
    public $email;
    public $phone;
    public $image;
    public $name;
    public $birthday;
    public $address1;
    public $address2;
    public $zipcode;
    public $state;

    function __constructor($db){
        $this->conn = $db;
    }

}
?>