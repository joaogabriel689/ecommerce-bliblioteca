<?php

/**
 * Repositório de Pedidos
 *
 * Responsável por toda a comunicação com a tabela `pedidos`.
 *
 * ❗ Importante:
 * - Não contém regras de negócio de alto nível
 * - Não valida dados de entrada
 * - Não cria ou manipula sessão
 * - Apenas executa operações SQL
 */
class PedidoRepository
{
    /**
     * Conexão com o banco de dados (PDO)
     */
    private PDO $connection;

    /**
     * Construtor
     *
     * Recebe a conexão via injeção de dependência.
     *
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Cria um novo pedido (ou item de carrinho) para um usuário
     *
     * @param int    $user_id      ID do cliente
     * @param int    $product_id   ID do produto
     * @param int    $quantity     Quantidade do produto
     * @param float  $total_price  Valor total do item
     * @param string $status       Status do pedido (padrão: pendente)
     *
     * @return bool
     *  Retorna true se o INSERT for executado com sucesso
     */
    public function create($user_id, $product_id, $product_value, $quantity, $total_price, $status = "pendente"): bool
    {
        /**
         * Insere um novo registro na tabela pedidos.
         * O campo `pagamento` recebe o mesmo valor de `valor_total`
         * no momento da criação.
         */
        $sql = "
            INSERT INTO pedidos (id_produto, valor_produto,  valor_total, quantidade, id_cliente, data, status) values
            (:product_id, :product_value, :total_price, :quantity, :user_id, NOW(), :status)
        ";

        // Prepara a query
        $stmt = $this->connection->prepare($sql);

        // Executa o INSERT passando os parâmetros
        return $stmt->execute([
            ":user_id"      => $user_id,
            ":product_id"   => $product_id,
            ":product_value"=> $product_value,
            ":total_price"  => $total_price,
            ":quantity"     => $quantity,
            ":status"       => $status
        ]);
    }

    /**
     * Atualiza a quantidade de um produto já existente no pedido
     *
     * @param int $id_usuario  ID do cliente
     * @param int $id_produto  ID do produto
     * @param int $quantity    Quantidade a ser adicionada
     *
     * @return bool
     *  Retorna true se a atualização for bem-sucedida
     */
    public function updateQuantity(int $id_usuario, $id_produto, int $quantity): bool
    {
        /**
         * Busca o pedido atual para obter:
         * - valor unitário do produto
         * - quantidade atual
         * - valor total atual
         */
        $sql = "
            select valor_produto, quantidade, valor_total 
            from pedidos 
            where id_cliente = :id_usuario 
              and id_produto = :id_produto
        ";

        $stmt = $this->connection->prepare($sql);

        // Executa a consulta
        $pedido = $stmt->execute([
            ':id_usuario' => $id_usuario,
            ':id_produto' => $id_produto,
        ]);

        // Recupera o pedido como array associativo
        $pedido = $stmt->fetch(PDO::FETCH_ASSOC);

        // Incrementa a quantidade atual
        $pedido['quantidade'] += $quantity;

        // Recalcula o valor total com base no valor unitário
        $pedido['valor_total'] = $quantity * $pedido['valor_produto'];

        /**
         * Atualiza o pedido com a nova quantidade e valor total
         */
        $sql = "
            update pedidos 
            set quantidade = :quantidade, valor_total = :valor_total 
            where id_cliente = :id_usuario 
              and id_produto = :id_produto
        ";

        $stmt = $this->connection->prepare($sql);

        return $stmt->execute([
            ':quantidade'   => $pedido['quantidade'],
            ':valor_total'  => $pedido['valor_total'],
            ':id_usuario'   => $id_usuario,
            ':id_produto'   => $id_produto,
        ]);
    }

    /**
     * Atualiza o status e a forma de pagamento de um pedido
     *
     * @param int    $id               ID do pedido
     * @param string $status           Novo status
     * @param int    $forma_pagamento  Identificador da forma de pagamento
     *
     * @return bool
     *  Retorna true se o UPDATE for executado com sucesso
     */
    public function updateStatus($id_usuario, $id_produto, $status, int $forma_pagamento): bool
    {
        $sql = '
            UPDATE pedidos 
            SET status = :status, forma_pagamento = :forma_pagamento 
            WHERE id_cliente = :id_cliente AND id_produto = :id_produto
        ';

        $stmt = $this->connection->prepare($sql);

        // Executa a atualização do pedido
        $pedido = $stmt->execute([
            ':id_cliente'               => $id_usuario,
            ':id_produto'=> $id_produto,
            ':status'           => $status,
            ':forma_pagamento'  => $forma_pagamento
        ]);

        return $pedido;
    }

    /**
     * Remove um produto específico do pedido do usuário
     *
     * @param int $id_usuario  ID do cliente
     * @param int $id_produto  ID do produto
     *
     * @return bool
     *  Retorna true se o DELETE for executado com sucesso
     */
    public function delete($id_usuario, $id_produto): bool
    {
        $stmt = $this->connection->prepare(
            "DELETE FROM pedidos 
             WHERE id_cliente = :id_cliente 
               AND id_produto = :id_produto"
        );

        return $stmt->execute([
            ':id_cliente' => $id_usuario,
            ':id_produto' => $id_produto
        ]);
    }

    /**
     * Busca pedidos de um usuário filtrando pelo status
     *
     * @param int    $id_usuario  ID do cliente
     * @param string $status      Status do pedido
     *
     * @return array
     *  Retorna uma lista de pedidos
     */
    public function findByUserAndStatus(int $id_usuario, string $status): array
    {
        $stmt = $this->connection->prepare(
            "SELECT * 
             FROM pedidos 
             WHERE id_cliente = :user_id 
               AND status = :status"
        );

        $stmt->execute([
            ':user_id' => $id_usuario,
            ':status'  => $status,
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Busca pedidos de um usuário filtrando pelo produto
     *
     * @param int    $id_usuario  ID do cliente
     * @param string $id_produto  ID do produto
     *
     * @return array
     *  Retorna uma lista de pedidos
     */
    public function findByUserAndProduto(int $id_usuario, string $id_produto): array
    {
        $stmt = $this->connection->prepare(
            "SELECT * 
             FROM pedidos 
             WHERE id_cliente = :user_id 
               AND id_produto = :id_produto"
        );

        $stmt->execute([
            ':user_id'    => $id_usuario,
            ':id_produto' => $id_produto,
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
