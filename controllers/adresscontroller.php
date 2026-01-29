<?php

include_once __DIR__ ."/../repositories/adressrepository.php";
include_once __DIR__ ."/../config/connection.php";

class AdressController {

    /**
     * Repositório de endereços
     */
    private $adressRepository;

    /**
     * Construtor do controller
     * Inicializa o repositório de endereços usando a conexão global
     */
    public function __construct() {
        global $connection;
        $this->adressRepository = new AdressRepository($connection);
    }

    /**
     * Retorna os endereços de um usuário pelo ID do usuário
     *
     * @param int $userId ID do usuário
     * @return array Estrutura contendo status, mensagem e dados dos endereços
     */
    public function getAdressesByUserId($userId) {
        $adresses = $this->adressRepository->get($userId);

        return [
            'status' => true,
            'message' => 'Adresses retrieved successfully',
            'data' => $adresses
        ];
    }
    public function addadress($userId, $data) {
        $adress = validarCEP($data['cep']);
        if (!$adress) {
            return [
                'status' => false,
                'message' => 'Invalid CEP'
            ];
        }
        $adress['complemento'] = $data['complemento'];
        $adress['numero'] = $data['numero'];
        $success = $this->adressRepository->create($userId, $adress);

        if ($success) {
            return [
                'status' => true,
                'message' => 'Address added successfully'
            ];
        } else {
            return [
                'status' => false,
                'message' => 'Failed to add address'
            ];
        }
    }
    public function editadress($userId, $data) {
        return $this->adressRepository->update($userId, $data);
    }
    public function deleteadress($userId, $id) {
        return $this->adressRepository->delete($userId, $id);
    }
}