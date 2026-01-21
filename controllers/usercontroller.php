<?php

include("../repositories/userrepository.php");
include("../repositories/pedidosrepository.php");
include("../models/usermodel.php");
include("../models/pedidomodel.php");
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
    public function updateUser($id, $name, $email, $password = null, $dataNasc = null, $phone = null) {
        $user = $this->getUserById($id);
        if ($user == null) {
            return "User not found.";
        }

        $updatedUser = new UserModel(
            id: $id,
            name: $name,
            email: $email,
            password: $password,
            dataNasc: $dataNasc,
            phone: $phone
        );

        return $this->userRepository->update($updatedUser);
    }
    public function deleteUser($id) {
        $user = $this->getUserById($id);
        if ($user == null) {
            return "User not found.";
        }

        return $this->userRepository->delete($id);
    }
    public function getCartItems($user_code, $status = "pending") {
        $user = $this->getUserById($user_code);
        if ($user == null) {
            return "User not found.";
        }
        $result =$this->pedidosrepository->findByUserAndStatus($user_code, $status);

        return $result;
    }
}