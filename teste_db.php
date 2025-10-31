<?php
require __DIR__.'/vendor/autoload.php';
use App\Model\ClienteModel;

try {
    $cliente = new ClienteModel();
    $data = [
        'nome' => 'João',
        'email' => 'joao@email.com',
        'telefone' => '11999999999',
        'senha' => md5('123456')
    ];

    $id = $cliente->create($data);
    echo "Cliente criado com ID: $id";
} catch (\Exception $e) {
    echo "Erro: " . $e->getMessage();
}
