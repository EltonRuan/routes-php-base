<?php

require __DIR__ . '/controllers/UsuarioController.php';

function rota($uri, $method) {
    $rotas = [
        'GET' => [
            '' => function() { echo "Rota Base"; },
            'usuarios' => function() { 
                (new UsuarioController)->listar();
            },
            'usuarios/(\d+)' => function($id) {
                (new UsuarioController)->detalhar($id);
            }
        ],
        'POST' => [
            'usuarios' => function() {
                (new UsuarioController)->criar();
            }
        ],
        'PUT' => [
            'usuarios/(\d+)' => function($id) {
                (new UsuarioController)->atualizar($id);
            }
        ],
        'DELETE' => [
            'usuarios/(\d+)' => function($id) {
                (new UsuarioController)->deletar($id);
            }
        ]
    ];

    if (!isset($rotas[$method])) {
        http_response_code(405);
        echo "Método não permitido";
        return;
    }

    foreach ($rotas[$method] as $pattern => $callback) {
        $pattern = '#^' . $pattern . '$#';
        if (preg_match($pattern, $uri, $params)) {
            array_shift($params);
            return call_user_func_array($callback, $params);
        }
    }

    http_response_code(404);
    echo "Rota não encontrada";
}
