<?php

session_start();
include_once __DIR__ ."/../../utils/validators.php";

verifyLogin();


include("../controllers/UserController.php");
include("../controllers/AuthController.php");

$userController = new UserController();
$authController = new AuthController();
$method = $_POST['action'];

switch ($method) {
    case 'PUT':
        if($_SESSION['user']['group'] === 'admin' || $_SESSION['user']['id'] == ($_POST['id'] ?? null) || $_SESSION['user']['email'] == ($_POST['email'] ?? null)) {
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
        } else {
            http_response_code(403);
            echo json_encode([
                'status' => false,
                'message' => 'forbidden: only admin or the user himself can update the data'
            ]);
            exit();
        }



    case 'DELETE': 
       if (!isset($_GET['id'])) {
            http_response_code(400);
            echo json_encode([
                'status' => false,
                'message' => 'id is required'
            ]);
            exit();
        }
        if($_SESSION['user']['group'] === 'admin' || $_SESSION['user']['id'] == ($_POST['id'] ?? null) || $_SESSION['user']['email'] == ($_POST['email'] ?? null)) {
            $id = $_GET['id'];

            $action = $userController->deleteUser($id);

            http_response_code($action['status'] ? 200 : 400);
            echo json_encode($action);
            exit();
        } else {
            http_response_code(403);
            echo json_encode([
                'status' => false,
                'message' => 'forbidden: only admin or the user himself can delete the account'
            ]);
            exit();
        }




    case 'POST':
        if ($_SESSION['user']['group'] != 'admin'){
            http_response_code(403);
            echo json_encode([
                'status'=> false,
                'message'=> 'admin required'
            ]);
            exit();
        }
        if(isset($_POST['nome']) && isset($_POST['cpf']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['dataNasc']) && isset($_POST['phone']) && isset($_POST['group_code'])) {
            $result = $authcontroller->register(
                $_POST['nome'],
                $_POST['cpf'],
                $_POST['email'],
                $_POST['password'],
                $_POST['dataNasc'],
                $_POST['phone'],
                0, // compras inicia em 0
                $_POST['group_code']
            );

            http_response_code($result['status'] ? 201 : 400);
            echo json_encode($result);
            exit();
        } else {
            http_response_code(400);
            echo json_encode([
                'status' => false,
                'message' => 'missing required fields'
            ]);
            exit();
        }


    default:

        http_response_code(405);
        echo json_encode([
            'status' => false,
            'message' => 'method not allowed'
        ]);
        exit();
}