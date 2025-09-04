<?php

class UsuarioController {
    public function listar() {
        echo "Listando usuários";
    }

    public function detalhar($id) {
        echo "Detalhando usuário de ID: $id";
    }

    public function criar() {
        echo "Usuário criado via POST";
    }
}
