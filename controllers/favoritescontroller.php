<?php
include_once __DIR__ ."/../config/connection.php";
include_once __DIR__ ."/../repositories/favoritesrepository.php";

class FavoritesController {

    /**
     * Repositório de favoritos
     */
    private $favoritesRepository;

    /**
     * Construtor do controller
     * Inicializa o repositório de favoritos usando a conexão global
     */
    public function __construct() {
        global $connection;
        $this->favoritesRepository = new FavoritesRepository($connection);
    }

    /**
     * Adiciona um produto aos favoritos de um usuário
     *
     * @param int $userId ID do usuário
     * @param int $productId ID do produto
     * @return array Resultado da operação
     */
    public function addFavorite($userId, $productId) {
        $produto = $this->favoritesRepository->getFavoritesByUserAndItemId($userId, $productId);
        if ($produto) {
            return [
                "status" => false,
                "message" => "Produto já está nos favoritos."
            ];
        } else {
            $result = $this->favoritesRepository->addFavorite($userId, $productId);
            if ($result) {
                return [
                    "status" => true,
                    "message" => "Produto adicionado aos favoritos com sucesso."
                ];
            } else {
                return [
                    "status" => false,
                    "message" => "Falha ao adicionar produto aos favoritos."
                ];
            }
        }
    }
    public function getFavoritesByUser($userId) {
        $favorites = $this->favoritesRepository->getFavoritesByUser($userId);
        return [
            "status" => true,
            "message" => "Favoritos recuperados com sucesso.",
            "data" => $favorites
        ];
    }
    public function removeFavorite($userId, $productId) {
        $result = $this->favoritesRepository->removeFavorite($userId, $productId);
        if ($result) {
            return [
                "status" => true,
                "message" => "Produto removido dos favoritos com sucesso."
            ];
        } else {
            return [
                "status" => false,
                "message" => "Falha ao remover produto dos favoritos."
            ];
        }
    }
    

}