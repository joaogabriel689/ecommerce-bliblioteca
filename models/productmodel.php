<?php
class productmodel{
    public $id;
    public $name;
    public $description;
    public $price;
    public $stock;
    public $category;
    public $codigo;
    public $paginas;
    public $vendas;

    public $clicks;

    public function __construct(
        int $id,
        string $name ="",
        string $description= "",
        float $price= 0.0,
        int $stock= 0,
        string $category= "",
        int $codigo= 0,
        int $paginas= 0,
        int $vendas= 0,
        int $clicks= 0,
    ){

        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->stock = $stock;
        $this->category = $category;
        $this->codigo = $codigo;
        $this->paginas = $paginas;
        $this->vendas = $vendas;
        $this->clicks = $clicks;
        
    }
}