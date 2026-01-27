<?php

// Inicia a sessão PHP
session_start();

/**
 * Verifica se o usuário já está logado
 * Impede o registro caso exista uma sessão ativa
 */
if (!isset($_SESSION["user"])) {
    http_response_code(400);
    echo json_encode([
        "status"  => false,
        "message" => "User not logged in"
    ]);
    exit();
}

// Importa o controller responsável pela autenticação
include("../../controllers/authcontroller.php");
include("../../controllers/usercontroller.php");

$usercontroller = new UserController();

$method = $_SERVER["REQUEST_METHOD"];
if ($method == "GET") {
    $user = $usercontroller->getUserById($_SESSION["user"]['id']);
    if ($user == null) {
        http_response_code(400);
        echo json_encode(['status'=>false, 'message'=> 'não foi possivel obter o usuario']);
        exit();
    }else{
        http_response_code(200);
        echo json_encode(['status'=>true,'message'=> 'user retrivied sucess', 'data' => $user]);
    }


}else if ($method === "PUT") {

    $body = file_get_contents("php://input");
    $content = json_decode($body, true);

    if ($content === null) {
        http_response_code(400);
        echo json_encode([
            "status" => false,
            "message" => "JSON inválido"
        ]);
        exit();
    }

    // ID é obrigatório
    if (!isset($content['id'])) {
        http_response_code(400);
        echo json_encode([
            "status" => false,
            "message" => "User id is required"
        ]);
        exit();
    }

    $id = $content['id'];

    // Busca usuário atual no banco
    $user = $userController->getUserById($id);

    if ($user == null) {
        http_response_code(404);
        echo json_encode([
            "status" => false,
            "message" => "User not found"
        ]);
        exit();
    }

    // Mantém dados antigos se não vier do front
    $name       = $content['name']       ?? $user['name'];
    $cpf        = $content['cpf']        ?? $user['cpf'];
    $email      = $content['email']      ?? $user['email'];
    $password   = $content['password']   ?? null; // só atualiza se vier
    $dataNasc   = $content['dataNasc']   ?? $user['dataNasc'];
    $phone      = $content['phone']      ?? $user['phone'];
    $group_code = $content['group_code'] ?? $user['group_code'];

    // Chama update
    $result = $userController->updateUser(
        $id,
        $name,
        $cpf,
        $email,
        $password,
        $dataNasc,
        $phone,
        $group_code
    );

    if ($result['status'] === false) {
        http_response_code(400);
    } else {
        http_response_code(200);
    }

    echo json_encode($result);
}else if ($method == 'DELETE'){
    $user = $userController->deleteUser($id);
    http_response_code(200);
    echo json_encode($user);
    exit();
}
