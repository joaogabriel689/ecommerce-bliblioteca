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
        return $products;
    }
    function list_products(){
        $products = $this->productRepository->listProducts();
        return $products;
    }
    public function add_cartitem($id_produto, $user_id){
        $pedido = $this->pedidoRepository->findByUserAndProduto($user_id, $id_produto);
        if ($pedido == null) {
            $product = $this->productRepository->getProductById($id_produto);
            if ($product == null) {
                return "produto nao encontrado";
            }
            $this->pedidoRepository->create($user_id, $id_produto, 1, $product['valor']);
        } else {
            $this->pedidoRepository->updateQuantity($user_id, $id_produto, 1);
        }
        return "produto adicionado ao carrinho";
    }



    public function show_product($id){

        $product = $this->productRepository->getProductById($id);
        
        if ($product == null) {
            return "Product not found";
        }
        $this->productRepository->updateClique($product['id']);
        return $product;
    }




    
    public function edit_product($id, $nome, $tipo, $valor, $autor,  $descricao, $paginas, $idioma, $img_path, $editora, $categoria){
        
        return $this->productRepository->update($id, $nome, $tipo, $valor, $autor,  $descricao, $paginas, $idioma, $img_path, $editora, $categoria);
    }
    public function create_product($nome, $tipo, $valor, $autor, $clique, $descricao, $paginas, $idioma, $vendas, $estoque, $img_path, $editora, $categoria){

        return $this->productRepository->create($nome, $tipo, $valor, $autor, $clique, $descricao, $paginas, $idioma, $vendas, $estoque, $img_path, $editora, $categoria);
    }

    public function delete_product($id){
        return $this->productRepository->deleteProductById($id);
    }
}

