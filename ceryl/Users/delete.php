<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/Users/User.php';
include_once '../config/database.php';
include_once '../config/Profiles/Profile.php';

$database = new Database();
$db = $database->getConnection();
$user = new User($db);
$profile = new Profile($db);

$data = $_GET['email'];
if(!empty($data)){
    $user->email = $data;
    if($user->userAvail()){
        $profile->email = $data;
        if($profile->deleteProfile() && $user->deleteUser()){
            http_response_code(200);
            echo json_encode(array("status"=>200,"message"=>"User Profile deleted successfully"));
        }else{
            http_response_code(200);
            echo json_encode(array("status"=>400,"message"=>"Unable to delete user"));
        }
    }else{
        http_response_code(200);
        echo json_encode(array("status"=>400,"message"=>"User not found"));
    }
}else{
    http_response_code(200);
    echo json_encode(array("status"=>400,"message"=>"Invalid Email"));
}
?>