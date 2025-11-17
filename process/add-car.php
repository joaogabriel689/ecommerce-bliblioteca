<?php

session_start();
include "../config/connection.php";
include '../class/productclass.php';
if (!isset($_SESSION['orders'])) {
    $_SESSION['orders'] = [];
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
    $orders_ids =array_column($_SESSION['orders'], 'id');

        if(in_array($product_id, $orders_ids)){
            $index = array_search($product_id, $orders_ids);

            if ($index !== false) {
                $_SESSION['orders'][$index]['qtd'] += 1;
            }
        }else{
            $_SESSION['orders'][] = [
                'id' => $product_id,
                'name' => $product['nome'],
                'value' => $product['valor'],
                'qtd' => 1    
            ];
            

        }
    header('Location: ' . $previous_page);
    exit();
}



    