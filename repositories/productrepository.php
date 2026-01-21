<?php
include("../config/connection.php");
include("../models/productmodel.php");

class productrepository{
    private $connection;

    public function __construct($connection){
        $this->connection = $connection;
    }
    /**
     * ?
     * @param mixed $id
     * essa funçao retorna um produto pelo id
     * @return productmodel|null
     */
    public function getProductById($id){ 
        $stmt = $this->connection->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ? $this->mapToModel($data) : null;

    }
    /**
     * ?
     * essa funçao retorna todos os produtos
     * @return array
     */
    public function listProducts(){
        $stmt = $this->connection->prepare('SELECT * FROM products');
        $products = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $products[] = $this->mapToModel($row);
        }

        return $products;
    }
    /**
     * ?
     * essa funçao retorna os 10 produtos mais vendidos
     * @return array
     */
    public function getProductsMostSold(){
        $stmt = $this->connection->prepare('SELECT * FROM products ORDER BY vendas DESC LIMIT 10');
        $products = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $products[] = $this->mapToModel($row);
        }

        return $products;
    }
    /**
     * ?
     * essa funçao retorna os 10 produtos mais visitados
     * @return array
     */
    public function getProductsMostVisiteds(){
        $stmt = $this->connection->prepare('SELECT * FROM products ORDER BY click DESC LIMIT 10');
        $products = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $products[] = $this->mapToModel($row);
        }

        return $products;
    }
    /**
     * ?
     * essa funçao deleta um produto pelo id
     * @param mixed $id
     * @return bool
     */
    public function deleteProductById($id){
        $stmt = $this->connection->prepare('DELETE FROM products WHERE id = :id');
        $stmt->bindParam(':id', $id);
        return $stmt->execute();

    }
    /**
     * ?
     * essa funçao cria um novo produto
     * @param ProductModel $product
     * @return bool
     */
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
    /**
     * ?
     * essa funçao atualiza um produto
     * @param ProductModel $product
     * @return bool
     */
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
    /**
     * ?
     * essa funçao busca produtos pelo nome
     * @param string $term
     * @return array
     */
    public function searchByLike(string $term): array
    {
        $stmt = $this->connection->prepare(
            "SELECT * FROM products WHERE name LIKE :term"
        );

        $likeTerm = '%' . $term . '%';
        $stmt->execute([':term' => $likeTerm]);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map([$this, 'mapToModel'], $results);

    }
    /**
     * ?
     * essa funçao filtra produtos por categoria e faixa de preço
     * @param array $filters
     * @return array
     */
    public function filterProducts(array $filters): array
    {
        $query = "SELECT * FROM products WHERE 1=1";
        $params = [];

        if (isset($filters['category'])) {
            $query .= " AND category = :category";
            $params[':category'] = $filters['category'];
        }

        if (isset($filters['min_price'])) {
            $query .= " AND price >= :min_price";
            $params[':min_price'] = $filters['min_price'];
        }

        if (isset($filters['max_price'])) {
            $query .= " AND price <= :max_price";
            $params[':max_price'] = $filters['max_price'];
        }

        $stmt = $this->connection->prepare($query);
        $stmt->execute($params);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map([$this, 'mapToModel'], $results);
    }
    /**
     * ?
     * essa funçao mapeia os dados do banco para o modelo de produto
     * @param array $data
     * @return productmodel
     */
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