<?php
    session_start();
    include '../config/connection.php';
    include '../class/productclass.php';


    $name = $_POST['name']  ?? "";

    $price = $_POST['price']  ?? "";
    $describ = $_POST['describe']  ?? "";
    $stock = $_POST['stock']  ?? "";
    if (empty($name) || empty($price) || empty($describ) || empty($stock)) {
        die("Preencha todos os campos obrigatórios");
    }
    $book = new Product($name, $stock, $describ, $price, $connection);
    $book->add_product();

    header("location: ../admin/books.php");
    exit;






?>