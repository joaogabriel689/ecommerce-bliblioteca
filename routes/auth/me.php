<?php  
session_start();

/**
 * Verifica se o usuário já está logado
 */
if (!isset($_SESSION["user"])) {
    http_response_code(400);
    echo json_encode([
        "status"  => false,
        "message" => "User not logged in"
    ]);
    exit();
}

include("../../controllers/authcontroller.php");
include("../../controllers/UserController.php");

$UserController = new UserController();

$method = $_SERVER["REQUEST_METHOD"];

if ($method == "GET") {

    $user = $UserController->getUserById($_SESSION["user"]['id']);

    if ($user == null) {
        http_response_code(400);
        echo json_encode([
            'status'=>false,
            'message'=> 'não foi possivel obter o usuario'
        ]);
        exit();
    } else {
        http_response_code(200);
        echo json_encode([
            'status'=>true,
            'message'=> 'user retrivied sucess',
            'data' => $user
        ]);
    }

} else if ($method === "POST") { //  ALTERADO DE PUT PARA POST

    //  AGORA USA $_POST EM VEZ DE JSON
    if (empty($_POST)) {
        http_response_code(400);
        echo json_encode([
            "status" => false,
            "message" => "Nenhum dado enviado"
        ]);
        exit();
    }

    $id = $_SESSION['user']['id'];

    // Busca usuário atual
    $user = $UserController->getUserById($id);

    if ($user == null) {
        http_response_code(404);
        echo json_encode([
            "status" => false,
            "message" => "User not found"
        ]);
        exit();
    }

    //  PEGA DADOS DO $_POST
    $name       = $_POST['name']       ?? $user['name'];
    $cpf        = $_POST['cpf']        ?? $user['cpf'];
    $email      = $_POST['email']      ?? $user['email'];
    $password   = $_POST['password']   ?? null;
    $dataNasc   = $_POST['dataNasc']   ?? $user['dataNasc'];
    $phone      = $_POST['phone']      ?? $user['phone'];
    $group_code = $_POST['group_code'] ?? $user['group_code'];

    $result = $UserController->updateUser(
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

} else if ($method == 'DELETE') {

    $user = $UserController->deleteUser($_SESSION['user']['id']);
    http_response_code(200);
    echo json_encode($user);
    exit();
}