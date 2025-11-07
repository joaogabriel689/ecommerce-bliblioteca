<?php
        session_start();
        if (!isset($_SESSION['user']) || !isset($_SESSION['type'])) {

            header("Location: login.html");
            exit;
        }
        if ($_SESSION['type'] !== 'admin') {
            header("Location: index.php");
            exit;
        }
        include 'connection.php';

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
            header("Location: users.php?success=1");
        } else {
            header("Location: users.php?error=1");
        }
        exit;

?>