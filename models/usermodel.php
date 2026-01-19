<?php
class usermodel{
    public $id;
    public $name;
    public $data_nasc;
    public $phone;
    public $compras;
    public $group;
    public $codigo;
    public $password;
    public $endereco;

    public $info_bancaria;

    public function __construct(
        int $id,
        string $name ="",
        string $data_nasc= "",
        string $phone= "",
        int $compras="",
        string $group="",
        string $codigo= "",
        string $password= "",
        array $endereco= "",
        array $info_bancaria= ""
    ){

        $this->id = $id;
        $this->name = $name;
        $this->data_nasc = $data_nasc;
        $this->phone = $phone;
        $this->compras = $compras;
        $this->group = $group;
        $this->codigo = $codigo;
        $this->password = $password;
        $this->endereco = $endereco;
        $this->info_bancaria = $info_bancaria;
    }
}
    