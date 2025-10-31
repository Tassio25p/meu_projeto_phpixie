<?php

namespace App\Model;

use App\Db;
use PDO;

class ClienteModel
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Db::getConnection();
    }

    public function getAll()
    {
        $stmt = $this->pdo->query("SELECT * FROM cliente");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM cliente WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $nome = $data['nome'] ?? null;
        $email = $data['email'] ?? null;
        $telefone = $data['telefone'] ?? null;
        $senha = $data['senha'] ?? null;

        if (!$nome || !$email || !$telefone || !$senha) {
            throw new \Exception("Todos os campos são obrigatórios");
        }

        $stmt = $this->pdo->prepare("INSERT INTO cliente (nome, email, telefone, senha) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nome, $email, $telefone, $senha]);

        return $this->pdo->lastInsertId();
    }

    public function update($id, $data)
    {
        $stmt = $this->pdo->prepare("UPDATE cliente SET nome=?, email=?, telefone=?, senha=? WHERE id=?");
        $stmt->execute([$data['nome'], $data['email'], $data['telefone'], $data['senha'], $id]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM cliente WHERE id=?");
        $stmt->execute([$id]);
    }
}
