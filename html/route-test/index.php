<?php
require __DIR__ . '/routes.php';


$basePath = '/route-test';
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = substr($uri, strlen($basePath));
$uri = trim($uri, '/');

$method = $_SERVER['REQUEST_METHOD'];

rota($uri, $method);
