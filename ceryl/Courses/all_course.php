<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 

include_once '../config/database.php';
include_once '../Courses/Course.php';

$database = new Database();
$db = $database->getConnection();
$course = new Course($db);
$num = $course->getCourse();
if(sizeof($num) > 0){
    $userCourse = array();
    $userCourse["status"] = 200;
    $userCourse["message"] = "All User Courses";
    $userCourse["courses"] = $num;
    http_response_code(200);
    echo json_encode($userCourse);
}else{
    http_response_code(200);
    echo json_encode(array("status"=>400,"message"=>"No Course Available"));
}
?>