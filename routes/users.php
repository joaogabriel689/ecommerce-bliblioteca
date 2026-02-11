<?php

session_start();

if (!isset($_SESSION['user'])) {
    http_response_code(401);
    echo json_encode(['status' => false, 'message'=> 'login required']);
    exit();
}

if ($_SESSION['user']['grupo'] != 1) { // ajuste conforme seu padrão
    http_response_code(403);
    echo json_encode(['status'=> false,'message'=> 'admin required']);
    exit();
}

include("../controllers/UserController.php");

$method = $_SERVER["REQUEST_METHOD"];
$userController = new UserController();

if ($method === "GET") {

    $users = $userController->getAllUsers();

    if (!$users) {
        http_response_code(400);
        echo json_encode(["status"=> false,"message"=> "failed retrieving users"]);
    } else {
        http_response_code(200);
        echo json_encode(["status"=> true,"message"=> "success", 'data' => $users]);
    }
    exit();
}

if ($method === "PUT") {

    $body = file_get_contents("php://input");
    $content = json_decode($body, true);

    if ($content === null) {
        http_response_code(400);
        echo json_encode(["status" => false,"message" => "Invalid JSON"]);
        exit();
    }

    $id = $content['id'] ?? null;
    $email = $content['email'] ?? null;

    if (!$id && !$email) {
        http_response_code(400);
        echo json_encode(["status" => false,"message" => "User id or email required"]);
        exit();
    }

    $user = $id 
        ? $userController->getUserById($id)
        : $userController->getUserByEmail($email);

    if (!$user) {
        http_response_code(404);
        echo json_encode(["status" => false,"message" => "User not found"]);
        exit();
    }

    $result = $userController->updateUser(
        $user['id'],
        $content['nome'] ?? $user['nome'],
        $content['cpf'] ?? $user['cpf'],
        $content['email'] ?? $user['email'],
        $content['password'] ?? null,
        $content['data_nasc'] ?? $user['data_nasc'],
        $content['telefone'] ?? $user['telefone'],
        $content['grupo'] ?? $user['grupo']
    );

    http_response_code($result['status'] ? 200 : 400);
    echo json_encode($result);
    exit();
}

if ($method === "DELETE") {

    $id = $_GET['id'] ?? null;

    if (!$id) {
        http_response_code(400);
        echo json_encode(["status" => false,"message" => "User id required"]);
        exit();
    }

    $result = $userController->deleteUser($id);

    http_response_code($result['status'] ? 200 : 400);
    echo json_encode($result);
    exit();
}

http_response_code(405);
echo json_encode(["status" => false,"message" => "Method not allowed"]);
