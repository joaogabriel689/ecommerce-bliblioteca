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
            "SELECT * FROM usuarios WHERE id = :id"
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
    public function findByEmail(string $email): ?array {
        $stmt = $this->connection->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user === false ? null : $user;
    }


    /**
     * Lista todos os usuários cadastrados
     *
     * @return array Lista de usuários
     */
    public function listAll(): array
    {
        $stmt = $this->connection->query("SELECT * FROM usuarios");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data ?? null;
    }

    /* =========================
       CRIAÇÃO
    ========================= */

    /**
     * Cria um novo usuário no sistema
     *
     * @param string $nome Nome do usuário
     * @param string $email E-mail do usuário
     * @param string $cpf CPF do usuário
     * @param string $senha Senha em texto puro
     * @param string $dataNasc Data de nascimento
     * @param string $telefone Telefone do usuário
     * @param int $compras Quantidade de compras realizadas
     * @param string $group Grupo/perfil do usuário
     * @return bool Retorna true em caso de sucesso
     */
    public function create($nome, $email, $cpf, $senha, $dataNasc, $telefone, $compras, $group): bool
    {
        $stmt = $this->connection->prepare(
            "INSERT INTO usuarios
            (nome, email, cpf, senha, data_nasc, telefone)
            VALUES
            (:nome, :email, :cpf, :senha, :data_nasc, :telefone)"
        );
        

        return $stmt->execute([
            ":nome" => $nome,
            ":email" => $email,
            ":cpf" => $cpf,
            ":senha" => password_hash($senha, PASSWORD_BCRYPT),
            ":data_nasc" => $dataNasc,
            ":telefone" => $telefone,
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
     * @param string $nome Nome
     * @param string $email E-mail
     * @param string $cpf CPF
     * @param string|null $senha Nova senha (opcional)
     * @param string $dataNasc Data de nascimento
     * @param string $telefone Telefone
     * @param string $group Grupo/perfil do usuário
     * @return bool Retorna true em caso de sucesso
     */
    public function update($id, $nome, $email, $cpf, $senha, $dataNasc, $telefone,  $group): bool
    {
        $sql = "
            UPDATE usuarios SET
                nome = :nome,
                cpf = :cpf,
                email = :email,
                data_nasc = :data_nasc,
                telefone = :telefone,
                grupo = :grupo
        ";

        // Só atualiza senha se vier preenchida
        if (!empty($senha)) {
            $sql .= ", senha = :senha";
        }

        $sql .= " WHERE id = :id";

        $stmt = $this->connection->prepare($sql);

        $params = [
            ":id" => $id,
            ":nome" => $nome,
            ":email" => $email,
            ":cpf" => $cpf,
            ":data_nasc" => $dataNasc,
            ":telefone" => $telefone,
            ":grupo" => $group,
        ];

        if (!empty($senha)) {
            $params[":senha"] = password_hash($senha, PASSWORD_BCRYPT);
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
            "DELETE FROM usuarios WHERE id = :id"
        );
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

}
