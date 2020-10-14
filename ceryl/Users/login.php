<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../Users/User.php';
include_once '../Profiles/Profile.php';

$database = new Database();
$db = $database->getConnection();
$user = new User($db);
$profile = new Profile($db);
$data = json_decode(file_get_contents("php://input"));
if(!empty($data->email) && !empty($data->password)){
    $user->email = $data->email;
    $profile->email = $data->email;
    $user->password = $data->password;
    if($user->login()){
        $row = $profile->readProfile();
        http_response_code(200);
        $user_record = array();
        $user_record["status"] = 200;
        $user_record["message"] = "User login successfully";
        $user_record["User"] = array(
            "name" => $row['name'],
            "email" => $row['email']
        );
        echo json_encode($user_record);
    }else{
        http_response_code(200);
        echo json_encode(array("status"=>400,"message"=>"Invalid Email and Password."));
    }
}else{
    http_response_code(200);
    echo json_encode(array("status"=>400,"message"=>"Please provide email and password."));
}