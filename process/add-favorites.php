<?php

session_start();
include "../config/connection.php";
include '../class/productclass.php';
if (!isset($_SESSION['email']) || !isset($_SESSION['type'])) {

    header("Location: /public/login.html");
    exit;
}
$previous_page = $_SERVER['HTTP_REFERER'];
$name = $_POST['name'];
$_SESSION['favorites'] = [];
$result = Product::select_product($name, $connection);

                
if($result['status'] == false){
    header('Location: ' . $previous_page);
    exit();
}else{
    $product = $result['data'];

        if(in_array($product['id_produto'], $_SESSION['order'])){
            return 'ja foi adicionado';
            header('Location: ' . $previous_page);
            exit();

        }else{
            $_SESSION['favorites']['id'] = $product['id_produto'];
            $_SESSION['favorites']['id']['name'] = $product['nome'];
            $_SESSION['favorites']['id']['value'] = $product['value'];
            header('Location: ' . $previous_page);
            exit();


        }



}

