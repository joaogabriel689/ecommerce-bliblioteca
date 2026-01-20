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

    public function findById(int $id): ?UserModel
    {
        $stmt = $this->connection->prepare(
            "SELECT * FROM users WHERE id = :id"
        );
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ? $this->mapToModel($data) : null;
    }

    public function findByEmail(string $email): ?UserModel
    {
        $stmt = $this->connection->prepare(
            "SELECT * FROM users WHERE email = :email"
        );
        $stmt->bindValue(":email", $email);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ? $this->mapToModel($data) : null;
    }

    public function listAll(): array
    {
        $stmt = $this->connection->query("SELECT * FROM users");

        $users = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $users[] = $this->mapToModel($row);
        }

        return $users;
    }

    /* =========================
       CRIAÇÃO
    ========================= */

    public function create(UserModel $user): bool
    {
        $stmt = $this->connection->prepare(
            "INSERT INTO users
            (name, email, password, data_nasc, phone, compras, group_user, codigo)
            VALUES
            (:name, :email, :password, :data_nasc, :phone, :compras, :group_user, :codigo)"
        );

        return $stmt->execute([
            ":name" => $user->name,
            ":email" => $user->email,
            ":password" => password_hash($user->password, PASSWORD_BCRYPT),
            ":data_nasc" => $user->dataNasc,
            ":phone" => $user->phone,
            ":compras" => $user->compras,
            ":group_user" => $user->group,
            ":codigo" => $user->codigo
        ]);
    }

    /* =========================
       ATUALIZAÇÃO
    ========================= */

    public function update(UserModel $user): bool
    {
        $sql = "
            UPDATE users SET
                name = :name,
                email = :email,
                data_nasc = :data_nasc,
                phone = :phone,
                compras = :compras,
                group_user = :group_user,
                codigo = :codigo
        ";

        // Só atualiza senha se vier preenchida
        if (!empty($user->password)) {
            $sql .= ", password = :password";
        }

        $sql .= " WHERE id = :id";

        $stmt = $this->connection->prepare($sql);

        $params = [
            ":id" => $user->id,
            ":name" => $user->name,
            ":email" => $user->email,
            ":data_nasc" => $user->dataNasc,
            ":phone" => $user->phone,
            ":compras" => $user->compras,
            ":group_user" => $user->group,
            ":codigo" => $user->codigo
        ];

        if (!empty($user->password)) {
            $params[":password"] = password_hash($user->password, PASSWORD_BCRYPT);
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

    /* =========================
       MAPEAMENTO
    ========================= */

    private function mapToModel(array $data): UserModel
    {
        return new UserModel(
            id: (int) $data["id"],
            name: $data["name"],
            email: $data["email"],
            password: $data["password"],
            dataNasc: $data["data_nasc"] ?? null,
            phone: $data["phone"] ?? null,
            compras: (int) $data["compras"],
            group: $data["group_user"],
            codigo: $data["codigo"] ?? null
        );
    }
}