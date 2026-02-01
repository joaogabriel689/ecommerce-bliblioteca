<?php
class connection_bd{
    private $db_name;
    private $db_host;
    private $db_user;
    private $db_pass;
    private $mysql;
    private $connection;
    private $pdo;


    public function __construct($db_name, $db_host, $db_user, $db_pass) {

        $this->db_name = $db_name;
        $this->db_host = $db_host;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->mysql = "mysql:host=$this->db_host;dbname=$this->db_name;charset=utf8";;
        $this->connection = $this->conect($this->mysql, $this->db_user, $this->db_pass );
    }

    public function getPdo(){
        return $this->connection;
    }

    private function conect($mysql, $user, $pass){
        try{
            $pdo = new PDO($mysql, $user, $pass);
        }catch(PDOException $e){
            die("Erro de Conexão com o Banco de Dados: " . $e->getMessage());
        }
            
        return $pdo;
    }


}