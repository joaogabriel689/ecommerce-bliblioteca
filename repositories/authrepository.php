<?php

// Inclui o arquivo responsável pela conexão com o banco de dados
// Presume-se que ele forneça uma instância válida de PDO
include("../config/connection.php");

/**
 * Repositório de autenticação
 *
 * Responsável exclusivamente por acessar o banco de dados
 * para validar as credenciais do usuário.
 *
 * ❗ Regra importante:
 * - Esta classe NÃO cria sessão
 * - NÃO contém regras de negócio
 * - Apenas executa SQL e retorna dados
 */
class authrepository {

    /**
     * Conexão com o banco de dados (PDO)
     */
    private $connection;

    /**
     * Construtor da classe
     *
     * Recebe a conexão por injeção de dependência,
     * permitindo desacoplamento e testes mais fáceis.
     *
     * @param PDO $connection
     */
    public function __construct($connection){
        $this->connection = $connection;
    }

    /**
     * Autentica um usuário com base em username e password
     *
     * @param object $user
     *  Espera um objeto contendo:
     *  - $user->username
     *  - $user->password
     *
     * @return array|null
     *  Retorna os dados do usuário se a autenticação for válida
     *  ou null caso falhe
     */
    public function authenticate($user){

        // Extrai o username e a senha do objeto recebido
        $username = $user->username;
        $password = $user->password;

        // Prepara a query para buscar o usuário pelo nome
        // Uso de prepared statement para evitar SQL Injection
        $stmt = $this->connection->prepare(
            'SELECT * FROM users WHERE name = :name'
        );

        // Faz o bind do parâmetro :name com o username informado
        $stmt->bindParam(':name', $username);

        // Executa a query no banco de dados
        $stmt->execute();

        // Busca o usuário como array associativo
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        /**
         * Verifica duas condições:
         * 1. Se o usuário existe no banco
         * 2. Se a senha informada confere com o hash salvo
         */
        if ($user && password_verify($password, $user['password'])) {
            // Autenticação bem-sucedida
            // Retorna os dados completos do usuário
            return $user;
        }

        // Caso usuário não exista ou senha esteja incorreta
        return null;
    }
}
