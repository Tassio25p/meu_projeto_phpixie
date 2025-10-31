<?php

namespace App\Controller;

use App\Model\ClienteModel;

class Cliente extends \PHPixie\Controller
{
    private ClienteModel $model;

    public function before()
    {
        $this->model = new ClienteModel();
    }

    public function action_index()
    {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'ok', 'mensagem' => 'Endpoint Cliente funcionando!']);
        exit;
    }

    public function action_getAll()
    {
        header('Content-Type: application/json');
        echo json_encode($this->model->getAll());
        exit;
    }

    public function action_getById($id)
    {
        header('Content-Type: application/json');
        echo json_encode($this->model->getById($id));
        exit;
    }


    public function action_create()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $this->model->create($data);
        header('Content-Type: application/json');
        echo json_encode(['status' => 'Cliente cadastrado com sucesso!']);
        exit;
    }

    public function action_update($id)
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $this->model->update($id, $data);
        header('Content-Type: application/json');
        echo json_encode(['status' => 'Cliente atualizado com sucesso!']);
        exit;
    }

    public function action_delete($id)
    {
        $this->model->delete($id);
        header('Content-Type: application/json');
        echo json_encode(['status' => 'Cliente excluído com sucesso!']);
        exit;
    }
}
