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
        include '../../config/connection.php';

        $name_new = $_POST['name'];
        $price = $_POST['price'];
        $describ = $_POST['describ'] ?? "";
        $stock = $_POST['stock'];
        $image = $_POST['image'];

        $old_name = $_POST['old_name'];
        if (empty($name_new) || empty($price) || empty($stock) || empty($old_name)) {
            die("Preencha todos os campos obrigatórios");
        }

        $sql = "UPDATE books
                SET name = ?, price = ?, describ = ?, stock = ?, image = ?
                WHERE name = ?;";

        $alter_query = $connection->prepare($sql);





        $alter_query->bind_param("ssssss", $name_new, $price, $describ, $stock, $image, $old_name);

        $alter_query->execute();

        if ($alter_query->affected_rows > 0) {
            header("Location: ../../admin/books.php?success=1");
        } else {
            header("Location: ../../admin/books.php?error=1");
        }
        exit;

?>
