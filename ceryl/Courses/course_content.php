<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../Java/java.php';
include_once '../Profiles/Profile.php';
include_once '../Users/User.php';

$database = new Database();
$db = $database->getConnection();
$java = new Java($db);
$data = json_decode(file_get_contents("php://input"));
if(!empty($data)){
    $course = $data->course;
    $java->title = $data->title;
    $row = $java->getContent();
    if($row>0){
        $course_content = array();
        $course_content["status"] = 200;
        $course_content["message"] = "Course Content of {$course}";
        $course_content["title"] = $row['title'];
        $course_content["content"] = array();

        $content1 = array(
            "content"=> $row["content1"],
            "image_content"=> $row["image_content1"]
        );
        array_push($course_content["content"], $content1);
        $content2 = array(
            "content"=> $row["content2"],
            "image_content"=> $row["image_content2"]
        );
        array_push($course_content["content"], $content2);

        $content3 = array(
            "content"=> $row["content3"],
            "image_content"=> $row["image_content3"]
        );
        array_push($course_content["content"], $content3);

        $content4 = array(
            "content"=> $row["content4"],
            "image_content"=> $row["image_content4"]
        );
        array_push($course_content["content"], $content4);

        $content5 = array(
            "content"=> $row["content5"],
            "imagecontent"=> $row["image_content5"]
        );
        array_push($course_content["content"], $content5);
        http_response_code(200);
        echo json_encode($course_content);
    }else{
        http_response_code(200);
        echo json_encode(array("status"=>400,"message"=>"Requesting Course is not available"));
    }
}else{
    http_response_code(200);
    echo json_encode(array("status"=>400,"message"=>"Invalid Course Type and Title"));
}
?>