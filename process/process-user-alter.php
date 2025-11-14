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
        include '../config/connection.php';
        include '../class/usersclass.php';
        $name = $_POST["name"] ?? "";
        $email = $_POST["email"] ?? "";
        $adress = $_POST["adress"] ?? "";
        $pass = $_POST["password"] ?? "";
        $city = $_POST["city"] ?? "";
        $state = $_POST["state"] ?? "";
        $fone = $_POST["fone"] ?? 0;

        $user = new User($email,
            $pass,
            $name,
            $adress,
            $city,
            $state,
            $fone,
            $connection
        );
        $result = $user->update_user();




        if ($result['status']==true) {
            header("Location: ../../admin/users.php?success=1");
        } else {
            header("Location: ../../admin/users.php?error=1");
        }
        exit;

?>