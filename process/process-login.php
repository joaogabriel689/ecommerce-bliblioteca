<?php
    session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include '../config/connection.php';
    include '../class/usersclass.php';
    
    $email = $_POST["email"] ?? "";
    $pass = $_POST["password"] ?? "";
    var_dump($email);

    if(empty($email) or empty($pass)){
        header("location: ../public/login.html");
        exit;
    }else{

        $user = new User(pass: $pass, email: $email, connection: $connection);

        $data = $user->login();

        if($data['status']==true){
            $result = $data['data'];
            $_SESSION['name'] = $result['nome'];
            $_SESSION['email'] = $result['email'];
            $_SESSION['adress'] = $result['endereco'];
            $_SESSION['state'] = $result['estado'];
            $_SESSION['city'] = $result['cidade'];
            $_SESSION['fone'] = $result['telefone'];
            $_SESSION['type'] = 'default';


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