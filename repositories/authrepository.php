<?php

// Inclui o arquivo responsável pela conexão com o banco de dados
// Presume-se que ele forneça uma instância válida de PDO
require_once __DIR__ . '/../config/connection.php';


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
     * Autentica um usuário com base em username e senha$senha
     *
     * @param object $user
     *  Espera um objeto contendo:
     *  - $user->username
     *  - $user->senha$senha
     *
     * @return array|null
     *  Retorna os dados do usuário se a autenticação for válida
     *  ou null caso falhe
     */
    public function authenticate($email, $senha) {

        $stmt = $this->connection->prepare(
            'SELECT * FROM usuarios WHERE email = :email'
        );

        $stmt->bindParam(':email', $email);

        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        

        if ($user && password_verify($senha, $user['senha'])) {
            unset($user['senha']);
            return $user;

        }

        return null;
    }

}