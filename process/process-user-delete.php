<?php
    session_start();
    include '../../config/connection.php';
    $nick = $_POST['nickname'] ?? "";

    $sql = "DELETE FROM users WHERE nickname = ?;";

    $prep_query = $connection->prepare($sql);
    $prep_query->bind_param("s", $nick);
    $prep_query->execute();

    header("Location: ../../pulbic/users.php");

?>