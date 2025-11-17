<?php
        session_start();
        if (!isset($_SESSION['email']) || !isset($_SESSION['type'])) {

            header("Location: ../../public/login.html");
            exit;
        }
        if ($_SESSION['type'] !== 'admin') {
            header("Location: ../../public/index.php");
            exit;
        }
        include '../config/connection.php';
        include '../class/productclass.php';


        $old_name = $_POST['old_name'];
        $old_price = $_POST['old_price'];
        $old_describ = $_POST['old_describ'];
        $old_stock = $_POST['old_stock'];

        $new_name = $_POST['name'];
        $new_price = $_POST['price'];
        $new_describ = $_POST['describ'];
        $new_stock = $_POST['stock'];


        if ($new_name === "")    $new_name    = $old_name;
        if ($new_price === "")   $new_price   = $old_price;
        if ($new_describ === "") $new_describ = $old_describ;
        if ($new_stock === "")   $new_stock   = $old_stock;
        if (empty($old_name)) {
            die("Preencha todos os campos obrigatórios");
        }
        $book = new Product($new_name, $new_stock, $new_describ, $new_price, $connection);
        $response = $book->update_product($old_name);

        if ($response['status']==true) {
            header("Location: ../../admin/books.php?success=1");
        } else {
            header("Location: ../../admin/books.php?error=1");
        }
        exit;

?>
