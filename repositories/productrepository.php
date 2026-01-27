<?php

// Inclui a configuração de conexão com o banco de dados
include("../config/connection.php");

/**
 * Repositório de Produtos
 *
 * Responsável exclusivamente por operações na tabela `produtos`.
 *
 * ❗ Importante:
 * - Não contém regras de negócio
 * - Não valida dados
 * - Não cria sessão
 * - Apenas executa SQL
 */
class productrepository {

    /**
     * Conexão com o banco de dados
     */
    private $connection;

    /**
     * Construtor
     *
     * Recebe a conexão via injeção de dependência.
     *
     * @param PDO $connection
     */
    public function __construct($connection){
        $this->connection = $connection;
    }

    /**
     * Retorna um produto pelo ID
     *
     * @param mixed $id  ID do produto
     * @return array|null
     *  Retorna os dados do produto ou null caso não exista
     */
    public function getProductById($id){ 
        $stmt = $this->connection->prepare(
            "SELECT * FROM produtos WHERE id = :id"
        );
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data ?? null;
    }
    public function getProductByname($name){
        $stmt = $this->connection->prepare(
            "SELECT * FROM produtos WHERE nome = :name"
        );
        $stmt->bindParam(':name', $name);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data ?? null;
    }

    /**
     * Retorna todos os produtos cadastrados
     *
     * @return array|null
     *  Retorna os produtos ou null em caso de falha
     */
    public function listProducts(){
        $stmt = $this->connection->prepare(
            'SELECT * FROM produtos'
        );

        // Executa a consulta
        $data = $stmt->execute();

        return $data ?? null;
    }

    /**
     * Retorna os 10 produtos mais vendidos
     *
     * @return array|null
     */
    public function getProductsMostSold(){
        $stmt = $this->connection->prepare(
            'SELECT * FROM produtos ORDER BY vendas DESC LIMIT 10'
        );

        $produtos = [];

        // Executa a consulta
        $data = $stmt->execute();

        return $data ?? null;
    }

    /**
     * Retorna os 10 produtos mais visitados (mais cliques)
     *
     * @return array|null
     */
    public function getProductsMostVisiteds(){
        $stmt = $this->connection->prepare(
            'SELECT * FROM produtos ORDER BY clique DESC LIMIT 10'
        );

        // Executa a consulta
        $data = $stmt->execute();

        return $data ?? null;
    }

    /**
     * Remove um produto pelo ID
     *
     * @param mixed $id  ID do produto
     * @return bool
     *  Retorna true se o DELETE for bem-sucedido
     */
    public function deleteProductById($id){
        $stmt = $this->connection->prepare(
            'DELETE FROM produtos WHERE id = :id'
        );
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    /**
     * Cria um novo produto
     *
     * @return bool
     *  Retorna true se o INSERT for executado com sucesso
     */
    public function create(
        $nome,
        $tipo,
        $valor,
        $autor,
        $clique,
        $descricao,
        $paginas,
        $idioma,
        $vendas,
        $estoque,
        $img_path,
        $editora,
        $categoria
    ): bool {
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
     * Atualiza os dados de um produto
     *
     * @return bool
     *  Retorna true se o UPDATE for executado com sucesso
     */
    public function update(
        $id,
        $nome,
        $tipo,
        $valor,
        $autor,
        $descricao,
        $paginas,
        $idioma,
        $img_path,
        $editora,
        $categoria
    ): bool {
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
     * Busca produtos pelo nome usando LIKE
     *
     * @param string $term  Termo de busca
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

        // Retorna os resultados processados (sem transformação definida)
        return array_map([$this, ''], $results);
    }

    /**
     * Filtra produtos por categoria, tipo e faixa de preço
     *
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
            $query .= ' AND tipo = :tipo';
            $params[':tipo'] = $filters['tipo'];
        }

        $stmt = $this->connection->prepare($query);
        $stmt->execute($params);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Retorna os resultados processados (sem transformação definida)
        return array_map([$this, ''], $results);
    }

    /**
     * Atualiza o estoque de um produto
     *
     * @param int $id
     * @param int $movimentacao  Valor positivo ou negativo
     * @return bool
     */
    public function updateEstoque($id, $movimentacao){
        $query = "UPDATE produtos SET estoque = estoque + :movimentacao WHERE id = :id";

        $params = [
            ":movimentacao" => $movimentacao,
            ":id" => $id
        ];

        $stmt = $this->connection->prepare($query);

        return $stmt->execute($params);
    }

    /**
     * Incrementa o contador de cliques de um produto
     *
     * @param int $id
     * @return bool
     */
    public function updateClique($id) {
        $query = "UPDATE produtos SET clique = clique + 1 WHERE id = :id";

        $params = [
            ":id" => $id
        ];

        $stmt = $this->connection->prepare($query);

        return $stmt->execute($params);
    }
}
