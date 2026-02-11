<?php

// Importa os repositórios necessários
include_once __DIR__ ."/../repositories/productrepository.php";
include_once __DIR__ ."/../repositories/pedidosrepository.php";
include_once __DIR__ ."/../config/connection.php";


/**
 * Controller responsável pelas operações relacionadas a produtos
 * e interação com o carrinho (pedidos)
 */
class Productcontroller {

    /**
     * Repositório de produtos
     */
    private $productRepository;

    /**
     * Repositório de pedidos (carrinho)
     */
    private $pedidoRepository;

    /**
     * Injeta a conexão global nos repositórios
     */
    public function __construct(){
        global $connection;
        $this->productRepository = new ProductRepository($connection);
        $this->pedidoRepository  = new PedidoRepository($connection);
    }

    /**
     * Retorna produtos em destaque:
     * - Mais vendidos
     * - Mais visitados
     */
    public function index(){
        $products_sales   = $this->productRepository->getProductsMostSold();
        $products_visits  = $this->productRepository->getProductsMostVisiteds();

        $products = [
            "most_sold"    => $products_sales,
            "most_visited" => $products_visits
        ];

        return [
            "status"  => true,
            "message" => "Products retrieved successfully",
            "data"    => $products
        ];
    }

    /**
     * Lista todos os produtos cadastrados
     */
    public function list_products($term = null, $filters = null)
    {

        if (!empty($term) && is_array($filters) && !empty($filters)) {
            $products = $this->productRepository->searchInFilteredProducts($term, $filters);
        }

        if (!empty($term)) {
            $products = $this->productRepository->searchByLike($term);
        }

        if (is_array($filters) && !empty($filters)) {
            $products = $this->productRepository->filterProducts($filters);
        }

    
        $products = $this->productRepository->listProducts();


        return [
            "status"  => true,
            "message" => "products retrieved successfully",
            "data"    => $products
        ];
    }

    /**
     * Adiciona um item ao carrinho do usuário
     * - Se já existir, incrementa a quantidade
     * - Caso contrário, cria um novo pedido pendente
     */
    public function add_cartitem($id_produto, $user_id){

        // Verifica se o produto já está no carrinho do usuário
        $pedido = $this->pedidoRepository->findByUserAndProduto($user_id, $id_produto);

        if ($pedido == null) {

            // Busca o produto
            $product = $this->productRepository->getProductById($id_produto);

            if ($product == null) {
                return [
                    "status"  => false,
                    "message" => "Product not found"
                ];
            }
            
            // Cria um novo item no carrinho com quantidade 1
            $this->pedidoRepository->create(
                $user_id,
                $id_produto,
                $product['valor'],
                1,
                $product['valor'],
            );

        } else {
            // Incrementa a quantidade do produto já existente no carrinho
            $this->pedidoRepository->updateQuantity($user_id, $id_produto, 1);
        }

        return [
            "status"  => true,
            "message" => "Product added to cart"
        ];
    }

    /**
     * Retorna os dados de um produto específico
     * Incrementa o contador de cliques (visualizações)
     */
    public function show_product($id){

        $product = $this->productRepository->getProductById($id);

        if ($product == null) {
            return [
                "status"  => false,
                "message" => "Product not found"
            ];
        }

        // Atualiza o contador de visualizações
        $this->productRepository->updateClique($product['id']);

        return [
            "status"  => true,
            "message" => "Product retrieved successfully",
            "data"    => $product
        ];
    }

    /**
     * Atualiza os dados de um produto existente
     */
    public function edit_product(
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
    ){
        // Verifica se o produto existe
        $produto = $this->productRepository->getProductById($id);

        if ($produto == null) {
            return [
                "status"  => false,
                "message" => "Product not found"
            ];
        }

        // Atualiza os dados do produto
        $data = $this->productRepository->update(
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
        );

        return [
            "status"  => true,
            "message" => "Product updated successfully",
            "data"    => $data
        ];
    }

    /**
     * Cria um novo produto
     * Verifica previamente se já existe produto com nome semelhante
     */
    public function create_product(
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
    ){
        // Verifica se já existe produto com nome semelhante
        $produto = $this->productRepository->getProductByname($nome);

        if ($produto != null) {
            return [
                "status"  => false,
                "message" => "Product exists"
            ];
        }

        // Cria o produto
        $data = $this->productRepository->create(
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
        );

        return [
            "status"  => true,
            "message" => "Product created successfully",
            "data"    => $data
        ];
    }

    /**
     * Remove um produto pelo ID
     */
    public function delete_product($id){

        $this->productRepository->deleteProductById($id);

        return [
            "status"  => true,
            "message" => "Product deleted successfully"
        ];
    }
}

