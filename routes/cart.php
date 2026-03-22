<?php
session_start();

include("../controllers/PedidosController.php");
include("../controllers/ProductController.php");

if (!isset($_SESSION['user'])){
    http_response_code(401);
    echo json_encode([
        'status' => false,
        'message'=> 'login required'
    ]);
    exit();    
}

$pedidosController = new PedidosController();
$produtoscontroller = new ProductController();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {

    case 'GET':

        $pedidos = $pedidosController->show_cart($_SESSION['user']['id']);

        if ($pedidos['status'] == false) {
            http_response_code(400);
            echo json_encode([
                'status'=> false,
                'message'=> $pedidos['message']
            ]);
            exit();
        }

        http_response_code(200);
        echo json_encode([
            'status'=> true,
            'message'=> $pedidos['message'],
            'data' => $pedidos['data']
        ]);
        exit();


    case 'POST':

        if (!isset($_GET['product_id'])) {
            http_response_code(400);
            echo json_encode([
                'status'=> false,
                'message'=> 'product_id is required'
            ]);
            exit();
        }

        $product_id = $_GET['product_id'];

        $pedidos = $produtoscontroller->add_cartitem(
            $product_id,
            $_SESSION['user']['id']
        );

        if ($pedidos['status'] == false) {
            http_response_code(400);
            echo json_encode([
                'status'=> false,
                'message'=> $pedidos['message']
            ]);
            exit();
        }

        http_response_code(200);
        echo json_encode([
            'status'=> true,
            'message'=> $pedidos['message'],
            'data' => $pedidos['data']
        ]);
        exit();


    case 'PUT':

        http_response_code(501);
        echo json_encode([
            'status'=> false,
            'message'=> 'Not implemented'
        ]);
        exit();


    case 'DELETE':

        if (!isset($_GET['product_id'])) {
            http_response_code(400);
            echo json_encode([
                'status'=> false,
                'message'=> 'product_id is required'
            ]);
            exit();
        }

        $product_id = $_GET['product_id'];

        $pedidos = $pedidosController->updateStatus(
            $_SESSION['user']['id'],
            $product_id,
            'cancelado',
            0
        );

        if ($pedidos['status'] == false) {
            http_response_code(400);
            echo json_encode([
                'status'=> false,
                'message'=> $pedidos['message']
            ]);
            exit();
        }

        http_response_code(200);
        echo json_encode([
            'status'=> true,
            'message'=> $pedidos['message'],
            'data' => $pedidos['data']
        ]);
        exit();


    default:

        http_response_code(405);
        echo json_encode([
            'status'=> false,
            'message'=> 'Method not allowed'
        ]);
        exit();
}