<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
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
        $row = $profile->readProfile();
        $userProfile = array();
        $userProfile["status"] = 200;
        $userProfile["message"] = "User Profile";
        $userProfile["Profile"] = array(
            "email"=>$row['email'],
            "name"=>$row['name'],
            "phone"=>$row['phone'],
            "image"=>$row['image'],
            "birthday"=>$row['birthday'],
            "address1"=>$row['address1'],
            "address2"=>$row['address2'],
            "pincode"=>$row['pincode'],
            "state"=>$row['state']
        );
        http_response_code(200);
        echo json_encode($userProfile);
    }else{
        http_response_code(200);
        echo json_encode(array("status"=>400,"message"=>"User not Found"));
    }
}else{
    http_response_code(200);
    echo json_encode(array("status"=>400,"message"=>"Invalid Email"));
}
?>