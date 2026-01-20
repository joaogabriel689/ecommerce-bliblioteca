<?php

class PedidoRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function create(object $pedido): bool
    {
        $sql = "
            INSERT INTO pedidos (user_id, product_id, quantity, total_price, status)
            VALUES (:user_id, :product_id, :quantity, :total_price, :status)
        ";

        $stmt = $this->connection->prepare($sql);

        return $stmt->execute([
            ':user_id'     => $pedido->user_id,
            ':product_id'  => $pedido->product_id,
            ':quantity'    => $pedido->quantity,
            ':total_price' => $pedido->total_price,
            ':status'      => $pedido->status,
        ]);
    }

    public function update(object $pedido): bool
    {
        $sql = "
            UPDATE pedidos
            SET user_id = :user_id,
                product_id = :product_id,
                quantity = :quantity,
                total_price = :total_price,
                status = :status
            WHERE id = :id
        ";

        $stmt = $this->connection->prepare($sql);

        return $stmt->execute([
            ':id'          => $pedido->id,
            ':user_id'     => $pedido->user_id,
            ':product_id'  => $pedido->product_id,
            ':quantity'    => $pedido->quantity,
            ':total_price' => $pedido->total_price,
            ':status'      => $pedido->status,
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->connection->prepare(
            "DELETE FROM pedidos WHERE id = :id"
        );

        return $stmt->execute([':id' => $id]);
    }

    public function findByUserAndStatus(int $userId, string $status): array
    {
        $stmt = $this->connection->prepare(
            "SELECT * FROM pedidos WHERE user_id = :user_id AND status = :status"
        );

        $stmt->execute([
            ':user_id' => $userId,
            ':status'  => $status,
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
