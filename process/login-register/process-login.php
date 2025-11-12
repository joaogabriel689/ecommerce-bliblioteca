<?php
    session_start();

    include '../../config/connection.php';
    include '../../class/usersclass.php';
    
    $email = $_POST["email"] ?? "";
    $pass = $_POST["password"] ?? "";

    if(empty($user) or empty($pass)){
        header("location: ../pulbic/login.html");
        exit;
    }else{
        $user = new User(email: $email, password: $pass, connection: $connection);
        $ressult = $user->login();
        if($result['status']==true){
            $_SESSION['name'] = $result['data'][0]['nome'];
            $_SESSION['email'] = $result['data'][0]['email'];

            
        }
    }
?>