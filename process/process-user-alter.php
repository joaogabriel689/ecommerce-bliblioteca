<?php
        session_start();
        if (!isset($_SESSION['email']) || !isset($_SESSION['type'])) {

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
        $city = $_POST["city"] ?? "";
        $state = $_POST["state"] ?? "";
        $fone = $_POST["fone"] ?? 0;
        $old_email = $_POST['old_email'];
        $pass = '';
        var_dump($_POST);
        $user = new User(
            email: $email,
            pass: $pass,
            name: $name,
            adress: $adress,
            city: $city,
            state: $state,
            fone: (int)$fone,
            connection: $connection
        );
        
        $result = $user->update_user($old_email);        
        




        if ($result['status']==true) {
            header("Location: ../../admin/users.php?success=1");
        } else {
            header("Location: ../../admin/users.php?error=1");
        }
        exit;

?>