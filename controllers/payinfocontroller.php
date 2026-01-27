<?php
include_once __DIR__ ."/../config/connection.php";
include_once __DIR__ ."/../repositories/payinforepository.php";

class PayinfoController {

    /**
     * Repositório de informações de pagamento
     */
    private $payinfoRepository;

    /**
     * Construtor do controller
     * Inicializa o repositório de informações de pagamento usando a conexão global
     */
    public function __construct() {
        global $connection;
        $this->payinfoRepository = new PayinfoRepository($connection);
    }

    /**
     * Retorna as informações de pagamento de um usuário pelo ID do usuário
     *
     * @param int $userId ID do usuário
     * @return array Estrutura contendo status, mensagem e dados das informações de pagamento
     */
    public function getPayinfoByUserId($userId) {
        $payinfo = $this->payinfoRepository->get($userId);
    

        return [
            'status' => true,
            'message' => 'Payment info retrieved successfully',
            'data' => $payinfo
        ];
    }
    public function addpayinfo($user_id, $payinfo) {
        return $this->payinfoRepository->create($user_id, $payinfo);
    }
    public function updatepayinfo($user_id, $payinfo) {
        return $this->payinfoRepository->update($user_id, $payinfo);
    }
}