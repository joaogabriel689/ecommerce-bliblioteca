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

        return [
            "itens" => $itens,
            "total" => $total
        ];
    }


    public function updateStatus($id, $status){
        $status_possiveis = ['pendente', 'processando', 'enviado', 'entregue', 'cancelado'];
        if (!in_array($status, $status_possiveis)) {
            return false;
        }
        return $this->pedidoRepository->updateStatus($id, $status);
    }


}