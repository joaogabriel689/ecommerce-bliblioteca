<?php

class payinforepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }
    public function get($user_id)
    {
        $sql = "SELECT * FROM dados_banc WHERE id_cliente = :user_id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function update($user_id, $data)
    {
        $sql = 'UPDATE dados_banc set';
        $fields = [];
        foreach ($data as $key => $value) {
            $fields[] = "$key = :$key";
        }
        $sql .= implode(', ', $fields);
        $sql .= ' WHERE id_usuario = :user_id';
        $stmt = $this->connection->prepare($sql);
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        return $stmt->execute();
    }

    public function delete($user_id, $cartao = null){
        if ($cartao === null){
            $sql =  "DELETE * FROM dados_banc WHERE id_cliente = :user_id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":user_id", $user_id);
            $stmt->execute();
            return $stmt->rowCount();
        } else {
            $sql =  "DELETE * FROM dados_banc WHERE id_cliente = :user_id AND cartao = :cartao";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":user_id", $user_id);
            $stmt->bindValue(":cartao", $cartao);
            $stmt->execute();
            return $stmt->rowCount();
        }

    }
    public function create($user_id, $data)
    {
        $sql = 'INSERT INTO dados_banc (id_usuario, ' . implode(', ', array_keys($data)) . ') VALUES (:user_id, ' . implode(', ', array_map(fn($key) => ":$key", array_keys($data))) . ')';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':user_id', $user_id);
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        return $stmt->execute();
    }
}
