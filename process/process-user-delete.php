<?php
    session_start();
    include '../config/connection.php';
    include '../class/usersclass.php';
    $email = $_POST['email'] ?? "";

    User::delete_user($email, $connection);


    header("Location: ../../pulbic/users.php");

?>