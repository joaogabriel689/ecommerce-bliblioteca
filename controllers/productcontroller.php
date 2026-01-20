<?php

include("../repositories/productrepository.php");
include("../repositories/pedidosrepository.php");
include("../models/productmodel.php");
include("../models/pedidosmodel.php");
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
    public function add_click($id){
        $product = $this->productRepository->getProductById($id);
        $product->clicks += 1;
        $this->productRepository->update($product);
        return $this->show_product($id);
    }
    function list_products(){
        $products = $this->productRepository->listProducts();
        return $products;
    }
    public function add_cartitem($id, $user_id){
        $product = $this->productRepository->getProductById($id);
        $product->vendas += 1;
        $cartitem = new pedidomodel(
            0,
            $user_id,
            $product->id,
            1,
            $product->price,
            "pending",
            date("Y-m-d H:i:s"),
            0
        );
        $this->pedidoRepository->create($cartitem);
        return "Item added to cart";
    }



    public function show_product($id){

        $product = $this->productRepository->getProductById($id);
        if ($product == null) {
            return "Product not found";
        }

        return $product;
    }
    public function edit_product($product){
        
        return $this->productRepository->update($product);
    }
    public function create_product($product){
        return $this->productRepository->create($product);
    }
    public function update_product($product){
        return $this->productRepository->update($product);
    }
    public function delete_product($id){
        return $this->productRepository->deleteProductById($id);
    }
}

