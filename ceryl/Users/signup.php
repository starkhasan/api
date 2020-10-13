<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '..config/database.php';
include_once '..Profiles/Profile.php';
include_once '..Users/User.php';

$database = new Database();
$db = $database->getConnection();
$user = new User($db);
$profile = new Profile($db);

$data = json_decode(file_get_contents("php://input"));

?>