<?php
include("../models/productmodel.php");
class ProductFactory
{
    public static function fromPost(array $post): ProductModel
    {
        return new ProductModel(
            id: 0,
            name: $post['name'] ?? 'Produto',
            description: $post['description'] ?? '',
            price: (float)($post['price'] ?? 0),
            stock: (int)($post['stock'] ?? 0),
            category: $post['category'] ?? 'geral',
            codigo: $post['codigo'] ?? null,
            paginas: (int)($post['paginas'] ?? 0),
            vendas: (int)($post['vendas'] ?? 0),
            clicks: (int)($post['clicks'] ?? 0)
        );
    }
}
