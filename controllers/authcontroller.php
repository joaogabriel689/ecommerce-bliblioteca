<?php

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
            return "email invalido";
        }
        $user = $this->userRepository->findByEmail($email);
        if ($user == null) {
            return "User not found.";
        }
        if (password_verify($password, $user['senha'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['nome'];
            $_SESSION['user_group'] = $user['grupo'];
            return true;
        } else {
            return false;
        }
    }




    public function register($name, $email, $cpf, $password, $dataNasc, $phone, $compras, $group, $codigo) {

        if (validarCPF($cpf) == false) {
            return 'cpf invalido';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) ) {
            return "email invalido";
        }

        if ($this->userRepository->findByEmail($email) != null) {
            return "Email already registered.";
        }

        $this->userRepository->create($name, $email, $cpf, $password, $dataNasc, $phone, $compras, $group);
        return $this->login($email, $password);
    }
    public function logout() {
        session_unset();
        session_destroy();
        return "Logged out successfully.";
    }
}


