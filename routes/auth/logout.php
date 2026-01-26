<?php
session_start();
if (isset($_SESSION["user"]) == false) {
    http_response_code(400);
    echo json_encode(["status"=> false,"message"=> "User not logged in"]);
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
$logout = $content["logout"];
if ($logout === true) {
    $authcontroller = new AuthController();
    $action = $authcontroller->logout();
    if ($action["status"] === false) {
        http_response_code(400);
        echo json_encode(["status"=> false,"message"=> $action["message"]]);
    } else {
        http_response_code(200);
        echo json_encode(["status"=> true,"message"=> $action["message"]]);
        
    }
} else {
    http_response_code(400);
    echo json_encode(["status"=> false,"message"=> "Invalid logout request"]);
}