<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  

include_once '../config/database.php';
include_once '../Users/User.php';
include_once '../Profiles/Profile.php';

$database = new Database();
$db = $database->getConnection();
$user = new User($db);
$profile = new Profile($db);

$data = $_GET['email'];
if(!empty($data)){
    $user->email = $data;
    if($user->userAvail()){
        $profile->email = $data;
        if($user->deleteUser() && $profile->deleteProfile()){
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