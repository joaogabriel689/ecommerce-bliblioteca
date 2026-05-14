<?php

session_start();

include("../controllers/ProductController.php");
include_once __DIR__ ."/../../utils/validators.php";

$productController = new ProductController();
$method = $_POST['action'];


$uploadDir = "../estoque/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

switch ($method) {

    case 'GET':

        $term    = $_GET['term']    ?? null;
        $filters = $_GET['filters'] ?? null;
        $id      = $_GET['id']      ?? null;

        if ($id){
            $products = $productController->show_product($id);

        } else if ($term && $filters) {
            $products = $productController->list_products($term, $filters);

        } elseif ($filters) {
            $products = $productController->list_products(filters:$filters);

        } elseif ($term) {
            $products = $productController->list_products($term);

        } else {
            $products = $productController->list_products();
        }

        if ($products === null || empty($products)) {
            http_response_code(404);
            echo json_encode([
                'status' => false,
                'message' => 'Products not found'
            ]);
            exit();
        }

        http_response_code(200);
        echo json_encode([
            'status' => true,
            'message' => 'Products retrieved successfully',
            'data' => $products
        ]);
        exit();


    case 'POST':

        if (isset($_POST['_method']) && $_POST['_method'] === 'PUT') {

            verifyLogin();
            verifyRole('admin');



            if (empty($_POST['id'])) {
                http_response_code(400);
                echo json_encode(['status'=> false,'message'=> 'id required']);
                exit();
            }

            $product = $productController->show_product($_POST['id']);

            if ($product === null) {
                http_response_code(404);
                echo json_encode(['status'=> false,'message'=> 'product not exists']);
                exit();
            }


            $img_path = $product['img_path'];

            if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {

                $fileTmp  = $_FILES['image']['tmp_name'];
                $fileName = uniqid() . "_" . basename($_FILES['image']['name']);
                $destPath = $uploadDir . $fileName;

                if (move_uploaded_file($fileTmp, $destPath)) {
                    $img_path = "estoque/" . $fileName;
                }
            }

            $result = $productController->edit_product(
                $_POST['id'],
                $_POST['name'] ?? $product['name'],
                $_POST['tipo'] ?? $product['tipo'],
                $_POST['valor'] ?? $product['valor'],
                $_POST['autor'] ?? $product['autor'],
                $_POST['descriçao'] ?? $product['descriçao'],
                $_POST['paginas'] ?? $product['paginas'],
                $_POST['idioma'] ?? $product['idioma'],
                $img_path,
                $_POST['editora'] ?? $product['editora'],
                $_POST['categoria'] ?? $product['categoria']
            );

            http_response_code($result['status'] ? 200 : 400);
            echo json_encode($result);
            exit();
        }

        // 🔥 CREATE NORMAL

        if (!isset($_SESSION['user'])){
            http_response_code(401);
            echo json_encode(['status' => false, 'message'=> 'login required']);
            exit();    
        }

        verifyLogin();
        verifyRole('admin');

        if (empty($_POST)) {
            http_response_code(400);
            echo json_encode(['status'=> false,'message'=> 'no data sent']);
            exit();
        }

        // 🔥 upload de imagem
        $img_path = null;

        if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {

            $fileTmp  = $_FILES['image']['tmp_name'];
            $fileName = uniqid() . "_" . basename($_FILES['image']['name']);
            $destPath = $uploadDir . $fileName;

            if (move_uploaded_file($fileTmp, $destPath)) {
                $img_path = "estoque/" . $fileName;
            }
        }

        $product = $productController->create_product(
            $_POST['name'],
            $_POST['tipo'],
            $_POST['valor'],
            $_POST['autor'],
            $_POST['clique'],
            $_POST['descriçao'],
            $_POST['paginas'],
            $_POST['idioma'],
            $_POST['vendas'],
            $_POST['estoque'],
            $img_path,
            $_POST['editora'],
            $_POST['categoria']
        );

        http_response_code($product ? 200 : 400);
        echo json_encode([
            'status'=> (bool)$product,
            'message'=> $product ? 'success' : 'failed create product'
        ]);
        exit();


    case 'DELETE':

        if (!isset($_SESSION['user'])){
            http_response_code(401);
            echo json_encode(['status' => false, 'message'=> 'login required']);
            exit();    
        }

        verifyLogin();
        verifyRole('admin');

        $id = $_GET['id'] ?? null;

        if (!$id) {
            http_response_code(400);
            echo json_encode(['status'=> false,'message'=> 'id required']);
            exit();
        }

        $product = $productController->delete_product($id);

        http_response_code($product['status'] ? 200 : 400);
        echo json_encode($product);
        exit();


    default:

        http_response_code(405);
        echo json_encode([
            'status' => false,
            'message' => 'Method not allowed'
        ]);
        exit();
}