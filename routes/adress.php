<?php

session_start();
include("../controllers/AdressController.php");

include_once __DIR__ ."/../../utils/validators.php";
verifyLogin();

$method = $_POST['action'];
$_POST['action'] = null;

$adressconroller = new AdressController();

switch ($method) {
    case 'POST':
        $content = $_POST;


        if ($content === null || empty($content)){
            http_response_code(400);
            echo json_encode([
                'status'=> false,
                'message'=> 'Invalid input'
            ]);
            exit();
        }
        if (!isset($content['cep']) || !isset($content['numero'])){
            http_response_code(400);
            echo json_encode([
                'status'=> false,
                'message'=> 'é necessário o cep e o numero'
            ]);
            exit();
        }

        $adress = $adressconroller->addadress(
            $_SESSION['user']['id'],
            $content
        );

        if ($adress['status'] == false){
            http_response_code(400);
            echo json_encode([
                'status'=> false,
                'message'=> $adress['message']
            ]);
            exit();
        }

        http_response_code(200);
        echo json_encode([
            'status'=> true,
            'message'=> $adress['message'],
            'data'=> $adress['data']
        ]);
        exit();
    case 'PUT':
        $content = $_POST;

        if ($content === null || empty($content)){
            http_response_code(400);
            echo json_encode([
                'status'=> false,
                'message'=> 'Invalid input'
            ]);
            exit();
        }
        if (!isset($content['id']) || !isset($content['cep']) || !isset($content['numero'])){
            http_response_code(400);
            echo json_encode([
                'status'=> false,
                'message'=> 'é necessário o id, cep e o numero'
            ]);
            exit();
        }

        $adress = $adressconroller->editadress(
            $_SESSION['user']['id'],
            $content
        );

        if ($adress['status'] == false){
            http_response_code(400);
            echo json_encode([
                'status'=> false,
                'message'=> $adress['message']
            ]);
            exit();
        }

        http_response_code(200);
        echo json_encode([
            'status'=> true,
            'message'=> $adress['message'],
            'data'=> $adress['data']
        ]);
        exit();

    case 'DELETE':
        if (!isset($_GET['id'])) {
            http_response_code(400);
            echo json_encode([
                'status'=> false,
                'message'=> 'id is required'
            ]);
            exit();
        }
        

     default:
         http_response_code(405);
         echo json_encode([
             'status' => false,
             'message' => 'Method not allowed'
         ]);
         exit();
}