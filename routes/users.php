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
include("../controllers/UserController.php");
$method = $_SERVER["method"];
$userController = new UserController();
if ($method == "GET"){
$users = $userController->getAllUsers();
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

    // Deve existir id OU email
    if (
        (!isset($content['id']) || empty($content['id'])) &&
        (!isset($content['email']) || empty($content['email']))
    ) {
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
        $user = $userController->getUserByemail($email);
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
    $id = $_GET['id'];
    $action = $userController->deleteUser($id);
    http_response_code(200);
    echo json_encode(['status' => true, 'message' => 'deleted sucess']);

}