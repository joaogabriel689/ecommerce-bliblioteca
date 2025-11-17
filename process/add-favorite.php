<?php

session_start();
include "../config/connection.php";
include '../class/productclass.php';

if (!isset($_SESSION['favorites'])) {
    $_SESSION['favorites'] = [];
}

$previous_page = $_SERVER['HTTP_REFERER'];
$name = $_POST['name'];
$result = Product::select_product($name, $connection);

                
if($result['status'] == false){
    header('Location: ' . $previous_page);
    exit();
}else{
    $product = $result['data'][0];
    $product_id = $product['id_produto'];
    $favorites_ids =array_column($_SESSION['favorites'], 'id');

        if(in_array($product_id, $favorites_ids)){
            return 'ja foi adicionado';
            header('Location: ' . $previous_page);
            exit();

        }else{
            $_SESSION['favorites'][] = [
                'id' => $productId,
                'name' => $product['nome'],
                'value' => $product['valor']
            ];
            header('Location: ' . $previous_page);
            exit();


        }



}

