<?php
// index.php
require __DIR__ . '/routes.php';

// Captura a URI atual
$basePath = '/route-test'; // <<< coloque o nome da pasta onde está o projeto
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = substr($uri, strlen($basePath)); // remove o prefixo
$uri = trim($uri, '/');

// Captura o método (GET, POST, etc.)
$method = $_SERVER['REQUEST_METHOD'];

// Chama a função de roteamento
rota($uri, $method);
