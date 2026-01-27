<?php

/**
 * Repositório de informações de pagamento
 *
 * Responsável por acessar e manipular a tabela `dados_banc`,
 * que armazena informações bancárias/cartão do usuário.
 *
 * ❗ Importante:
 * - Não valida dados
 * - Não cria sessão
 * - Não contém regras de negócio
 * - Executa apenas SQL
 */
class payinforepository
{
    /**
     * Conexão com o banco de dados (PDO)
     */
    private PDO $connection;

    /**
     * Construtor da classe
     *
     * Recebe a conexão via injeção de dependência.
     *
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Busca os dados bancários de um usuário
     *
     * @param int $user_id  ID do cliente
     *
     * @return array|false
     *  Retorna um array associativo com os dados
     *  ou false caso não encontre registros
     */
    public function get($user_id)
    {
        // Query para buscar os dados bancários do usuário
        $sql = "SELECT * FROM dados_banc WHERE id_cliente = :user_id";

        // Prepara a query
        $stmt = $this->connection->prepare($sql);

        // Executa a query passando o parâmetro diretamente
        $stmt->execute([':user_id' => $user_id]);

        // Retorna apenas um registro
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Atualiza os dados bancários de um usuário
     *
     * @param int   $user_id  ID do cliente
     * @param array $data     Dados que serão atualizados
     *
     * @return bool
     *  Retorna true em caso de sucesso
     */
    public function update($user_id, $data)
    {
        // Inicia a construção dinâmica da query UPDATE
        $sql = 'UPDATE dados_banc set';

        // Armazena os campos que serão atualizados
        $fields = [];

        // Monta dinamicamente os campos no formato: campo = :campo
        foreach ($data as $key => $value) {
            $fields[] = "$key = :$key";
        }

        // Concatena os campos separados por vírgula
        $sql .= implode(', ', $fields);

        // Define a condição de atualização pelo usuário
        $sql .= ' WHERE id_cliente = :user_id';

        // Prepara a query final
        $stmt = $this->connection->prepare($sql);

        // Faz o bind dinâmico de todos os valores do array $data
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        // Executa a query
        return $stmt->execute();
    }

    /**
     * Remove dados bancários do usuário
     *
     * @param int        $user_id  ID do cliente
     * @param string|null $cartao  Número ou identificador do cartão (opcional)
     *
     * @return int
     *  Retorna a quantidade de linhas afetadas
     */
    public function delete($user_id, $cartao = null){

        /**
         * Caso nenhum cartão seja informado,
         * remove todos os dados bancários do usuário
         */
        if ($cartao === null){

            $sql =  "DELETE FROM dados_banc WHERE id_cliente = :user_id";

            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":user_id", $user_id);
            $stmt->execute();

            return $stmt->rowCount();

        } else {

            /**
             * Caso um cartão seja informado,
             * remove apenas o registro correspondente
             */
            $sql =  "DELETE * FROM dados_banc 
                     WHERE id_cliente = :user_id 
                       AND cartao = :cartao";

            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":user_id", $user_id);
            $stmt->bindValue(":cartao", $cartao);
            $stmt->execute();

            return $stmt->rowCount();
        }
    }

    /**
     * Insere novos dados bancários para um usuário
     *
     * @param int   $user_id  ID do cliente
     * @param array $data     Dados bancários a serem inseridos
     *
     * @return bool
     *  Retorna true se o INSERT for bem-sucedido
     */
    public function create($user_id, $data)
    {
        /**
         * Monta dinamicamente a query INSERT
         * com base nas chaves do array $data
         */
        $sql = 'INSERT INTO dados_banc (id_cliente, ' 
             . implode(', ', array_keys($data)) 
             . ') VALUES (:user_id, ' 
             . implode(', ', array_map(fn($key) => ":$key", array_keys($data))) 
             . ')';

        // Prepara a query
        $stmt = $this->connection->prepare($sql);

        // Faz o bind do ID do usuário
        $stmt->bindValue(':user_id', $user_id);

        // Faz o bind dinâmico de todos os campos
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        // Executa o INSERT
        return $stmt->execute();
    }
}
