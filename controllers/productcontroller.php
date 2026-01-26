<?php

include("../repositories/productrepository.php");
include("../repositories/pedidosrepository.php");
include("../config/connection.php");

class Productcontroller{
    private $productRepository;
    private $pedidoRepository;
    public function __construct(){
        global $connection;
        $this->productRepository = new ProductRepository($connection);
        $this->pedidoRepository = new PedidoRepository($connection);
    }
    public function index(){
        $products_sales = $this->productRepository->getProductsMostSold();
        $products_visits = $this->productRepository->getProductsMostVisiteds();
        $products = [
            "most_sold" => $products_sales,
            "most_visited" => $products_visits
        ];

        return ["status" => true, "message" => "Products retrieved successfully", "data" => $products];
    }
    function list_products(){
        $products = $this->productRepository->listProducts();
        return ["status"=> true,"message"=> "products retrieved successfully","data"=> $products];
    }
    public function add_cartitem($id_produto, $user_id){
        $pedido = $this->pedidoRepository->findByUserAndProduto($user_id, $id_produto);
        if ($pedido == null) {
            $product = $this->productRepository->getProductById($id_produto);
            if ($product == null) {
                return ["status"=> false,"message"=> "Product not found"];
            }
            $this->pedidoRepository->create($user_id, $id_produto, 1, $product['valor']);
        } else {
            $this->pedidoRepository->updateQuantity($user_id, $id_produto, 1);
        }
        return ["status" => true, "message" => "Product added to cart"];
    }



    public function show_product($id){

        $product = $this->productRepository->getProductById($id);
        
        if ($product == null) {
            return ["status"=> false,"message"=> "Product not found"];
        }
        $this->productRepository->updateClique($product['id']);
        return ["status" => true, "message" => "Product retrieved successfully", "data" => $product];
    }




    
    public function edit_product($id, $nome, $tipo, $valor, $autor,  $descricao, $paginas, $idioma, $img_path, $editora, $categoria){
        $produto = $this->productRepository->getProductById($id);
        if ($produto == null) {
            return ["status"=> false,"message"=> "Product not found"];
        }
        $data = $this->productRepository->update($id, $nome, $tipo, $valor, $autor,  $descricao, $paginas, $idioma, $img_path, $editora, $categoria);
        return ["status"=> true,"message"=> "Product updated successfully","data"=> $data];
    }
    public function create_product($nome, $tipo, $valor, $autor, $clique, $descricao, $paginas, $idioma, $vendas, $estoque, $img_path, $editora, $categoria){
        //criar um metodo no repositorio de produtos para verificar se o produto ja existe pelo nome do produto!!!!!!

    
        $produto = $this->productRepository->getProductById($id);
        if ($produto != null) {
            return ["status"=> false,"message"=> "Product exists"];
        }
    
        $data = $this->productRepository->create($nome, $tipo, $valor, $autor, $clique, $descricao, $paginas, $idioma, $vendas, $estoque, $img_path, $editora, $categoria);
        return ["status"=> true,"message"=> "Product created successfully","data"=> $data];
    }

    public function delete_product($id){
        $produto = $this->productRepository->deleteProductById($id);
        return ["status"=> true,"message"=> "Product deleted successfully"];

        
    }
}

    