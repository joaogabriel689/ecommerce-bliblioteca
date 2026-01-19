<?php
include ("../config/connection.php");

class userrepository{
    private $connection;

    public function __construct($connection){
        $this->connection = $connection;
    }

    public function getUserById($user){
        $id= $user->id;
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getUserByUsername($user){
        $name = $user->username;
        $stmt = $this->connection->prepare('SELECT * FROM users WHERE name = :name');
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function createUser($user){
        $name = $user->username;
        $password = $user->password;
        $data_nasc = $user->data_nasc;
        $phone = $user->phone;
        $compras = $user->compras;
        $group = $user->group;
        $codigo = $user->codigo;
        $email = $user->email;
        $password = password_hash($user->password, PASSWORD_BCRYPT);


        $stmt = $this->connection->prepare('INSERT INTO users (name, email, password, data_nasc, phone, compras, group_user, codigo) VALUES (:name, :email, :password, :data_nasc, :phone, :compras, :group_user, :codigo)');


        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':data_nasc', $data_nasc);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':compras', $compras);
        $stmt->bindParam(':group_user', $group);
        $stmt->bindParam(':codigo', $codigo);
        $stmt->bindParam(':password', $password);
        return $stmt->execute();
    }
    public function deleteUser($user){
        $id = $user->id;
        $stmt = $this->connection->prepare('DELETE FROM users WHERE id = :id');
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    public function listUsers(){
        $stmt = $this->connection->prepare('SELECT * FROM users');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function updateUser($user){
        $id = $user->id;
        $name = $user->username;
        $email = $user->email;
        $password = password_hash($user->password, PASSWORD_BCRYPT) ?? null;
        $data_nasc = $user->data_nasc;
        $phone = $user->phone;
        $compras = $user->compras;
        $group_user = $user->group_user;
        $codigo = $user->codigo;

        if ($password !== null) {
            // Update password
            $stmt = $this->connection->prepare('UPDATE users SET name=:name, email=:email, password=:password, data_nasc=:data_nasc, phone=:phone, compras=:compras, group_user=:group_user, codigo=:codigo WHERE id=:id');
            $stmt->bindParam(':password', $password);
        } else {
            // Do not update password
            $stmt = $this->connection->prepare('UPDATE users SET name=:name, email=:email, data_nasc=:data_nasc, phone=:phone, compras=:compras, group_user=:group_user, codigo=:codigo WHERE id=:id');
        }

        // Bind all parameters
        if ($password !== null) {
            // Update password
            $stmt->bindParam(':password', $password);
        }
        // Bind all other parameters
        return 0;
    }
}