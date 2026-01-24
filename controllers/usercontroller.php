<?php

include("../repositories/userrepository.php");
include("../repositories/pedidorepository.php");
include("../config/connection.php");

class UserController {
    private $userRepository;
    private $pedidosrepository;
    
    public function __construct() {
        global $connection;
        $this->userRepository = new UserRepository($connection);
        $this->pedidosrepository = new PedidoRepository($connection);
    }




    public function getUserById($id) {
        return $this->userRepository->findById($id);
    }





    public function getAllUsers() {
        return $this->userRepository->listAll();
    }




    public function updateUser($id, $name, $cpf, $email, $password = null, $dataNasc = null, $phone = null, $group_code = null, $codigo = null) {
        $user = $this->getUserById($id);
        if ($user == null) {
            return "User not found.";
        }


        return $this->userRepository->update($id, $name, $email, $cpf, $password, $dataNasc, $phone, null, $group_code, $codigo);
    }



    public function deleteUser($id) {
        $user = $this->getUserById($id);
        if ($user == null) {
            return "User not found.";
        }

        return $this->userRepository->delete($id);
    }



    public function getCartItems($id_usuario, $status = "pending") {
        $user = $this->getUserById($id_usuario);
        if ($user == null) {
            return "User not found.";
        }
        $result =$this->pedidosrepository->findByUserAndStatus($id_usuario, $status);

        return $result;
    }

    
}