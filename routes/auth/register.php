<?php

session_start();

if (isset($_SESSION["user"])) {
    http_response_code(400);
    echo json_encode([
        "status"  => false,
        "message" => "User already logged in"
    ]);
    exit();
}

include("../../controllers/authcontroller.php");

//  AGORA USA $_POST
if (empty($_POST)) {
    http_response_code(400);
    echo json_encode([
        "status"  => false,
        "message" => "Nenhum dado enviado"
    ]);
    exit();
}

//  VALIDA CAMPOS
if (
    !isset($_POST["nome"]) ||
    !isset($_POST["email"]) ||
    !isset($_POST["cpf"]) ||
    !isset($_POST["password"]) ||
    !isset($_POST["data_nascimento"]) ||
    !isset($_POST["phone"])
) {
    http_response_code(400);
    echo json_encode([
        "status"  => false,
        "message" => "Missing required fields"
    ]);
    exit();
}

//  ATRIBUIÇÃO DIRETA DO $_POST
$nome             = $_POST["nome"];
$email            = $_POST["email"];
$cpf              = $_POST["cpf"];
$senha            = $_POST["password"];
$data_nascimento  = $_POST["data_nascimento"];
$phone            = $_POST["phone"];

$authcontroller = new AuthController();

$action = $authcontroller->register(
    $nome,
    $email,
    $cpf,
    $senha,
    $data_nascimento,
    $phone,
    0,
    "cliente"
);

if ($action["status"] === false) {

    http_response_code(400);
    echo json_encode([
        "status"  => false,
        "message" => $action["message"]
    ]);

} else {

    http_response_code(200);
    echo json_encode([
        "status"  => true,
        "message" => $action["message"],
    ]);
}