<?php
session_start();
if (isset($_SESSION["user"])) {
    http_response_code(400);
    echo json_encode(["status"=> false,"message"=> "User already logged in"]);
    exit();
}
include("../../controllers/authcontroller.php");
$body = file_get_contents('php://input');

$content = json_decode($body, true);

if (!$content) {
    http_response_code(400);
    echo json_encode(["status" => false, "message" => "Invalid JSON input"]);
    exit();
}
if (isset($content["email"]) == false || isset($content["password"]) == false ) {
    http_response_code(400);
    echo json_encode(["status" => false, "message" => "Missing required fields"]);
    exit();
}
$email = $content["email"];
$password = $content["password"];

$authcontroller = new AuthController();
$action = $authcontroller->login($email, $password);
if ($action['status'] == false) {
    http_response_code(400);
    echo json_encode(['status'=> false,'message'=> $action['message']]);
    exit();
} else {
    http_response_code(200);
    echo json_encode(['status'=> true,'message'=> $action['message'], 'data' => $action['data']]);
}