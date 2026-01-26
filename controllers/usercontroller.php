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
        $user = $this->userRepository->findById($id);
        return ['status' => true, 'message' => 'User retrieved successfully', 'data' => $user];
    }





    public function getAllUsers() {
        $users = $this->userRepository->listAll();
        return ['status' => true, 'message' => 'Users retrieved successfully', 'data' => $users];
    }




    public function updateUser($id, $name, $cpf, $email, $password = null, $dataNasc = null, $phone = null, $group_code = null, $codigo = null) {
        $user = $this->getUserById($id);
        if ($user == null) {
            return "User not found.";
        }
        $data = $this->userRepository->update($id, $name, $email, $cpf, $password, $dataNasc, $phone, null, $group_code, $codigo);


    
        return ['status' => true, 'message' => 'User updated successfully', 'data' => $data];
    }





    public function deleteUser($id) {
        $user = $this->getUserById($id);
        if ($user == null) {
            return "User not found.";
        }
        $data = $this->userRepository->delete($id);
        return ['status' => true, 'message' => 'User deleted successfully', 'data' => $data];
    }





    
}