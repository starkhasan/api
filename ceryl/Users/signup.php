<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../Profiles/Profile.php';
include_once '../Users/User.php';

$database = new Database();
$db = $database->getConnection();
$user = new User($db);
$profile = new Profile($db);
$data = json_decode(file_get_contents("php://input"));
if(validation($data)){
    $user->email = $data->email;
    $user->password = $data->password;
    if($user->userAvail()){
        http_response_code(200);
        echo json_encode(array("status"=>400,"message"=>"User already exist"));
    }else{
        $profile->email = $data->email;
        $profile->name = $data->first_name.' '.$data->last_name;
        $profile->birthday = "";
        $profile->image = "";
        $profile->address1 = "";
        $profile->address2 = "";
        $profile->pincode = 0;
        $profile->state = "";
        $profile->phone = "";

        if($profile->createProfile() && $user->createUser()){
            http_response_code(200);
            echo json_encode(array("status"=>200,"message"=>"User created sucessfully"));
        }else{
            http_response_code(200);
            echo json_encode(array("status"=>400,"message"=>"Unable to create user"));
        }
    }

}

function validation($data){
    if(empty($data->first_name)){
        http_response_code(200);
        echo json_encode(array("status"=>400,"message"=>"Please provide first name"));
        return false;
    }elseif(empty($data->last_name)){
        http_response_code(200);
        echo json_encode(array("status"=>400,"message"=>"Please provide last name"));
        return false;
    }elseif(empty($data->email)){
        http_response_code(200);
        echo json_encode(array("status"=>400,"message"=>"Please provide email"));
        return false;
    }elseif(empty($data->password)){
        http_response_code(200);
        echo json_encode(array("status"=>400,"message"=>"Please provide password"));
        return false;
    }else{
        return true;
    }
}
?>