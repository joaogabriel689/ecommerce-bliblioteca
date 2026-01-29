<?php
session_start();
include("../controllers/FavoritesController.php");
if (!isset($_SESSION['user'])){
    http_response_code(400);
    echo json_encode(['status' => false, 'message'=> 'login required']);
    exit();    
}
$favoritescontroller = new FavoritesController();
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case 'GET':
        $favorites = $favoritescontroller->getFavoritesByUser($_SESSION['user']['id']);
        if ($favorites['status'] == false) {
            http_response_code(400);
            echo json_encode(['status'=> false,'message'=> $favorites['message']]);
            exit();
        }
        http_response_code(200);
        echo json_encode(['status'=> true,'message'=> $favorites['message'], 'data' => $favorites['data']]);
        exit();
    case 'POST':
        $product_id = $_GET['product_id'];
        $favorite = $favoritescontroller->addFavorite($_SESSION['user']['id'], $product_id);
        if ($favorites['status'] == false) {
            http_response_code(400);
            echo json_encode(['status'=> false,'message'=> $favorites['message']]);
            exit();
        }
        http_response_code(200);
        echo json_encode(['status'=> true,'message'=> $favorites['message'], 'data' => $favorites['data']]);
        exit();
    case 'DELETE':
        $product_id = $_GET['product_id'];
        $favorite = $favoritescontroller->removeFavorite($_SESSION['user']['id'], $product_id);
        if ($favorites['status'] == false) {
            http_response_code(400);
            echo json_encode(['status'=> false,'message'=> $favorites['message']]);
            exit();
        }
        http_response_code(200);
        echo json_encode(['status'=> true,'message'=> $favorites['message'], 'data' => $favorites['data']]);
        exit();
}



