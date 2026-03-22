<?php

session_start();

if (!isset($_SESSION['user'])){
    http_response_code(401);
    echo json_encode([
        'status' => false,
        'message'=> 'login required'
    ]);
    exit();    
}

if ($_SESSION['user']['group'] != 'admin'){
    http_response_code(403);
    echo json_encode([
        'status'=> false,
        'message'=> 'admin required'
    ]);
    exit();
}

include("../controllers/UserController.php");

$userController = new UserController();
$method = $_SERVER["REQUEST_METHOD"];

switch ($method) {

    case 'GET':

        $users = $userController->getAllUsers();

        if ($users == null){
            http_response_code(400);
            echo json_encode([
                "status"=> false,
                "message"=> "failed retrieved users"
            ]);
            exit();
        }

        http_response_code(200);
        echo json_encode([
            "status"=> true,
            "message"=> "success",
            'data' => $users
        ]);
        exit();


    case 'POST':

        // 🔥 UPDATE VIA POST (_method=PUT)
        if (isset($_POST['_method']) && $_POST['_method'] === 'PUT') {

            if (empty($_POST)) {
                http_response_code(400);
                echo json_encode([
                    "status" => false,
                    "message" => "no data sent"
                ]);
                exit();
            }

            $id = $_POST['id'] ?? null;
            $email = $_POST['email'] ?? null;

            if (!$id && !$email) {
                http_response_code(400);
                echo json_encode([
                    "status" => false,
                    "message" => "user id or email is required"
                ]);
                exit();
            }

            // 🔥 busca usuário
            if ($email) {
                $user = $userController->getUserByemail($email);
            } else {
                $user = $userController->getUserById($id);
            }

            if ($user == null) {
                http_response_code(404);
                echo json_encode([
                    "status" => false,
                    "message" => "user not found"
                ]);
                exit();
            }

            // 🔥 update com fallback
            $result = $userController->updateUser(
                $user['id'],
                $_POST['name']       ?? $user['name'],
                $_POST['cpf']        ?? $user['cpf'],
                $_POST['email']      ?? $user['email'],
                $_POST['password']   ?? null,
                $_POST['dataNasc']   ?? $user['dataNasc'],
                $_POST['phone']      ?? $user['phone'],
                $_POST['group_code'] ?? $user['group_code']
            );

            http_response_code($result['status'] ? 200 : 400);
            echo json_encode($result);
            exit();
        }

        // 🔥 CREATE (se quiser implementar depois)
        http_response_code(501);
        echo json_encode([
            "status" => false,
            "message" => "not implemented"
        ]);
        exit();


    case 'DELETE':

        if (!isset($_GET['id'])) {
            http_response_code(400);
            echo json_encode([
                'status' => false,
                'message' => 'id is required'
            ]);
            exit();
        }

        $id = $_GET['id'];

        $action = $userController->deleteUser($id);

        http_response_code($action['status'] ? 200 : 400);
        echo json_encode($action);
        exit();


    default:

        http_response_code(405);
        echo json_encode([
            'status' => false,
            'message' => 'method not allowed'
        ]);
        exit();
}