<?php
include("../config/connection.php");
include("../models/usermodel.php");

class authrepository{
    private $connection;

    public function __construct($connection){
        $this->connection = $connection;
    }

    public function authenticate($user){
        $username = $user->username;
        $password = $user->password;
        $stmt = $this->connection->prepare('SELECT * FROM users WHERE name = :name');
        $stmt->bindParam(':name', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $user_logged = new usermodel(
                $user['id'],
                $user['name'],
                $user['data_nasc'],
                $user['phone'],
                $user['compras'],
                $user['group_user'],
                $user['codigo'],
                $user['password']
            );
            return $user_logged;
        }
        return null;
    }
}