<?php

class UserModel
{
    public int $id;
    public string $name;
    public string $email;
    public string $password;
    public ?string $dataNasc;
    public ?string $phone;
    public int $compras;
    public string $group;
    public ?string $codigo;

    public function __construct(
        int $id = 0,
        string $name = "",
        string $email = "",
        string $password = "",
        ?string $dataNasc = null,
        ?string $phone = null,
        int $compras = 0,
        string $group = "user",
        ?string $codigo = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->dataNasc = $dataNasc;
        $this->phone = $phone;
        $this->compras = $compras;
        $this->group = $group;
        $this->codigo = $codigo;
    }
}
