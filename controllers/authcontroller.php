<?php
session_start();
include("../repositories/userrepository.php");
include("../utils/validators.php");
include("../config/connection.php");

class AuthController {
    private $authRepository;
    private $userRepository;
    

    public function __construct() {
        global $connection;
        $this->userRepository = new UserRepository($connection);
        $this->authRepository = new AuthRepository($connection);
    }
    public function login($email, $password) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) ) {
            return ["status" => false, "message" => "email invalido"];
        }
        $user = $this->userRepository->findByEmail($email);
        if ($user == null) {
            return ["status" => false, "message" => "User not found."];
        }
        if (password_verify($password, $user['senha'])) {
            $user_loged = ['id' => $user['id'], 'name' => $user['nome'], 'email' => $user['email'], 'group_code' => $user['group_code']];
            $_SESSION['user'] = $user_loged;
            return ["status" => true, "message" => "Login successful.", "data" => $user_loged];
        } else {
            return ["status" => false, "message" => "Invalid password."];
        }
    }




    public function register($name, $email, $cpf, $password, $dataNasc, $phone, $compras, $group) {

        if (validarCPF($cpf) == false) {
            return ["status" => false, "message" => "cpf invalido"];
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) ) {
            return ["status" => false, "message" => "email invalido"];
        }

        if ($this->userRepository->findByEmail($email) != null) {
            return ["status" => false, "message" => "Email already registered."];
        }

        $this->userRepository->create($name, $email, $cpf, $password, $dataNasc, $phone, $compras, $group);
        return $this->login($email, $password);
    }
    public function logout() {
        session_unset();
        session_destroy();
        return ["status" => true, "message" => "Logged out successfully."];
    }
}


