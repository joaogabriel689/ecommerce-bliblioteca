<?php

class pagamentomodel{
    public const ORDER_STATUS_NEW = "new";
    public const ORDER_STATUS_PROCESSING = "processing";
    public const ORDER_STATUS_COMPLETED = "completed";
    public const ORDER_STATUS_FAILED = "failed";

    public $id;
    public $order_status;

    public function __construct(
        int $id,
        string $order_status = self::ORDER_STATUS_NEW
    ){
        $this->id = $id;
        $this->order_status = $order_status;
    }
}