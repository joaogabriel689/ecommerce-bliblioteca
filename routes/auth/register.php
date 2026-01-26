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

if (!$content ) {
    http_response_code(400);
    echo json_encode(["status" => false, "message" => "Invalid JSON input"]);
    exit();
}
if (isset($content["nome"]) == false || isset($content["email"]) == false || isset($content["cpf"]) == false || isset($content["password"]) == false || isset($content["data_nascimento"]) == false || isset($content["phone"]) == false ) {
    http_response_code(400);
    echo json_encode(["status" => false, "message" => "Missing required fields"]);
    exit();
}
$nome = $content["nome"];
$email = $content["email"];
$cpf = $content["cpf"];
$senha = $content["password"];
$data_nascimento = $content["data_nascimento"];
$phone= $content["phone"];

$authcontroller = new AuthController();
$action = $authcontroller->register($nome, $email, $cpf, $senha, $data_nascimento, $phone, 0, "cliente");
if ($action["status"] === false) {
    http_response_code(400);
    echo json_encode(["status"=> false,"message"=> $action["message"]]);
} else {
    http_response_code(200);
    echo json_encode(["status"=> true,"message"=> $action["message"], "data" => $action["data"]]);
    
}