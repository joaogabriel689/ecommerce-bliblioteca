<?php
    session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include '../config/connection.php';
    include '../class/usersclass.php';
    
    $email = $_POST["email"] ?? "";
    $pass = $_POST["password"] ?? "";

    if(empty($email) or empty($pass)){
        header("location: ../public/login.html");
        exit;
    }else{

        $user = new User( pass: $pass, email: $email, connection: $connection);

        $result = $user->login();
        if($result['status']==true){
            $_SESSION['name'] = $result['data']['nome'];
            $_SESSION['email'] = $result['data']['email'];
            $_SESSION['adress'] = $result['data']['endereco'];
            $_SESSION['state'] = $result['data']['estado'];
            $_SESSION['city'] = $result['data']['cidade'];
            $_SESSION['fone'] = $result['data']['telefone'];
            if($_SESSION['email'] == 'admin@bliblioteca.com'){
                $_SESSION['type'] = 'admin';
                header("Location: ../admin/admin.php");
                exit;
            }else{
                $_SESSION['type'] = 'default';
                header("location: ../public/index.php");
                exit;               

            }


            
        }else{
            
            header("location: ../public/login.html?msg={$result['msg']}");
            exit;

        }
    }
?>