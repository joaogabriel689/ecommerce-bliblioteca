<?php

/**
 * Repository responsável por manipular a tabela `enderecos`
 */
class AdressRepository
{
    /**
     * Conexão com o banco de dados
     */
    private PDO $connection;

    /**
     * Injeta a conexão PDO no repositório
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Busca todos os endereços de um usuário
     */
    public function get(int $user_id): array
    {
        $stmt = $this->connection->prepare(
            "SELECT * FROM enderecos WHERE id_cliente = :user_id"
        );

        // Associa o ID do usuário ao placeholder
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);

        // Executa a query
        $stmt->execute();

        // Retorna todos os endereços como array associativo
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Cria um novo endereço para o usuário
     * $data deve conter apenas os campos da tabela (exceto id_cliente)
     */
    public function create(int $user_id, array $data): bool
    {
        // Monta dinamicamente os campos e valores do INSERT
        $sql = "INSERT INTO enderecos (id_cliente, " 
             . implode(', ', array_keys($data)) 
             . ") VALUES (:user_id, " 
             . implode(', ', array_map(fn($key) => ":$key", array_keys($data))) 
             . ")";

        $stmt = $this->connection->prepare($sql);

        // Bind do ID do usuário
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);

        // Bind dinâmico dos dados do endereço
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        // Executa o INSERT
        return $stmt->execute();
    }

    /**
     * Atualiza os dados do endereço de um usuário
     * Atualiza TODOS os endereços do usuário (caso típico)
     */
    public function update(int $user_id, array $data): bool
    {
        // Se não houver dados para atualizar, cancela
        if (empty($data)) {
            return false;
        }

        // Monta a parte SET do UPDATE dinamicamente
        $fields = [];

        foreach ($data as $key => $value) {
            $fields[] = "$key = :$key";
        }

        // Junta os campos com vírgula
        $sql = "UPDATE enderecos SET " . implode(', ', $fields)
             . " WHERE id_cliente = :user_id";

        $stmt = $this->connection->prepare($sql);

        // Bind do ID do usuário
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);

        // Bind dos novos valores
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        // Executa o UPDATE
        return $stmt->execute();
    }

    /**
     * Remove todos os endereços de um usuário
     */
    public function delete(int $user_id): bool
    {
        $stmt = $this->connection->prepare(
            "DELETE FROM enderecos WHERE id_cliente = :user_id"
        );

        // Bind do ID do usuário
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);

        // Executa o DELETE
        return $stmt->execute();
    }
}
