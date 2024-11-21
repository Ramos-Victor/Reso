<?php
if (!defined('ROUTING_ACCESS')) {
    http_response_code(403);
    die('<h1 style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">Acesso direto não permitido</h1>');
}

$routes = [
    '/' => function () {
        require __DIR__ . '/ladingpage.php';
    },
    '/login' => function () {
        require __DIR__ . '/login.php';
    },
    '/registro' => function () {
        require __DIR__ . '/registro.php';
    },
    '/logout' => function () {
        require __DIR__ . '/logout.php';
    },
    '/unidades' => function () {
        require __DIR__ . '/Views/unidades/index.php';
    },
    '/painel' => function () {
        require __DIR__ . '/Views/painel/index.php';
    },
    '/painelAjax' => function () {
        require __DIR__ . '/Views/painel/listar_Ajax.php';
    },
    '/painelUsuarios' => function () {
        require __DIR__ . '/Views/painel/usuarios/index.php';
    },
    '/painelChamados' => function () {
        require __DIR__ . '/Views/painel/chamados/index.php';
    },
    '/painelChamadosAjax' => function () {
        require __DIR__ . '/Views/painel/chamados/chamados/listar_ajax.php';
    },
    '/painelEquipamentos' => function () {
        require __DIR__ . '/Views/painel/equipamentos/index.php';
    },
    '/painelEquipamentosAjax' => function () {
        require __DIR__ . '/Views/painel/equipamentos/equipamentos/listar_ajax.php';
    },
    '/painelSalas' => function () {
        require __DIR__ . '/Views/painel/salas/index.php';
    },
    '/painelSalasAJax' => function () {
        require __DIR__ . '/Views/painel/salas/salas/listar_ajax.php';
    },
    '/painelCategorias' => function () {
        require __DIR__ . '/Views/painel/categorias/index.php';
    },
    '/painelCategoriasAjax' => function () {
        require __DIR__ . '/Views/painel/categorias/categoria/listar_ajax.php';
    },
    '/painelChatChamado' => function () {
        require __DIR__ . '/Views/painel/chamados/chat/index.php';
    },
    '/painelChatEnviar' => function () {
        require __DIR__ . '/Views/painel/chamados/chat/enviar_mensagem.php';
    },
    '/painelChatBuscar' => function () {
        require __DIR__ . '/Views/painel/chamados/chat/buscar_mensagem.php';
    },
    '/comum' => function () {
        require __DIR__ . '/Views/comum/chamados/index.php';
    },
];
