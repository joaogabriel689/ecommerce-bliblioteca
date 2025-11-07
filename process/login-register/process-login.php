<?php
    session_start();

    include 'connection.php';
    
    $user = $_POST["user"] ?? "";
    $pass = $_POST["password"] ?? "";

    if(empty($user) or empty($pass)){
        header("location: login.html");
        exit;
    }else{
        $sql = "SELECT * FROM users where nickname = ? ;";

        $prep_query = $connection->prepare($sql);
        $prep_query->bind_param("s", $user);
        $prep_query->execute();

        $data = $prep_query->get_result();
    
        


        if ($data->num_rows > 0) {
            $response = $data->fetch_assoc();
            if (password_verify($pass, $response['password'])){
                $_SESSION['user'] = $user;
                $_SESSION['name'] = $response['name'];
                $_SESSION['type'] = $response['type'];
                if ($_SESSION['type'] == 'admin'){
                    header("Location: admin.php");

                }else{
                    header("Location: index.php");
                }
                exit;
            }else {
                header("location: register.html");
                exit;
            }

        }else{
            header("Location: register.html");
            exit;
        }
    }
?>