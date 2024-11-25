<?php
define('ROUTING_ACCESS', true);
require_once 'routes.php';
require_once 'conect.php';

$route = $_GET['route'] ?? '/';

if (isset($routes[$route])) {
    call_user_func($routes[$route]);
} else {
    http_response_code(404);
    echo "Página não encontrada.";
}