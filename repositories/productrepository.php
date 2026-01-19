<?php
include("../config/connection.php");
include("../models/productmodel.php");

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
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result){
            $produto_data = new productmodel(
                $result['id'],
                $result['name'],
                $result['description'],
                $result['price'],
                $result['stock'],
                $result['category'],
                $result['codigo'],
                $result['paginas'],
                $result['vendas']
            );
        }else{
            $produto_data = null;
        }
        return $produto_data;
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
    public function createProduct($product){
        $name = $product->name;
        $description = $product->description;
        $price = $product->price;
        $stock = $product->stock;
        $category = $product->category;
        $codigo = $product->codigo;
        $paginas = $product->paginas;
        $vendas = $product->vendas;

        $stmt = $this->connection->prepare('INSERT INTO products (name, description, price, stock, category, codigo, paginas, vendas) VALUES (:name, :description, :price, :stock, :category, :codigo, :paginas, :vendas)');

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':stock', $stock);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':codigo', $codigo);
        $stmt->bindParam(':paginas', $paginas);
        $stmt->bindParam(':vendas', $vendas);

        return $stmt->execute();
    }
    public function updateProduct($product){
        $id= $product->id;
        $name = $product->name;
        $description = $product->description;
        $price = $product->price;
        $stock = $product->stock;
        $category = $product->category;
        $codigo = $product->codigo;
        $paginas = $product->paginas;
        $vendas = $product->vendas;

        $stmt = $this->connection->prepare('UPDATE products SET name=:name, description=:description, price=:price, stock=:stock, category=:category, codigo=:codigo, paginas=:paginas, vendas=:vendas WHERE id=:id');

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':stock', $stock);
        $stmt->bindParam(':category', $category);
        return $stmt->execute();
    }
}