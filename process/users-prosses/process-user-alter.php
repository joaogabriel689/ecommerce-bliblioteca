<?php
        session_start();
        if (!isset($_SESSION['user']) || !isset($_SESSION['type'])) {

            header("Location: ../../pulbic/login.html");
            exit;
        }
        if ($_SESSION['type'] !== 'admin') {
            header("Location: ../../pulbic/index.php");
            exit;
        }
        include '../../config/connection.php';
        $id = $_POST['id'];
        $name = $_POST['name'];
        $age = $_POST['age'] ?? "";
        $type = $_POST['type'];


        $sql = "UPDATE users
                SET name = ?, age = ?, type = ?
                WHERE id = ?;";

        $alter_query = $connection->prepare($sql);





        $alter_query->bind_param("sssi", $name, $age, $type, $id);

        $alter_query->execute();

        if ($alter_query->affected_rows > 0) {
            header("Location: ../../admin/users.php?success=1");
        } else {
            header("Location: ../../admin/users.php?error=1");
        }
        exit;

?>