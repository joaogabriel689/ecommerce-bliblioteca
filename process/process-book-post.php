<?php
    session_start();
    include '../config/connection.php';
    include '../class/productclass.php';


    $name = $_POST['name']  ?? "";

    $price = $_POST['price']  ?? "";
    $discrib = $_POST['describe']  ?? "";
    $stock = $_POST['stock']  ?? "";
    if (empty($name) || empty($price) || empty($discrib) || empty($stock)) {
        die("Preencha todos os campos obrigatórios");
    }
    $book = new Product($name, $stock, $describ, $stock, $connection);
    $book->add_product();

    header("location: ../admin/books.php");
    exit;






?>