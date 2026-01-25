<?php

class favoritesrepository{
    private PDO $connection;

    public function __construct(PDO $connection){
        $this->connection = $connection;
    }

    public function addFavorite($userId, $itemId){
        $stmt = $this->connection->prepare("INSERT INTO favoritos (id_cliente, id_produto) VALUES (:user_id, :item_id)");
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':item_id', $itemId);
        return $stmt->execute();
    }

    public function removeFavorite($userId, $itemId){
        $stmt = $this->connection->prepare("DELETE FROM favoritos WHERE id_cliente = :user_id AND id_produto = :item_id");
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':item_id', $itemId);
        return $stmt->execute();
    }

    public function getFavoritesByUser($userId){
        $stmt = $this->connection->prepare("SELECT id_produto FROM favoritos WHERE id_cliente = :user_id");
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}