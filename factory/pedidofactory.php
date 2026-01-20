<?php
include_once "../models/PedidoModel.php"; 
class PedidoFactory
{
    public static function fromPost(array $post): PedidoModel
    {
        return new PedidoModel(
            id: 0,
            user_id: (int)($post['user_id'] ?? 0),
            product_id: (int)($post['product_id'] ?? 0),
            quantity: (int)($post['quantity'] ?? 1),
            total_price: (float)($post['total_price'] ?? 0),
            status: $post['status'] ?? 'pending',
            order_date: date('Y-m-d H:i:s'),
            pagamento: (int)($post['pagamento'] ?? 0)
        );
    }
}
