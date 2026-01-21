<?php

require_once "../models/UserModel.php";

class UserFactory
{
    public static function fromPost(array $post): UserModel
    {
        return new UserModel(
            name: $post['name'],
            email: $post['email'],
            password: $post['password'],
            dataNasc: $post['data_nasc'] ?? null,
            phone: $post['phone'] ?? null
        );
    }
}

