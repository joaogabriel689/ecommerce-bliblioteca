
<?php
    session_start();


    include 'connection.php';

    $name = $_POST["name"] ?? "";
    $age = $_POST["age"] ?? "";
    $user = $_POST["user"] ?? "";
    $pass = $_POST["password"] ?? "";
    $type = $_POST['type'] ?? "";
    
    if(empty($user) || empty($pass)){
        header("Location: register.html");
        exit;

    }else{ 
        $sql_check = "SELECT * FROM users WHERE nickname = ?;";
        $query_check = $connection->prepare($sql_check);
        $query_check->bind_param("s", $user);
        $query_check->execute();
        $result_check = $query_check->get_result();

        if ($result_check->num_rows > 0) {
            header("Location: register.html");
            exit;
        }
        $current_date = new DateTime();

        $date_for_query =  $current_date->modify("-$age years")->format('Y-m-d');

        $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
        if (empty($type)){
            $type = 'default';

        }else{
            $type = $_POST['type'];

        }

        $sql = "INSERT INTO users (name, age, nickname, password, type, date_of_register) 
        VALUES (?, ?, ?, ?, ?, NOW())";

        $prep_query = $connection->prepare($sql);
        $prep_query->bind_param("sssss",  $name, $date_for_query, $user, $pass_hash, $type);
        $prep_query->execute();

        
        if ($prep_query->affected_rows > 0) {
        
            header("Location: login.html");
            exit;
            
        } else {
            
            header("Location: register.html");
            exit;
        }
    }
?>