<?php
class Product{
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
    
    public function verify_product($name, $connection){
        $sql = "SELECT * FROM produtos WHERE nome = ? ;";
        $query = $connection->prepare($sql);
        try{
            $query->execute([$name]);
            $result = $query->fetchAll();
        }catch(PDOexception $e){
            die("nao foi possivel verificar se o produto existe". $e->getMessage());
        }
        if($query->rowCount() == 1){
            return [
                    'status'=> true,
                    'msg' => 'produto encontrado',
                    'data' => $response
                ];
        }else{
            return [
                    'status'=> false,
                    'msg' => 'produto nao encontardo',
                ];
        }
    }
    public static function select_product($name, $connection){
        $sql = "SELECT * FROM produtos WHERE nome = ? ;";
        $query = $connection->prepare($sql);
        try{
            $query->execute([$name]);
        }catch(PDOexception $e){
            die("nao foi possivel selecionar o produto ". $e->getMessage());
        }
        if($query->rowCount() == 1){
            $response = $query->fetchAll();

            return [
                    'status'=> true,
                    'msg' => 'produto selecionado',
                    'data' => $response
                ];
        }else{
            return [
                'status' => false,
                'msg' => 'nao foi possivel selecionar esse produto '
            ];
        }
    }
    public static function select_all_user($name, $connection){
        $sql = "SELECT * FROM produtos ;";
        $query = $connection->prepare($sql);
        try{
            $query->execute([$name]);
        }catch(PDOexception $e){
            die("nao foi possivel selecionar os produtos ". $e->getMessage());
        }
        if($query->rowCount() == 1){
            $response = $query->fetchAll();

            return [
                    'status'=> true,
                    'msg' => 'produtos selecionados',
                    'data' => $response
                ];
        }else{
            return [
                'status' => false,
                'msg' => 'nao foi possivel selecionar esse produto '
            ];
        }
    }
    private function getAll(){
        return [$this->name, $this->qtd, $this->describ, $this->price];
    }
    public function add_product(){
        if(Product::verify_product($this->name, $this->connection)){

            $sql = "INSERT INTO produtos (nome, qtd, descricao, valor) VALUES (?, ?, ?, ?);";



            $values = $this->getAll();


            $bd = $this->connection;

            try{
                $query = $bd->prepare($sql);
                $query->execute($values);


            }catch(PDOexception $e){
                die("nao foi possivel registrar o produto ". $e->getMessage());
            }

            return [
                    'status'=> true,
                    'msg' => 'produto registrado ',

                ];
            

        }else{


            return [
                    'status'=> false,
                    'msg' => 'o produto ja foi registrado ',
                ];
            
        }
    }
    public static function delete_product($name, $connection){
        if(Product::verify_product($name, $connection)){
            $sql = "DELETE FROM usuarios WHERE nome = ?;";
            $bd = $connection;
            $query = $bd->prepare($sql);
            try{
                $query->execute([$email]);

                return [
                    'status' => true,
                    'msg' => 'produto deletado com sucesso '
                ];
            }catch(PDOexception $e){
                die("nao foi possivel deletar o produto ". $e->getMessage());
            }


        }else{
            return [
                    'status' => false,
                    'msg' => 'produto nao existe'
                
                ];
        }
    }
    public function update_product($oldname){
        if(Product::verify_product($this->name, $this->connection)){

            $sql = "UPDATE produtos SET nome = ?, qtd = ?, descricao = ?, price = ? WHERE nome = ?;";




            $values = [$this->name, $this->qtd, $this->describ, $this->price, $oldname];


            $bd = $this->connection;

            try{
                $query = $bd->prepare($sql);
                $query->execute($values);

                }catch(PDOexception $e){
                    die("nao foi possivel atualizar o produto ". $e->getMessage());
                }

                return [
                    'status' => true,
                    'msg' => 'usuario deletado com produto '
                ];
                    

            }else{


                return [
                    'status' => false,
                    'msg' => 'produto nao encontrado'
                ];
                    
            }
    }



}