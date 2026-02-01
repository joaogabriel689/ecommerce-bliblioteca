<?php

/**
 * Repositório de favoritos
 *
 * Responsável exclusivamente por manipular a tabela `favoritos`
 * no banco de dados.
 *
 * ❗ Importante:
 * - Não contém regras de negócio
 * - Não valida permissões
 * - Não cria nem manipula sessão
 * - Apenas executa operações SQL
 */
class favoritesrepository {

    /**
     * Conexão com o banco de dados
     *
     * Tipada como PDO para garantir uso correto da API
     */
    private PDO $connection;

    /**
     * Construtor da classe
     *
     * Recebe a conexão via injeção de dependência,
     * facilitando testes e desacoplamento.
     *
     * @param PDO $connection
     */
    public function __construct(PDO $connection){
        $this->connection = $connection;
    }

    /**
     * Adiciona um produto aos favoritos de um usuário
     *
     * @param int $userId  ID do cliente
     * @param int $itemId  ID do produto
     *
     * @return bool
     *  Retorna true em caso de sucesso ou false em caso de falha
     */
    public function addFavorite($userId, $itemId){

        // Prepara a query de inserção na tabela favoritos
        $stmt = $this->connection->prepare(
            "INSERT INTO favoritos (id_cliente, id_produto) 
             VALUES (:user_id, :item_id)"
        );

        // Associa os parâmetros aos valores recebidos
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':item_id', $itemId);

        // Executa a query e retorna o resultado da execução
        return $stmt->execute();
    }

    /**
     * Remove um produto da lista de favoritos de um usuário
     *
     * @param int $userId  ID do cliente
     * @param int $itemId  ID do produto
     *
     * @return bool
     *  Retorna true se a exclusão for bem-sucedida
     */
    public function removeFavorite($userId, $itemId){

        // Prepara a query de remoção com base no usuário e produto
        $stmt = $this->connection->prepare(
            "DELETE FROM favoritos 
             WHERE id_cliente = :user_id 
               AND id_produto = :item_id"
        );

        // Faz o bind dos parâmetros
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':item_id', $itemId);

        // Executa a exclusão e retorna o status
        return $stmt->execute();
    }

    /**
     * Obtém todos os produtos favoritados por um usuário
     *
     * @param int $userId  ID do cliente
     *
     * @return array
     *  Retorna um array contendo apenas os IDs dos produtos
     */
    public function getFavoritesByUser($userId){

        // Prepara a query para buscar os produtos favoritados
        $stmt = $this->connection->prepare(
            "SELECT id_produto 
             FROM favoritos 
             WHERE id_cliente = :user_id"
        );

        // Associa o ID do usuário
        $stmt->bindParam(':user_id', $userId);

        // Executa a consulta
        $stmt->execute();

        /**
         * FETCH_COLUMN retorna apenas a primeira coluna de cada linha,
         * resultando em um array simples de IDs de produtos.
         */
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
    public function getFavoritesByUserAndItemId($userId, $itemId){
        $stmt = $this->connection->prepare(
            "SELECT id_produto 
             FROM favoritos 
             WHERE id_cliente = :user_id
               AND id_produto = :item_id"
        );
        $stmt->bindParam(":user_id", $userId);
        $stmt->bindParam(":item_id", $itemId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}