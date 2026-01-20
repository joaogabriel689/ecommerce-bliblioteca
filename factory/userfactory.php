<?php

require_once "../models/UserModel.php";

class UserFactory
{
    public static function fromPost(array $post): UserModel
    {
        return new UserModel(
            id: 0,
            name: $post['name'] ?? 'Usuário',
            email: $post['email'] ?? '',
            password: isset($post['password'])
                ? password_hash($post['password'], PASSWORD_DEFAULT)
                : '',
            dataNasc: $post['data_nasc'] ?? null,
            phone: $post['phone'] ?? null,
            compras: isset($post['compras']) ? (int)$post['compras'] : 0,
            group: $post['group'] ?? 'user',
            codigo: $post['codigo'] ?? null
        );
    }
}

