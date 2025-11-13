<?php
require_once '../config/connection.php';
require_once '../class/productsclass.php';

// Dados de exemplo
$name = "Camiseta Preta";
$qtd = 15;
$describ = "Camiseta de algodão com gola redonda";
$price = 49.90;

// Cria o objeto
$product = new Product($name, $qtd, $describ, $price, $connection);

// Teste de inserção
$result = $product->add_product();

if ($result['status']) {
    echo "<p style='color:green;'>✅ {$result['msg']}</p>";
} else {
    echo "<p style='color:red;'>❌ {$result['msg']}</p>";
}

// Mostra os produtos cadastrados
$all = Product::select_all_product($connection);
echo "<pre>";
print_r($all);
echo "</pre>";
