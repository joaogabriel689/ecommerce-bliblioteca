<?php

include("../repositories/pedidosrepository.php");
include("../config/connection.php");

class PedidosController {
    private $pedidoRepository;
    
    public function __construct() {
        global $connection;
        $this->pedidoRepository = new PedidoRepository($connection);
    }

    
    public function show_cart($id_usuario, $status = "pendente") {
        $pedido = $this->pedidoRepository->findByUserAndStatus($id_usuario, $status);
        $total = 0;
        $itens =[
            'produto' => [],
        ];
        for ($i = 0; $i < count($pedido); $i++) {
            $total += $pedido[$i]['valor_total'];

            $itens['produto'][$i] = $pedido[$i]['id'];
            $itens['produto'][$i] = $pedido[$i]['id_produto'];
            $itens['produto'][$i] = $pedido[$i]['valor_produto'];
            $itens['produto'][$i] = $pedido[$i]['quantidade'];
            $itens['produto'][$i] = $pedido[$i]['valor_total'];
        }
        $data = [
            'itens' => $itens,
            'total' => $total
        ];

        return ['status' => true, 'message' => 'Cart retrieved successfully', 'data' => $data];
    }

    public function finalizarPedido($id_pedido, $forma_pagamento){
        return $this->pedidoRepository->updateStatus($id_pedido, "finalizado", $forma_pagamento);
    }

    public function updateStatus($id, $status, $forma_pagamento = 0){
        $status_possiveis = ['pendente', 'processando', 'enviado', 'entregue', 'cancelado'];
        if (!in_array($status, $status_possiveis)) {
            return false;
        }
        $pedido = $this->pedidoRepository->updateStatus($id, $status, $forma_pagamento);
        return ['status' => true, 'message' => 'Status updated successfully', 'data' => $pedido];
    }


}