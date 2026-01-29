<?php

include("../controllers/ProductController.php");


$productController = new ProductController();

$featuredproducts = $productController->index();

if ($featuredproducts['status'] != true) {
    http_response_code(404);
    echo json_encode(array('status'=> false,'message'=> 'not exists'));
    exit();
}
http_response_code(200);
echo json_encode(array('status'=> true,'message'=> 'sucess', 'data'=> $featuredproducts['data']));
exit();
    