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

    public function  __construct(
        string $email, 
        string $pass,
        string $name = '',
        string $adress = '', 
        string $city = '', 
        string $state = '', 
        ?int $fone = null,
        $connection = null
        )
        {
        $this->name = $name;
        $this->email = $email;
        $this->pass = $pass;
        $this->adress = $adress;
        $this->city = $city;
        $this->state = $state;
        $this->fone = $fone;
        $this->connection = $connection;



    }
    protected static function verify_user($email, $connection){
        $sql = "SELECT * FROM usuarios WHERE email = ? LIMIT 1;";
        $query = $connection->prepare($sql);
        try{
            $query->execute([$email]);
            $response = $query->fetchAll();
        }catch(PDOException $e){
            die("nao foi possivel verificar se o usuario existe". $e->getMessage());
        }
        if($query->rowCount() == 1){
            return [
                    'status'=> true,
                    'msg' => 'usario encontrado',
                    'data' => $response
                ];
        }else{
            return [
                    'status'=> false,
                    'msg' => 'usario nao encontardo',
                ];
        }
    }
    public function getAll(){
        return [$this->email, $this->pass,$this->name, $this->adress, $this->city, $this->state, $this->fone];
    }
    protected function setPasswordhash(){
        $pass_hash = password_hash($this->pass, PASSWORD_DEFAULT);
        return $pass_hash;
    }
    public function register(){
        $verify = User::verify_user($this->email, $this->connection );
        if($verify['status'] == false){

            $sql = "INSERT INTO usuarios ( email,senha, nome, endereco, cidade, estado, telefone) VALUES (?, ?, ?, ?, ?, ?, ?);";

            $pass_hash = $this->setPasswordhash();


            $values = $this->getAll();
            $values[1] = $pass_hash;



            $bd = $this->connection;

            try{
                $query = $bd->prepare($sql);
                $query->execute($values);


            }catch(PDOException $e){
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
        $verify = User::verify_user($this->email, $this->connection );
        if($verify['status'] == true){
            if (password_verify($this->pass, $verify['data'][0]["senha"])){
                $response = $verify['data'][0];
                $response['senha'] = "";
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


        }else{

            return [
                    'status'=> false,
                    'msg' => 'usuario nao encontrado login',
                    'data' => null
                ];

        }


    }
    public static function delete_user($email, $connection){
        $verify = User::verify_user($this->email, $this->connection );
        if($verify['status'] == true){
            $sql = "DELETE FROM usuarios WHERE email = ?;";
            $bd = $connection;

            $query = $bd->prepare($sql);
            try{
                $query->execute([$email]);

                return [
                    'status' => true,
                    'msg' => 'usuario deletado com sucesso '
                ];
            }catch(PDOException $e){
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
        }catch(PDOException $e){
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
    public static function select_all_user( $connection){
        $sql = "SELECT nome,email,endereco,estado,cidade,telefone FROM usuarios;";
        $query = $connection->prepare($sql);
        try{
            $query->execute();
        }catch(PDOException $e){
            die("nao foi possivel verificar se o usuario existe". $e->getMessage());
        }
        if($query->rowCount() > 0){
            $response = $query->fetchAll(PDO::FETCH_ASSOC);

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
        $verify = User::verify_user($this->email, $this->connection );
        if($verify['status'] == true){

            $sql = "UPDATE usuarios SET nome = ?, endereco = ?, cidade = ?, estado = ?, telefone = ? WHERE email = ?;";




            $values = [$this->name, $this->adress, $this->city, $this->state, $this->fone, $this->email];


            $bd = $this->connection;

            try{
                $query = $bd->prepare($sql);
                $query->execute($values);

                }catch(PDOException $e){
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