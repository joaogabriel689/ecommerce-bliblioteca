<?php

require_once __DIR__ . "/../models/UserModel.php";


class UserRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /* =========================
       BUSCAS
    ========================= */

    public function findById(int $id): array|null
    {
        $stmt = $this->connection->prepare(
            "SELECT * FROM users WHERE id = :id"
        );
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ?? null;
    }

    public function findByEmail(string $email): array|null
    {
        $stmt = $this->connection->prepare(
            "SELECT * FROM users WHERE email = :email"
        );
        $stmt->bindValue(":email", $email);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ?? null;
    }

    public function listAll(): array
    {
        $stmt = $this->connection->query("SELECT * FROM users");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data ?? null;
    }

    /* =========================
       CRIAÇÃO
    ========================= */

    public function create($name, $email, $cpf, $password, $dataNasc, $phone, $compras, $group): bool
    {
        $stmt = $this->connection->prepare(
            "INSERT INTO users
            (name, email, cpf, password, data_nasc, phone, compras, group_user)
            VALUES
            (:name, :email, :password, :data_nasc, :phone, :compras, :group_user)"
        );
        
        $codigo = bin2hex($email);
        return $stmt->execute([
            ":name" => $name,
            ":email" => $email,
            ":cpf" => $cpf,
            ":password" => password_hash($password, PASSWORD_BCRYPT),
            ":data_nasc" => $dataNasc,
            ":phone" => $phone,
            ":compras" => $compras,
            ":group_user" => $group,
        ]);
    }

    /* =========================
       ATUALIZAÇÃO
    ========================= */

    public function update($id, $name, $email, $cpf, $password, $dataNasc, $phone,  $group): bool
    {
        $sql = "
            UPDATE users SET
                name = :name,
                cpf = :cpf,
                email = :email,
                data_nasc = :data_nasc,
                phone = :phone,
                group_user = :group_user,
                
        ";

        // Só atualiza senha se vier preenchida
        if (!empty($password)) {
            $sql .= ", password = :password";
        }


        $sql .= " WHERE id = :id";

        $stmt = $this->connection->prepare($sql);

        $params = [
            ":id" => $id,
            ":name" => $name,
            ":email" => $email,
            ":cpf" => $cpf,
            ":data_nasc" => $dataNasc,
            ":phone" => $phone,
            ":group_user" => $group,
            
        ];

        if (!empty($password)) {
            $params[":password"] = password_hash($password, PASSWORD_BCRYPT);
        }


        return $stmt->execute($params);
    }

    /* =========================
       REMOÇÃO
    ========================= */

    public function delete(int $id): bool
    {
        $stmt = $this->connection->prepare(
            "DELETE FROM users WHERE id = :id"
        );
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

}