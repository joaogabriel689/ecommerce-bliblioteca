<?php
include("");
class pedidomodel{
    public $id;
    public $user_id;
    public $product_id;
    public $quantity;
    public $total_price;
    public $status;
    public $order_date;

    public int $pagamento;

    public function __construct(
        int $id,
        int $user_id,
        int $product_id,
        int $quantity = 1,
        float $total_price = 0.0,
        string $status = "pending",
        string $order_date = "",
        int $pagamento = 0
        ){
        $this->id = $id;
        $this->user_id = $user_id;
        $this->product_id = $product_id;
        $this->quantity = $quantity;
        $this->total_price = $total_price;
        $this->status = $status;
        $this->order_date = $order_date;
        $this->pagamento = $pagamento;
        
    }
}