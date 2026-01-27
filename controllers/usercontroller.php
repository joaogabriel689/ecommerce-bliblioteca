<?php
include_once __DIR__ ."/../repositories/userrepository.php";
include_once __DIR__ ."/../repositories/pedidosrepository.php";
include_once __DIR__ ."/../config/connection.php";

/**
 * Controller responsável por operações relacionadas aos usuários
 * (consulta, listagem, atualização e remoção)
 */
class UserController {

    /**
     * Repositório de usuários
     *
     * @var UserRepository
     */
    private $userRepository;

    /**
     * Repositório de pedidos
     *
     * @var PedidoRepository
     */
    private $pedidosrepository;
    
    /**
     * Construtor do controller
     * Inicializa os repositórios utilizando a conexão global
     */
    public function __construct() {
        global $connection;
        $this->userRepository = new UserRepository($connection);
        $this->pedidosrepository = new PedidoRepository($connection);
    }

    /**
     * Retorna os dados de um usuário pelo ID
     *
     * @param int $id ID do usuário
     * @return array Estrutura contendo status, mensagem e dados do usuário
     */
    public function getUserById($id) {

        // Busca o usuário no repositório
        $user = $this->userRepository->findById($id);

        return [
            'status' => true,
            'message' => 'User retrieved successfully',
            'data' => $user
        ];
    }
    public function getUserByEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) ) {
            return ["status" => false, "message" => "email invalido"];
        }
        $user = $this->userRepository->findByEmail($email);
        return ['status' => true,'message'=> 'user retrieved sucessfully','data'=> $user];
    }

    /**
     * Retorna todos os usuários cadastrados
     *
     * @return array Estrutura contendo status, mensagem e lista de usuários
     */
    public function getAllUsers() {

        // Busca todos os usuários
        $users = $this->userRepository->listAll();

        return [
            'status' => true,
            'message' => 'Users retrieved successfully',
            'data' => $users
        ];
    }

    /**
     * Atualiza os dados de um usuário
     *
     * - Busca o usuário antes da atualização
     * - Atualiza os dados informados
     *
     * @param int $id ID do usuário
     * @param string $name Nome
     * @param string $cpf CPF
     * @param string $email Email
     * @param string|null $password Senha (opcional)
     * @param string|null $dataNasc Data de nascimento (opcional)
     * @param string|null $phone Telefone (opcional)
     * @param string|null $group_code Código do grupo/perfil (opcional)
     * @return array Resultado da operação
     */
    public function updateUser(
        $id,
        $name,
        $cpf,
        $email,
        $password = null,
        $dataNasc = null,
        $phone = null,
        $group_code = null
    ) {

        // Busca o usuário antes de atualizar
        $user = $this->getUserById($id);

        if ($user == null) {
            return ["status" => false, "message" => "User not found."];
        }

        // Executa a atualização no repositório
        $data = $this->userRepository->update(
            $id,
            $name,
            $email,
            $cpf,
            $password,
            $dataNasc,
            $phone,
            $group_code
        );

        return [
            'status' => true,
            'message' => 'User updated successfully',
            'data' => $data
        ];
    }

    /**
     * Remove um usuário do sistema
     *
     * @param int $id ID do usuário
     * @return array|string Resultado da operação
     */
    public function deleteUser($id) {

        // Verifica se o usuário existe
        $user = $this->getUserById($id);

        if ($user == null) {
            return "User not found.";
        }

        // Remove o usuário
        $data = $this->userRepository->delete($id);

        return [
            'status' => true,
            'message' => 'User deleted successfully',
            'data' => $data
        ];
    }
}
