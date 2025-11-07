<?php
    session_start();
    include '../../config/connection.php';
    $name = $_POST['name'] ?? "";

    $sql = "DELETE FROM books WHERE name = ?;";

    $prep_query = $connection->prepare($sql);
    $prep_query->bind_param("s", $name);
    $prep_query->execute();

    header("Location: ../../admin/books.php");





?>