<?php

class PedidoRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function create($user_id, $product_id, $quantity, $total_price, $status = "pendente"): bool
    {
        $sql = "
            INSERT INTO pedidos (id_produto,valor_total,quantidade,  id_cliente, data, pagamento,status) values
            (:product_id, :total_price, :quantity, :user_id, NOW(), :total_price, :status)
        ";

        $stmt = $this->connection->prepare($sql);

        return $stmt->execute([
            ":user_id"=> $user_id,
            ":product_id"=> $product_id,
            ":quantity"=> $quantity,
            ":total_price"=> $total_price,
            ":status"=> $status
        ]);
    }

    public function updateQuantity(int $id_usuario, $id_produto, int $quantity): bool
    {
        
        $sql = "
            select valor_produto, quantidade, valor_total from pedidos where id_cliente = :id_usuario and id_produto = :id_produto
        ";

        $stmt = $this->connection->prepare($sql);

        $pedido = $stmt->execute([
            ':id_usuario'     => $id_usuario,
            ':id_produto'  => $id_produto,
        ]);
        $pedido = $stmt->fetch(PDO::FETCH_ASSOC);
        $pedido['quantidade'] += $quantity;
        $pedido['valor_total'] = $quantity * $pedido['valor_produto'];
        $sql = "
            update pedidos set quantidade = :quantidade, valor_total = :valor_total where id_cliente = :id_usuario and id_produto = :id_produto
        ";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([
            ':quantidade'     => $pedido['quantidade'],
            ':valor_total'  => $pedido['valor_total'],
            ':id_usuario'     => $id_usuario,
            ':id_produto'  => $id_produto,
        ]);

    }
    public function updateStatus($id, $status, int $forma_pagamento): bool
    {
        $sql = 'UPDATE pedidos SET status = :status, forma_pagamento = :forma_pagamento WHERE id = :id';
        $stmt = $this->connection->prepare($sql);
        $pedido = $stmt->execute([
            ':id'     => $id,
            ':status'  => $status,
            ':forma_pagamento' => $forma_pagamento
        ]);
        return $pedido;
    }

    public function delete($id_usuario, $id_produto): bool
    {
        $stmt = $this->connection->prepare(
            "DELETE FROM pedidos WHERE id_cliente = :id_cliente AND id_produto = :id_produto"
        );

        return $stmt->execute([
            ':id_cliente' => $id_usuario,
            ':id_produto' => $id_produto
        ]);
    }


    public function findByUserAndStatus(int $id_usuario, string $status): array
    {
        $stmt = $this->connection->prepare(
            "SELECT * FROM pedidos WHERE id_cliente = :user_id AND status = :status"
        );

        $stmt->execute([
            ':user_id' => $id_usuario,
            ':status'  => $status,
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function findByUserAndProduto(int $id_usuario, string $id_produto): array
    {
        $stmt = $this->connection->prepare(
            "SELECT * FROM pedidos WHERE id_cliente = :user_id AND id_produto = :id_produto"
        );

        $stmt->execute([
            ':user_id' => $id_usuario,
            ':id_produto' => $id_produto,
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}