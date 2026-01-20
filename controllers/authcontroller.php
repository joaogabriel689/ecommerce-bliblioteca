<?php

include("../repositories/userrepository.php");
include("../models/usermodel.php");
include("../config/connection.php");

class AuthController {
    private $authRepository;
    private $userRepository;
    

    public function __construct() {
        global $connection;
        $this->userRepository = new UserRepository($connection);
    }
    public function login($email, $password) {
        $user = $this->userRepository->findByEmail($email);
        if ($user == null) {
            return "User not found.";
        }
        if (password_verify($password, $user->password)) {
            $_SESSION['user_id'] = $user->id;
            $_SESSION['email'] = $user->email;
            $_SESSION['user_group'] = $user->group;
            $_SESSION['phone'] = $user->phone;
            $_SESSION['address'] = [];
            $_SESSION['compras'] = $user->compras;
            $_SESSION['codigo'] = $user->codigo;

            return "Login successful.";
        } else {
            return "Invalid password.";
        }
    }




    public function register($name, $email, $password, $dataNasc = null, $phone = null) {
        if ($this->userRepository->findByEmail($email) != null) {
            return "Email already registered.";
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $newUser = new UserModel(
            name: $name,
            email: $email,
            password: $hashedPassword,
            dataNasc: $dataNasc,
            phone: $phone
        );

        $this->userRepository->create($newUser);
        return $this->login($email, $password);
    }
    public function logout() {
        session_unset();
        session_destroy();
        return "Logged out successfully.";
    }
}


