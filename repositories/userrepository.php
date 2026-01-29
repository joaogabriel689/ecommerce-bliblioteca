<?php

/**
 * Repositório responsável pelo acesso e manipulação
 * dos dados de usuários no banco de dados.
 */
class UserRepository
{
    /**
     * Conexão PDO com o banco de dados
     *
     * @var PDO
     */
    private PDO $connection;

    /**
     * Construtor da classe
     *
     * @param PDO $connection Conexão com o banco de dados
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /* =========================
       BUSCAS
    ========================= */

    /**
     * Busca um usuário pelo ID
     *
     * @param int $id ID do usuário
     * @return array|null Retorna os dados do usuário ou null se não encontrado
     */
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

    /**
     * Busca um usuário pelo e-mail
     *
     * @param string $email E-mail do usuário
     * @return array|null Retorna os dados do usuário ou null se não encontrado
     */
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

    /**
     * Lista todos os usuários cadastrados
     *
     * @return array Lista de usuários
     */
    public function listAll(): array
    {
        $stmt = $this->connection->query("SELECT * FROM users");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data ?? null;
    }

    /* =========================
       CRIAÇÃO
    ========================= */

    /**
     * Cria um novo usuário no sistema
     *
     * @param string $name Nome do usuário
     * @param string $email E-mail do usuário
     * @param string $cpf CPF do usuário
     * @param string $password Senha em texto puro
     * @param string $dataNasc Data de nascimento
     * @param string $phone Telefone do usuário
     * @param int $compras Quantidade de compras realizadas
     * @param string $group Grupo/perfil do usuário
     * @return bool Retorna true em caso de sucesso
     */
    public function create($name, $email, $cpf, $password, $dataNasc, $phone, $compras, $group): bool
    {
        $stmt = $this->connection->prepare(
            "INSERT INTO users
            (name, email, cpf, password, data_nasc, phone, compras, group_user)
            VALUES
            (:name, :email, :cpf, :password, :data_nasc, :phone, :compras, :group_user)"
        );
        

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

    /**
     * Atualiza os dados de um usuário
     *
     * A senha só é atualizada caso seja informada.
     *
     * @param int $id ID do usuário
     * @param string $name Nome
     * @param string $email E-mail
     * @param string $cpf CPF
     * @param string|null $password Nova senha (opcional)
     * @param string $dataNasc Data de nascimento
     * @param string $phone Telefone
     * @param string $group Grupo/perfil do usuário
     * @return bool Retorna true em caso de sucesso
     */
    public function update($id, $name, $email, $cpf, $password, $dataNasc, $phone,  $group): bool
    {
        $sql = "
            UPDATE users SET
                name = :name,
                cpf = :cpf,
                email = :email,
                data_nasc = :data_nasc,
                phone = :phone,
                group_user = :group_user
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

    /**
     * Remove um usuário do sistema
     *
     * @param int $id ID do usuário
     * @return bool Retorna true em caso de sucesso
     */
    public function delete(int $id): bool
    {
        $stmt = $this->connection->prepare(
            "DELETE FROM users WHERE id = :id"
        );
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

}
