<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../Users/User.php';

$database = new Database();
$db = $database->getConnection();
$user = new User($db);
$data = json_decode(file_get_contents("php://input"));
if(!empty($data->email) && !empty($data->password)){
    $user->email = $data->email;
    $user->password = $data->password;
    if($user->login()){
        http_response_code(200);
        echo json_encode(array("status"=>200,"message"=>"User login successfully"));
    }else{
        http_response_code(200);
        echo json_encode(array("status"=>400,"message"=>"Invalid Email and Password."));
    }
}else{
    http_response_code(200);
    echo json_encode(array("status"=>400,"message"=>"Please provide email and password."));
}