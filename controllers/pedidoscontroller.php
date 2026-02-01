<?php

include_once __DIR__ . "/../repositories/pedidosrepository.php";
include_once __DIR__ . "/../config/connection.php";

/**
 * Controller responsável por operações relacionadas a pedidos
 * (carrinho, finalização e atualização de status)
 */
class PedidosController {

    /**
     * Repositório de pedidos
     *
     * @var PedidoRepository
     */
    private $pedidoRepository;
    
    /**
     * Construtor do controller
     * Inicializa o repositório de pedidos usando a conexão global
     */
    public function __construct() {
        global $connection;
        $this->pedidoRepository = new PedidoRepository($connection);
    }

    /**
     * Retorna o carrinho (ou pedidos) de um usuário com base no status
     *
     * - Busca os pedidos do usuário
     * - Soma o valor total
     * - Organiza os itens retornados
     *
     * @param int $id_usuario ID do usuário
     * @param string $status Status do pedido (padrão: pendente)
     * @return array Estrutura contendo status, mensagem e dados do carrinho
     */
    public function show_cart($id_usuario, $status = "pendente") {

        // Busca os pedidos do usuário pelo status
        $pedido = $this->pedidoRepository->findByUserAndStatus($id_usuario, $status);

        // Total acumulado do carrinho
        $total = 0;

        // Estrutura base dos itens
        $itens = [
            'produto' => [],
        ];

        // Percorre todos os pedidos retornados
        for ($i = 0; $i < count($pedido); $i++) {

            // Soma o valor total do pedido
            $total += $pedido[$i]['valor_total'];

            // Montagem dos dados do produto
            $itens['produto'][$i] = [
                'id_pedido'     => $pedido[$i]['id'],
                'id_produto'    => $pedido[$i]['id_produto'],
                'valor_produto' => $pedido[$i]['valor_produto'],
                'quantidade'    => $pedido[$i]['quantidade'],
                'valor_total'   => $pedido[$i]['valor_total'],
            ];
        }

        // Estrutura final de resposta
        $data = [
            'itens' => $itens,
            'total' => $total
        ];

        return [
            'status' => true,
            'message' => 'Cart retrieved successfully',
            'data' => $data
        ];
    }


    /**
     * Atualiza o status de um pedido
     *
     * - Valida se o status informado é permitido
     * - Atualiza o status no banco
     *
     * @param int $id ID do pedido
     * @param string $status Novo status do pedido
     * @param int $forma_pagamento Código da forma de pagamento (opcional)
     * @return array|bool Retorna erro ou estrutura de sucesso
     */
    public function updateStatus($id_usuario, $id_produto, $status, $forma_pagamento = 0){

        // Lista de status permitidos
        $status_possiveis = [
            'pendente',
            'processando',
            'enviado',
            'entregue',
            'cancelado'
        ];

        // Validação do status
        if (!in_array($status, $status_possiveis)) {
            return false;
        }

        // Atualiza o status do pedido
        $pedido = $this->pedidoRepository->updateStatus(
            $id_usuario,
            $id_produto,
            $status,
            $forma_pagamento
        );

        return [
            'status' => true,
            'message' => 'Status updated successfully',
            'data' => $pedido
        ];
    }

}
