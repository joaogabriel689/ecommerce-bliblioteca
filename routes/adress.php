<?php

session_start();
include("../controllers/AdressController.php");
if (!isset($_SESSION['user'])){
    http_response_code(400);
    echo json_encode(['status' => false, 'message'=> 'login required']);
    exit();    
}

$method = $_SERVER['REQUEST_METHOD'];
$adressconroller = new AdressController();

switch ($method) {
    case 'GET':
        $adress = $adressconroller->getAdressesByUserId($_SESSION['user']['id']);
        if ($adress['status'] == false){
            http_response_code(400);
            echo json_encode(['status'=> false,'message'=> $adress['message']]);
            exit();
        }
        http_response_code(200);
        echo json_encode(['status'=> true,'message'=> $adress['message'], 'data'=> $adress['data']]);
        exit();
    case'POST':
        $body = file_get_contents('php://input');
        $content = json_decode($body, true);
        if (!isset($content)){
            http_response_code(400);
            echo json_encode(['status'=> false,'message'=> 'JSON invalid']);
            exit();
        }
        if (!isset($content['cep']) && !isset($content['numero'])){
            http_response_code(400);
            echo json_encode(['status'=> false,'message'=> 'cep and number requireds']);
            exit();
        }
        $adress = $adressconroller->addadress($_SESSION['user']['id'], $content);
        if ($adress['status'] == false){
            http_response_code(400);
            echo json_encode(['status'=> false,'message'=> $adress['message']]);
            exit();
        }
        http_response_code(200);
        echo json_encode(['status'=> true,'message'=> $adress['message'],'data'=> $adress['data']]);
        exit();
}