<?php
class product{
    private $name;
    private $qtd;
    private $describ;
    private $price;
    private $connection;


    public function __construct($name, $qtd, $describ, $price, $connection ) {
        $this->name = $name;
        $this->qtd = $qtd;
        $this->describ = $describ;
        $this->price = $price;
        $this->connection = $connection;
    }
    
    protected function verify_product($name, $connection){
        $sql = "SELECT * FROM produtos WHERE name = ? ;";
        $query = $connection->prepare($sql);
        try{
            $query->execute([$name]);
        }catch(PDOexception $e){
            die("nao foi possivel verificar se o usuario existe". $e->getMessage());
        }
        if($query->rowCount() == 1){
            return true;
        }else{
            return false;
        }
    }


}