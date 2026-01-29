<?php

session_start();
include("../controllers/PayInfoController.php");
if (!isset($_SESSION['user'])){
    http_response_code(400);
    echo json_encode(['status' => false, 'message'=> 'login required']);
    exit();    
}

$method = $_SERVER['REQUEST_METHOD'];
$payinfoconroller = new PayinfoController();

switch ($method) {
    case 'GET':
        $payments = $payinfoconroller->getPayinfoByUserId($_SESSION['user']['id']);
        if ($payments['status'] == false){
            http_response_code(400);
            echo json_encode(['status'=> false,'message'=> $payments['message']]);
            exit();
        }
        http_response_code(200);
        echo json_encode(['status'=> true,'message'=> $payments['message'], 'data'=> $payments['data']]);
        exit();
    case'POST':
        $body = file_get_contents('php://input');
        $content = json_decode($body, true);
        if (isset($content)){
            http_response_code(400);
            echo json_encode(['status'=> false,'message'=> 'JSON invalid']);
            exit();
        }
        $payment = $payinfoconroller->addpayinfo($_SESSION['user']['id'], $content);
        if ($payment['status'] == false){
            http_response_code(400);
            echo json_encode(['status'=> false,'message'=> $payment['message']]);
            exit();
        }
        http_response_code(200);
        echo json_encode(['status'=> true,'message'=> $payment['message'],'data'=> $payment['data']]);
        exit();
    case 'PUT':
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


        $payments = $payinfoconroller->getPayinfoByUserId($_SESSION['user']['id']);
        if ($payments['status'] == false){
            http_response_code(400);
            echo json_encode(['status'=> false,'message'=> $payments['message']]);
            exit();
        }

        $payinfoData = [
            'cartao'       => $content['cartao']       ?? ($payments['cartao']       ?? null),
            'codigo_cartao'  => $content['codigo_cartao']  ?? ($payments['codigo_cartao']  ?? null),
            'nome_titu'     => $content['nome_titu']     ?? ($payments['nome_titu']     ?? null),
            'validade'          => $content['validade']          ?? ($payments['validade']          ?? null),

        ];

        // Chama update
        $result = $payinfoconroller->updatepayinfo($_SESSION['user']['id'], $payinfoData);

        if ($result['status'] === false) {
            http_response_code(400);
        } else {
            http_response_code(200);
        }

        echo json_encode($result);
        exit();

        
}
