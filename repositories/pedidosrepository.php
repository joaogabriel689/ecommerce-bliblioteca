<?php

include("../config/connection.php");

class pedidosrepository{
    private $connection;

    public function __construct($connection){
        $this->connection = $connection;
    }

    public function createPedido($pedido){
        $user_id = $pedido->user_id;
        $product_id = $pedido->product_id;
        $quantity = $pedido->quantity;
        $total_price = $pedido->total_price;
        $status = $pedido->status;

        $stmt = $this->connection->prepare('INSERT INTO pedidos (user_id, product_id, quantity, total_price, status) VALUES (:user_id, :product_id, :quantity, :total_price, :status)');

        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':total_price', $total_price);
        $stmt->bindParam(':status', $status);

        return $stmt->execute();
    }
    public function updatePedido($pedido){
        $user_id = $pedido->user_id;
        $product_id = $pedido->product_id;
        $quantity = $pedido->quantity;
        $total_price = $pedido->total_price;
        $status = $pedido->status;
        $id = $pedido->id;
        $stmt = $this->connection->prepare('UPDATE pedidos SET user_id=:user_id, product_id=:product_id, quantity=:quantity, total_price=:total_price, status=:status WHERE id=:id');
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':total_price', $total_price);
        $stmt->bindParam(':status', $status);
        return $stmt->execute();
    }
    public function deletePedido($pedido){
        $id = $pedido->id;
        $stmt = $this->connection->prepare('DELETE FROM pedidos WHERE id = :id');
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    public function getPedido($pedido){
        $user_id= $pedido->user_id;
        $status= $pedido->status;
        $stmt = $this->connection->prepare("SELECT * FROM pedidos WHERE user_id = :user_id AND status = :status");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':status', $status);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}