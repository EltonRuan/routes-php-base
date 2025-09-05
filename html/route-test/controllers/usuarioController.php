<?php
require __DIR__ . '/../models/UsuarioModel.php';

class UsuarioController {
    private $model;

    public function __construct() {
        $this->model = new UsuarioModel();
    }

    public function listar() {
        $usuarios = $this->model->get();
        echo json_encode($usuarios);
    }

    public function detalhar($id) {
        $usuario = $this->model->get($id);
        if ($usuario) {
            echo json_encode($usuario);
        } else {
            http_response_code(404);
            echo json_encode(['erro' => 'Usuário não encontrado']);
        }
    }

    public function criar() {
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $this->model->create($data['nome'], $data['email']);
        echo json_encode(['id' => $id, 'status' => 'Criado com sucesso']);
    }

    public function atualizar($id) {
        $data = json_decode(file_get_contents('php://input'), true);
        $sucesso = $this->model->update($id, $data['nome'], $data['email']);
        echo json_encode(['status' => $sucesso ? 'Atualizado com sucesso' : 'Erro ao atualizar']);
    }

    public function deletar($id) {
        $sucesso = $this->model->delete($id);
        echo json_encode(['status' => $sucesso ? 'Deletado com sucesso' : 'Erro ao deletar']);
    }
}
