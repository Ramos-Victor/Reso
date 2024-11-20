<?php
define('ROUTING_ACCESS', true);
require_once 'routes.php';
require_once 'conect.php';

// Obtemos a rota atual da URL
$route = $_GET['route'] ?? '/';

// Chamamos a função responsável pela rota ou exibimos um 404
if (isset($routes[$route])) {
    call_user_func($routes[$route]);
} else {
    http_response_code(404);
    echo "Página não encontrada.";
}