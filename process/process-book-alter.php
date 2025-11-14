<?php
        session_start();
        if (!isset($_SESSION['user']) || !isset($_SESSION['type'])) {

            header("Location: ../../public/login.html");
            exit;
        }
        if ($_SESSION['type'] !== 'admin') {
            header("Location: ../../public/index.php");
            exit;
        }
        include '../config/connection.php';
        include '../class/productclass.php';


        $name_new = $_POST['name'];
        $price = $_POST['price'];
        $describ = $_POST['describ'] ?? "";
        $stock = $_POST['stock'];

        $old_name = $_POST['old_name'];
        if (empty($name_new) || empty($price) || empty($stock) || empty($old_name)) {
            die("Preencha todos os campos obrigatórios");
        }
        $book = new Product($name, $qtd, $describ, $price, $connection);
        $response = $book->update($old_name);

        if ($response['status']==true) {
            header("Location: ../../admin/books.php?success=1");
        } else {
            header("Location: ../../admin/books.php?error=1");
        }
        exit;

?>
