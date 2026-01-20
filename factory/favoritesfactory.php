<?php
include_once "../models/FavoritesModel.php";

class FavoritesFactory
{
    public static function fromPost(array $post): FavoritesModel
    {
        return new FavoritesModel(
            id: 0,
            user_id: (int)($post['user_id'] ?? 0),
            product_id: (int)($post['product_id'] ?? 0)
        );
    }
}
