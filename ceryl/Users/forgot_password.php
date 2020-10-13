<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
include_once '../config/database.php';
include_once '../Users/User.php';

$database = new Database();
$db = $database->getConnection();
$user = new User($db);
$data = json_decode(file_get_contents("php://input"));
if(!empty($data->email) && !empty($data->password)){
    $user->email = $data->email;
    $user->password = $data->password;
    if($user->userAvail()){
        if($user->passwordUpdate()){
            http_response_code(200);
            echo json_encode(array("status"=>200,"message"=>"Password updated sucessfully"));
        }else{
            http_response_code(200);
            echo json_encode(array("status"=>400,"message"=>"Unable to update password"));
        }
    }else{
        http_response_code(200);
        echo json_encode(array("status"=>400,"message"=>"User not found"));
    }
}else{
    http_response_code(200);
    echo json_encode(array("status"=>400,"message"=>"Please provide email and password"));
}
?>