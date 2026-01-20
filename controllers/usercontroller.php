<?php

include("../repositories/userrepository.php");
include("../models/usermodel.php");
include("../config/connection.php");

class UserController {
    private $userRepository;
    
    public function __construct() {
        global $connection;
        $this->userRepository = new UserRepository($connection);
    }

    public function getUserById($id) {
        return $this->userRepository->findById($id);
    }
    public function getUserByEmail($email) {
        return $this->userRepository->findByEmail($email);
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
}