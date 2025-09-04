<?php

function rota($uri, $method) {
    $rotas = [
        'GET' => [
            '' => function() { echo "Página inicial"; },
            'usuarios' => function() { 
                require __DIR__ . '/controllers/UsuarioController.php';
                (new UsuarioController)->listar();
            },
            'usuarios/(\d+)' => function($id) {
                require __DIR__ . '/controllers/UsuarioController.php';
                (new UsuarioController)->detalhar($id);
            }
        ],
        'POST' => [
            'usuarios' => function() {
                require __DIR__ . '/controllers/UsuarioController.php';
                (new UsuarioController)->criar();
            }
        ]
    ];

    // Verifica se existe rota para o método
    if (!isset($rotas[$method])) {
        http_response_code(405);
        echo "Método não permitido";
        return;
    }

    // Percorre rotas do método atual
    foreach ($rotas[$method] as $pattern => $callback) {
        $pattern = '#^' . $pattern . '$#';
        if (preg_match($pattern, $uri, $params)) {
            array_shift($params); // remove a string completa
            return call_user_func_array($callback, $params);
        }
    }

    http_response_code(404);
    echo "Rota não encontrada";
}
