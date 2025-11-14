<?php
    session_start();
    include '../config/connection.php';
    include '../class/productclass.php';

    $name = $_POST['name'] ?? "";

    product::delete_product($name, $connection);



    header("Location: ../../admin/books.php");





?>