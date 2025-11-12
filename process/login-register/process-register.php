
<?php
    session_start();


    include '../../config/connection.php';
    include '../../class/usersclass.php';

    $name = $_POST["name"] ?? "";
    $email = $_POST["email"] ?? "";
    $adress = $_POST["adress"] ?? "";
    $pass = $_POST["password"] ?? "";
    $city = $_POST["city"] ?? "";
    $state = $_POST["state"] ?? "";
    $fone = $_POST["fone"] ?? "";

    
    
    if(empty($email) || empty($pass) || empty($name)){
        header("Location: ../../public/register.html");
        exit;

    }else{ 
        $user = new User($name,
            $email,
            $pass,
            $adress,
            $city,
            $state,
            $fone,
            $connection
        );
        $result = $user->register();

        if($result['status']==true){
            header("Location: ../../public/login.html");
            exit;
        }else{
            header("Location: ../../public/register.html");
            exit; 
        }
               
        
    }
?>