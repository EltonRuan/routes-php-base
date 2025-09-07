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
            echo json_encode(['erro' => 'Usuário(s) não encontrado(s).']);
        }
    }

    public function criar() {
        $data = json_decode(file_get_contents('php://input'), true);

        if (empty($data['nome']) || empty($data['email'])) {
            echo json_encode(['status' => 'Nome e e-mail são obrigatórios']);
            return;
        }

        $id = $this->model->create($data['nome'], $data['email']);

        if ($id) {
            echo json_encode([
                'id'     => $id,
                'nome'   => $data['nome'],
                'email'  => $data['email'],
                'status' => 'Criado com sucesso'
            ]);
        } else {
            echo json_encode(['status' => 'Erro ao criar usuário']);
        }
    }


    public function atualizar($id) {
        $data = json_decode(file_get_contents('php://input'), true);
        $sucesso = $this->model->update($id, $data['nome'], $data['email']);
        if($sucesso){
            echo json_encode(['status' => 'Atualizado com sucesso']);
        }
        else{
            echo json_encode(['status' => 'Erro ao atualizar. Usuário não existe']);
        }
    }

    public function deletar($id) {
        $sucesso = $this->model->delete($id);

        if ($sucesso) {
            echo json_encode(['status' => 'Deletado com sucesso']);
        } else {
            echo json_encode(['status' => 'Usuário não existe para exclusão']);
        }
    }

}
