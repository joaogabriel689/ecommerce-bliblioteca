<?php
include("../config/connection.php");
include("../models/productmodel.php");

class productrepository{
    private $connection;

    public function __construct($connection){
        $this->connection = $connection;
    }

    public function getProductById($id){ 
        $stmt = $this->connection->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ? $this->mapToModel($data) : null;

    }

    public function listProducts(){
        $stmt = $this->connection->prepare('SELECT * FROM products');
        $products = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $products[] = $this->mapToModel($row);
        }

        return $products;
    }
    public function getProductsMostSold(){
        $stmt = $this->connection->prepare('SELECT * FROM products ORDER BY vendas DESC LIMIT 10');
        $products = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $products[] = $this->mapToModel($row);
        }

        return $products;
    }
    public function getProductsMostVisiteds(){
        $stmt = $this->connection->prepare('SELECT * FROM products ORDER BY click DESC LIMIT 10');
        $products = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $products[] = $this->mapToModel($row);
        }

        return $products;
    }
    public function deleteProductById($id){
        $stmt = $this->connection->prepare('DELETE FROM products WHERE id = :id');
        $stmt->bindParam(':id', $id);
        return $stmt->execute();

    }
    public function create(ProductModel $product): bool
    {
        $stmt = $this->connection->prepare(
            "INSERT INTO products
            (name, description, price, stock, category, codigo, paginas, vendas)
            VALUES
            (:name, :description, :price, :stock, :category, :codigo, :paginas, :vendas)"
        );

        return $stmt->execute([
            ":name" => $product->name,
            ":description" => $product->description,
            ":price" => $product->price,
            ":stock" => $product->stock,
            ":category" => $product->category,
            ":codigo" => $product->codigo,
            ":paginas" => $product->paginas,
            ":vendas" => $product->vendas
        ]);
    }
    public function update(ProductModel $product): bool
    {
        $stmt = $this->connection->prepare(
            "UPDATE products SET
                name = :name,
                description = :description,
                price = :price,
                stock = :stock,
                category = :category,
                codigo = :codigo,
                paginas = :paginas,
                vendas = :vendas
            WHERE id = :id"
        );

        return $stmt->execute([
            ":id" => $product->id,
            ":name" => $product->name,
            ":description" => $product->description,
            ":price" => $product->price,
            ":stock" => $product->stock,
            ":category" => $product->category,
            ":codigo" => $product->codigo,
            ":paginas" => $product->paginas,
            ":vendas" => $product->vendas
        ]);
    }
    private function mapToModel(array $data): productmodel{
        return new productmodel(
            id: (int) $data["id"],
            name: $data["name"],
            description: $data["description"],
            price: (float) $data["price"],
            stock: (int) $data["stock"],
            category: $data["category"],
            codigo: $data["codigo"] ?? null,
            paginas: (int) $data["paginas"],
            vendas: (int) $data["vendas"]
        );
    }

}