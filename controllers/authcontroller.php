<?php


include_once __DIR__ . "/../repositories/userrepository.php";
include_once __DIR__ . "/../utils/validators.php";
include_once __DIR__ . "/../config/connection.php";

/**
 * Controller responsável pela autenticação de usuários
 * (login, registro e logout)
 */
class AuthController {

    /**
     * Repositório responsável por autenticação
     */
    private $authRepository;

    /**
     * Repositório de usuários
     */
    private $userRepository;
    
    /**
     * Construtor do controller
     * Inicializa os repositórios usando a conexão global
     */
    public function __construct() {
        global $connection;
        $this->userRepository = new UserRepository($connection);
        $this->authRepository = new AuthRepository($connection);
    }

    /**
     * Realiza o login do usuário
     *
     * - Valida o formato do email
     * - Busca o usuário no banco
     * - Verifica a senha
     * - Cria a sessão do usuário autenticado
     *
     * @param string $email
     * @param string $password
     * @return array Resultado da autenticação
     */
    public function login($email, $password) {

        // Valida formato do email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) ) {
            return ["status" => false, "message" => "email invalido"];
        }

        // Busca usuário pelo email
        $user = $this->userRepository->findByEmail($email);

        if ($user == null) {
            return ["status" => false, "message" => "User not found."];
        }

        // Verifica a senha informada com o hash armazenado
        if (password_verify($password, $user['senha'])) {

            // Dados mínimos armazenados na sessão
            $user_loged = [
                'id' => $user['id'],
                'name' => $user['nome'],
                'email' => $user['email'],
                'group_code' => $user['group_code']
            ];





            return [
                "status" => true,
                "message" => "Login successful.",
                "data" => $user_loged
            ];

        } else {
            return ["status" => false, "message" => "Invalid password."];
        }
    }

    /**
     * Realiza o cadastro de um novo usuário
     *
     * - Valida CPF
     * - Valida email
     * - Verifica se o email já está cadastrado
     * - Cria o usuário
     * - Efetua login automaticamente após o cadastro
     *
     * @return array Resultado da operação
     */
    public function register($name, $email, $cpf, $password, $dataNasc, $phone, $compras, $group) {

        // Valida CPF
        if (validarCPF($cpf) == false) {
            return ["status" => false, "message" => "cpf invalido"];
        }

        // Valida email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) ) {
            return ["status" => false, "message" => "email invalido"];
        }
        if (!validarCelularBR($phone) == 1 ?? false) {
            return ["status" => false, "message" => "telefone invalido"];
        }

        // Verifica se o email já existe
        if ($this->userRepository->findByEmail($email) != null) {
            return ["status" => false, "message" => "Email already registered."];
        }

        // Cria o usuário no banco
        $this->userRepository->create(
            $name,
            $email,
            $cpf,
            $password,
            $dataNasc,
            $phone,
            $compras,
            $group
        );

        // Realiza login automático após cadastro
        return $this->login($email, $password);
    }

    /**
     * Finaliza a sessão do usuário
     *
     * - Remove todas as variáveis de sessão
     * - Destroi a sessão
     *
     * @return array
     */
    public function logout() {
        session_unset();
        session_destroy();
        return ["status" => true, "message" => "Logged out successfully."];
    }
}
