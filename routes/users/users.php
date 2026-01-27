<?php

session_start();

if (!isset($_SESSION['user'])){
    http_response_code(400);
    echo json_encode(['status' => false, 'message'=> 'login required']);
    exit();    
}
if ($_SESSION['user']['group'] != 'admin'){
    http_response_code(400);
    echo json_encode(['status'=> false,'message'=> 'admin required']);
    exit();
}
include("../../controllers/usercontroller.php");
$method = $_GET["method"];
$user = new UserController();
if ($method == "GET"){
$users = $user->getAllUsers();
    if ($users == null){
        http_response_code(400);
        echo json_encode(["status"=> false,"message"=> "failed retrivied users"]);
        exit();
    }else{
        http_response_code(200);
        echo json_encode(["status"=> true,"message"=> "sucess", 'data' => $users]);
        exit();
    }
}else if ($method == 'PUT'){

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
    if (!isset($content['id']) || isset($content['email'])) {
        http_response_code(400);
        echo json_encode([
            "status" => false,
            "message" => "User id or email is required"
        ]);
        exit();
    }

    $id = $content['id'];
    $email = $content['email'];

    // Busca usuário atual no banco
    if ($email == null || $email == '') {
        $user = $userController->getUserById($id);
    }else{
        $user = $userController->getUserByemail($id);
    }

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
    exit();
}else if ($method == 'DELETE'){
    $id = $content['id'];
    $action = $user->deleteUser($id);
    http_response_code(200);
    echo json_encode(['status' => true, 'message' => 'deleted sucess']);

}