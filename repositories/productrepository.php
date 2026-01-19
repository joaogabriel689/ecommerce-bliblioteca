<?php
include("../config/connection.php");

class productrepository{
    private $connection;

    public function __construct($connection){
        $this->connection = $connection;
    }

    public function getProductById($product){
        $id= $product->id;
        $stmt = $this->connection->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function listProducts(){
        $stmt = $this->connection->prepare('SELECT * FROM products');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function deleteProductById($product){
        $id= $product->id;
        $stmt = $this->connection->prepare('DELETE FROM products WHERE id = :id');
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
