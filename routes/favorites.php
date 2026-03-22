<?php

session_start();

include("../controllers/FavoritesController.php");

if (!isset($_SESSION['user'])){
    http_response_code(401);
    echo json_encode([
        'status' => false,
        'message'=> 'login required'
    ]);
    exit();    
}

$favoritescontroller = new FavoritesController();
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {

    case 'GET':

        $favorites = $favoritescontroller->getFavoritesByUser($_SESSION['user']['id']);

        if ($favorites['status'] == false) {
            http_response_code(400);
            echo json_encode([
                'status'=> false,
                'message'=> $favorites['message']
            ]);
            exit();
        }

        http_response_code(200);
        echo json_encode([
            'status'=> true,
            'message'=> $favorites['message'],
            'data' => $favorites['data']
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

        $favorite = $favoritescontroller->addFavorite(
            $_SESSION['user']['id'],
            $product_id
        );

        if ($favorite['status'] == false) { // 🔥 corrigido
            http_response_code(400);
            echo json_encode([
                'status'=> false,
                'message'=> $favorite['message']
            ]);
            exit();
        }

        http_response_code(200);
        echo json_encode([
            'status'=> true,
            'message'=> $favorite['message'],
            'data' => $favorite['data']
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

        $favorite = $favoritescontroller->removeFavorite(
            $_SESSION['user']['id'],
            $product_id
        );

        if ($favorite['status'] == false) { // 🔥 corrigido
            http_response_code(400);
            echo json_encode([
                'status'=> false,
                'message'=> $favorite['message']
            ]);
            exit();
        }

        http_response_code(200);
        echo json_encode([
            'status'=> true,
            'message'=> $favorite['message'],
            'data' => $favorite['data']
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



