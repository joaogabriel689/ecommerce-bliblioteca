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
$_SESSION['orders'] = [];
$result = Product::select_product($name, $connection);

                
if($result['status'] == false){
    header('Location: ' . $previous_page);
    exit();
}else{
    $product = $result['data'];

        if(in_array($product['id_produto'], $_SESSION['order'])){
            $_SESSION['orders']['id']['qtd'] = $_SESSION['orders']['id']['qtd'] + 1; 
        }else{
            $_SESSION['orders']['id'] = $product['id_produto'];
            $_SESSION['orders']['id']['name'] = $product['nome'];
            $_SESSION['orders']['id']['value'] = $product['value'];
            $_SESSION['orders']['id']['qtd'] = 1;
            $subtotal = $_SESSION['orders']['id']['qtd'] * $_SESSION['orders']['id']['qtd'];
            $_SESSION['orders']['id']['subtotal'] = $subtotal;
            header('Location: ' . $previous_page);
            exit();

        }

}



    