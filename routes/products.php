<?php

include("../controllers/ProductController.php");

$method = $_SERVER['REQUEST_METHOD'];
$productController = new ProductController();

switch ($method) {

    case 'GET':

        // Filtros via query string
        $term    = $_GET['term']    ?? null;
        $filters = $_GET['filters'] ?? null;
        $id = $_GET['id'] ?? null;
        /**precisa criar os metodos de buscar a partir de um filtro, a aprtir de um termo e de um termo em produtos filtrados no controller */
        if ($id){
            $product = $productController->show_product($id);

        }else if ($term && $filters) {

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
        if (!isset($_SESSION['user'])){
            http_response_code(400);
            echo json_encode(['status' => false, 'message'=> 'login required']);
            exit();    
        }
        if ($_SESSION['user']['group'] != 'admin'){
            http_response_code(400);
            echo json_encode(['status'=> false,'message'=> 'admin required']);
            exit();
        }
        $body = file_get_contents('php://input');
        $content = json_decode($body, true);
        if ($content === null || empty($content)) {
            http_response_code(400);
            echo json_encode(['status'=> false,'message'=> 'JSON invalid']);
            exit();
        }
        /**
         * precisa tirar o vendas e o cliques do controller
         */
        $produtct = $productController->create_product(
            $content['name'],
            $content['tipo'],
            $content['valor'],
            $content['autor'],
            $content['clique'],
            $content['descriçao'],
            $content['paginas'],
            $content['idioma'],
            $content['vendas'],
            $content['estoque'],
            $content['img_path'],
            $content['editora'],
            $content['categoria']);
        if ($produtct === null) {
            http_response_code(400);
            echo json_encode(['status'=> false,'message'=> 'failed create product']);
            exit();
        }
        http_response_code(200);
        echo json_encode(['status'=> true,'message'=> 'sucess']);
        exit();
    case 'PUT':
        if (!isset($_SESSION['user'])){
            http_response_code(400);
            echo json_encode(['status' => false, 'message'=> 'login required']);
            exit();    
        }
        if ($_SESSION['user']['group'] != 'admin'){
            http_response_code(400);
            echo json_encode(['status'=> false,'message'=> 'admin required']);
            exit();
        }
        $body = file_get_contents('php://input');
        $content = json_decode($body, true);
        if ($content === null || empty($content)) {
            http_response_code(400);
            echo json_encode(['status'=> false,'message'=> 'JSON invalid']);
            exit();
        }
        $product = $productController->show_product($content['id']);
        if ($product === null) {
            http_response_code(400);
            echo json_encode(['status'=> false,'message'=> 'product not exists']);
            exit();
        }

        $nome = $content['nome'] ?? $product['nome'];
        $tipo = $content['tipo'] ?? $product['tipo'];
        $valor = $content['valor'] ?? $product['valor'];
        $autor = $content['autor'] ?? $product['autor'];
        $descricao = $content['descri'] ?? $product['descri'];
        $paginas = $content['paginas' ] ?? $product['paginas'];
        $idioma = $content['idioma'] ?? $product['idioma'];
        $img_path = $content['img_path'] ?? $product['img_path'];
        $editora = $content['editora'] ?? $product['editora'];
        $categoria = $content['categoria'] ?? $product['categoria'];

        $product_update = $productController->edit_product($content['id'],$nome, $tipo, $valor, $autor, $descricao, $paginas, $idioma, $img_path, $editora, $categoria);
        if ($product_update['status'] === false) {
            http_response_code(400);
            echo json_encode(['status'=> false,'message'=> $product_update['message']]);
            exit();
        }
        http_response_code(200);
        echo json_encode(['status'=> true,'message'=> $product_update['message']]);
    case 'DELETE':
        if (!isset($_SESSION['user'])){
            http_response_code(400);
            echo json_encode(['status' => false, 'message'=> 'login required']);
            exit();    
        }
        if ($_SESSION['user']['group'] != 'admin'){
            http_response_code(400);
            echo json_encode(['status'=> false,'message'=> 'admin required']);
            exit();
        }

        $body = file_get_contents('php://input');
        $content = json_decode($body, true);

        if ($content === null || empty($content)) {
            http_response_code(400);
            echo json_encode(['status'=> false,'message'=> 'JSON invalid']);
            exit();
        }
        $id = $_GET['id'];
        $product = $Productcontroller->delete_product($id);
        if ($product['status'] === false) {
            http_response_code(400);
            echo json_encode(['status'=> false,'message'=> $product['message']]);
            exit();
        }
        http_response_code(200);
        echo json_encode(['status'=> true,'message'=> $product['message']]);


    default:
        http_response_code(405);
        echo json_encode([
            'status' => false,
            'message' => 'Method not allowed'
        ]);
        exit();
}
