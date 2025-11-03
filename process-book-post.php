<?php
    session_start();
    include 'connection.php';


$name = $_POST['name'] ?? "";
    $name = $_POST['name']  ?? "";

    $price = $_POST['price']  ?? "";
    $file = $_FILES['file']  ?? null;
    $discrib = $_POST['describe']  ?? "";
    $stock = $_POST['stock']  ?? "";
    if (empty($name) || empty($price) || empty($discrib) || empty($stock)) {
        die("Preencha todos os campos obrigatórios");
    }


    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    if ($extension != 'jpg' && $extension != 'jpeg' && $extension != 'png') {
        die("Envie uma imagem válida");
    }else{

        move_uploaded_file($file['tmp_name'], 'uploads/'.$file['name']);
    }

    $sql = "INSERT INTO books (name, price, decrib, stock, image) VALUES (?, ?, ?, ?, ?);";

    $query = $connection->prepare($sql);
    $query->bind_param("sssis", $name, $price, $discrib, $stock, $file['name']);
    $query->execute();

    header("location: books.php");
    exit;






?>