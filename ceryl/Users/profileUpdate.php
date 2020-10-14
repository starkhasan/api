<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
include_once '../config/database.php';
include_once '../Users/User.php';
include_once '../Profiles/Profile.php';

$databse = new Database();
$db = $databse->getConnection();
$user = new User($db);
$profile = new Profile($db);

$data = json_decode(file_get_contents("php://input"));
if(!empty($data->email)){
    $user->email = $data->email;
    if($user->userAvail()){
        $profile->email = $data->email;
        $profile->name = $data->name;
        $profile->phone = $data->phone;
        $profile->image = $data->image;
        $profile->birthday = $data->birthday;
        $profile->address1 = $data->address1;
        $profile->address2 = $data->address2;
        $profile->pincode = $data->pincode;
        $profile->state = $data->state;

        if($profile->upgradeProfile()){
            http_response_code(200);
            echo json_encode(array("status"=>200,"message"=>"Profile sucessfully upgrade"));
        }else{
            http_response_code(200);
            echo json_encode(array("status"=>400,"message"=>"Unable to update profile"));
        }
        
    }else{
        http_response_code(200);
        echo json_encode(array("status"=>400,"message"=>"User not Found"));
    }
}else{
    http_response_code(200);
    echo json_encode(array("status"=>400,"message"=>"Invalid Email"));
}
?>