<?php
class User{
    private $name;
    private $email;
    private $pass;
    private $pass_hash;
    private $adress;
    private $city;
    private $state;
    private $fone;
    private $connection;

    public function  __construct($name, $email, $pass, $adress, $city, $state, $fone, $connection){
        $this->name = $name;
        $this->email = $email;
        $this->pass = $pass;
        $this->adress = $adress;
        $this->city = $city;
        $this->state = $state;
        $this->fone = $fone;
        $this->connection = $connection;



    }
    private static function verify_user($email, $connection){
        $sql = "SELECT * FROM usuarios WHERE email = ? ;";
        $query = $connection->prepare($sql);
        try{
            $query->execute([$email]);
        }catch(PDOexception $e){
            die("nao foi possivel verificar se o usuario existe". $e->getMessage());
        }
        if($query->rowCount() == 1){
            return true;
        }else{
            return false;
        }
    }
    private function getAll(){
        return [$this->name, $this->email, $this->pass, $this->adress, $this->city, $this->state, $this->fone];
    }
    protected function setPassworshash(){
        $pass_hash = password_hash($this->pass, PASSWORD_DEFAULT);
        $this->pass = $pass_hash;
    }
    private function pass_verify($responsepass){
        if(password_verify($this->pass, $responsepass)){
            return true;
        }else{
            return false;
        }
    }
    public function register(){
        if(User::verify_user($this->email, $this->connection)){

            $sql = "INSERT INTO usuarios (nome, email, senha, enderco, cidade, estado, telefone) VALUES (?, ?, ?, ?, ?, ?, ?);";

            $this->setPassworshash();


            $values = $this->getAll();


            $bd = $this->connection;

            try{
                $query = $bd->prepare($sql);
                $query->execute($values);


            }catch(PDOexception $e){
                die("nao foi possivel registrar o usuario ". $e->getMessage());
            }

            return [
                    'status'=> true,
                    'msg' => 'usario registrado ',

                ];
            

        }else{


            return [
                    'status'=> false,
                    'msg' => 'o usuaario ja foi registrado ',
                ];
            
        }
    }
    public function login(){
        if(User::verify_user($this->email, $this->connection)){
            $sql = "SELECT * FROM usuarios WHERE email = ?;";

            $bd = $this->connection;

            $query = $bd->prepare($sql);

            $query->execute([$this->email]);

            

            if($query->rowCount() == 1){
               $response = $query->fetchAll();
               if ($this->pass_verify($response[0]['senha'])){
                    return [
                            'status'=> true,
                            'msg' => 'usario logado ',
                            'data' => $response
                        ];
                
               }else{
                    return [
                            'status'=> false,
                            'msg' => 'senha incorreta',
                            'data' => null
                        ];
               }
            }

        }else{
            return [
                    'status'=> false,
                    'msg' => 'usario nao encontrado',
                    'data' => null
                ];

        }

    }
    public static function delete_user($email, $connection){
        if(User::verify_user($email, $connection)){
            $sql = "DELETE FROM usuarios WHERE email = ?;";
            $bd = $connection;

            $query = $bd->prepare($sql);
            try{
                $query->execute([$email]);

                return [
                    'status' => true,
                    'msg' => 'usuario deletado com sucesso '
                ];
            }catch(PDOexception $e){
                die("nao foi possivel registrar o usuario ". $e->getMessage());
            }


        }else{
            return [
                    'status' => false,
                    'msg' => 'usuario nao existe'
                
                ];
        }
    }
    public static function select_user($email, $connection){
        $sql = "SELECT * FROM usuarios WHERE email = ? ;";
        $query = $connection->prepare($sql);
        try{
            $query->execute([$email]);
        }catch(PDOexception $e){
            die("nao foi possivel verificar se o usuario existe". $e->getMessage());
        }
        if($query->rowCount() == 1){
            $response = $query->fetchAll();

            return [
                    'status'=> true,
                    'msg' => 'usario selecionado',
                    'data' => $response
                ];
        }else{
            return [
                'status' => false,
                'msg' => 'nao foi possivel selecionar esse usuario '
            ];
        }
    }
    public static function select_all_user($email, $connection){
        $sql = "SELECT * FROM usuarios ;";
        $query = $connection->prepare($sql);
        try{
            $query->execute([$email]);
        }catch(PDOexception $e){
            die("nao foi possivel verificar se o usuario existe". $e->getMessage());
        }
        if($query->rowCount() == 1){
            $response = $query->fetchAll();

            return [
                    'status'=> true,
                    'msg' => 'usarios selecionado',
                    'data' => $response
                ];
        }else{
            return [
                'status' => false,
                'msg' => 'nao foi possivel selecionar esse usuario '
            ];
        }
    }
    public function update_user(){
        if(User::verify_user($this->email, $this->connection)){

            $sql = "UPDATE usuarios SET nome = ?, endereco = ?, cidade = ?, estado = ?, telefone = ? WHERE email = ?;";




            $values = [$this->name, $this->adress, $this->city, $this->state, $this->fone, $this->email];


            $bd = $this->connection;

            try{
                $query = $bd->prepare($sql);
                $query->execute($values);

                }catch(PDOexception $e){
                    die("nao foi possivel atualizar o usuario ". $e->getMessage());
                }

                return [
                    'status' => true,
                    'msg' => 'usuario deletado com sucesso '
                ];
                    

            }else{


                return [
                    'status' => false,
                    'msg' => 'usuario nao encontrado'
                ];
                    
            }
    }


}