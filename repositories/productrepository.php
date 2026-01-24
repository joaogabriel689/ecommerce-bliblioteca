<?php
include("../config/connection.php");

class productrepository{
    private $connection;

    public function __construct($connection){
        $this->connection = $connection;
    }
    /**
     * ?
     * @param mixed $id
     * essa funçao retorna um produto pelo id
     * @return |null
     */
    public function getProductById($id){ 
        $stmt = $this->connection->prepare("SELECT * FROM produtos WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ?? null;

    }

    /**
     * ?
     * essa funçao retorna todos os produtos
     * @return array
     */
    public function listProducts(){
        $stmt = $this->connection->prepare('SELECT * FROM produtos');
        $data = $stmt->execute();

        return $data ?? null;
    }
    /**
     * ?
     * essa funçao retorna os 10 produtos mais vendidos
     * @return array
     */
    public function getProductsMostSold(){
        $stmt = $this->connection->prepare('SELECT * FROM produtos ORDER BY vendas DESC LIMIT 10');
        $produtos = [];
        $data = $stmt->execute();

        return $data ?? null;
    }
    /**
     * ?
     * essa funçao retorna os 10 produtos mais visitados
     * @return array
     */
    public function getProductsMostVisiteds(){
        $stmt = $this->connection->prepare('SELECT * FROM produtos ORDER BY clique DESC LIMIT 10');
        
        $data = $stmt->execute();

        return $data ?? null;
    }
    /**
     * ?
     * essa funçao deleta um produto pelo id
     * @param mixed $id
     * @return bool
     */
    public function deleteProductById($id){
        $stmt = $this->connection->prepare('DELETE FROM produtos WHERE id = :id');
        $stmt->bindParam(':id', $id);
        return $stmt->execute();

    }
    /**
     * ?
     * essa funçao cria um novo produto
     * @param  $product
     * @return bool
     */
    public function create($nome, $tipo, $valor, $autor, $clique, $descricao, $paginas, $idioma, $vendas, $estoque, $img_path, $editora, $categoria): bool
    {
        $stmt = $this->connection->prepare(
            "INSERT INTO produtos
            (nome, tipo, valor, autor, clique, descricao, paginas, idioma, vendas, estoque, img_path, editora, categoria)
            VALUES
            (:nome, :tipo, :valor, :autor, :clique, :descricao, :paginas, :idioma, :vendas, :estoque, :img_path, :editora, :categoria)"
        );

        return $stmt->execute([
            ":nome" => $nome,
            ":tipo" => $tipo,
            ":valor" => $valor,
            ":autor" => $autor,
            ":clique" => $clique,
            ":descricao" => $descricao,
            ":paginas" => $paginas,
            ":idioma" => $idioma,
            ":vendas" => $vendas,
            ":estoque" => $estoque,
            ":img_path" => $img_path,
            ":editora" => $editora,
            ":categoria" => $categoria
        ]);

    }
    /**
     * ?
     * essa funçao atualiza um produto
     * @param  $product
     * @return bool
     */
    public function update($id, $nome, $tipo, $valor, $autor,  $descricao, $paginas, $idioma, $img_path, $editora, $categoria): bool
    {
        $stmt = $this->connection->prepare(
            "UPDATE produtos SET
                nome = :nome,
                tipo = :tipo,
                valor = :valor,
                autor = :autor,
                descricao = :descricao,
                paginas = :paginas,
                idioma = :idioma,
                img_path = :img_path,
                editora = :editora,
                categoria = :categoria
            WHERE id = :id"
        );

        return $stmt->execute([
            ":id" => $id,
            ":nome" => $nome,
            ":tipo" => $tipo,
            ":valor" => $valor,
            ":autor" => $autor,
            ":descricao" => $descricao,
            ":paginas" => $paginas,
            ":idioma" => $idioma,
            ":img_path" => $img_path,
            ":editora" => $editora,
            ":categoria" => $categoria
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
            "SELECT nome FROM produtos WHERE nome LIKE :term"
        );

        $likeTerm = '%' . $term . '%';
        $stmt->execute([':term' => $likeTerm]);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map([$this, ''], $results);

    }
    /**
     * ?
     * essa funçao filtra produtos por categoria e faixa de preço
     * @param array $filters
     * @return array
     */
    public function filterProducts(array $filters): array
    {
        $query = "SELECT * FROM produtos WHERE 1=1";
        $params = [];

        if (isset($filters['category'])) {
            $query .= " AND categoria = :category";
            $params[':category'] = $filters['category'];
        }

        if (isset($filters['min_price'])) {
            $query .= " AND preco >= :min_price";
            $params[':min_price'] = $filters['min_price'];
        }

        if (isset($filters['max_price'])) {
            $query .= " AND price <= :max_price";
            $params[':max_price'] = $filters['max_price'];
        }
        if (isset($filters['tipo'])) {
            $query .= 'AND tipo = :tipo';
            $params[':tipo'] = $filters['tipo'];
        }

        $stmt = $this->connection->prepare($query);
        $stmt->execute($params);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map([$this, ''], $results);
    }
    public function updateEstoque($id, $movimentacao){
        $query = "UPDATE produtos SET estoque = estoque + :movimentacao WHERE id = :id";
        $params = [
            ":movimentacao"=> $movimentacao,
            ":id" => $id
        ];
        $stmt = $this->connection->prepare($query);
        return $stmt->execute($params);

    }
    public function updateClique($id) {
        $query = "UPDATE produtos SET clique = clique + 1 WHERE id = :id";
        $params = [
            ":id"=> $id
        ];
        $stmt = $this->connection->prepare($query);
        return $stmt->execute($params);
    }

}


