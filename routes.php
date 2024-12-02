<?php
$routes = [
    '/' => function () {
        require __DIR__ . '/start/ladingpage.php';
    },
    '/faq' => function () {
        require __DIR__ . '/Views/faq/index.php';
    },
    '/faqCadastrar' => function () {
        require __DIR__ . '/Views/faq/cadastrar_faq.php';
    },
    '/atencao' => function () {
        require __DIR__ . '/email/atencao.php';
    },
    '/login' => function () {
        require __DIR__ . '/start/login.php';
    },
    '/registro' => function () {
        require __DIR__ . '/start/registro.php';
    },
    '/verificado' => function () {
        require __DIR__ . '/email/verificado.php';
    },
    '/redefinirsenha' => function () {
        require __DIR__ . '/start/redefinir_senha.php';
    },
    '/esquecisenha' => function () {
        require __DIR__ . '/email/esquecisenha.php';
    },
    '/logout' => function () {
        require __DIR__ . '/logout.php';
    },
    '/config' => function () {
        require __DIR__ . '/Views/perfil/index.php';
    },
    '/unidades' => function () {
        $_SESSION['PaginaAnterior']= "?route=/unidades";
        require __DIR__ . '/Views/unidades/index.php';
    },
    '/painel' => function () {
        $_SESSION['PaginaAnterior']= "?route=/painel";
        require __DIR__ . '/Views/painel/index.php';
    },
    '/painelAjax' => function () {  
        require __DIR__ . '/Views/painel/listar_ajax.php';
    },
    '/dadosGraficoFechamento' => function () {  
        require __DIR__ . '/Views/painel/graficos/graficosFechamento.php';
    },
    '/dadosGraficoAbertura' => function () {  
        require __DIR__ . '/Views/painel/graficos/graficosAbertura.php';
    },
    '/dadosGraficoCategoria' => function () {  
        require __DIR__ . '/Views/painel/graficos/graficosChamadosCategoria.php';
    },
    '/dadosGraficoMediaAVA' => function () {  
        require __DIR__ . '/Views/painel/graficos/graficosMediaAvaliacao.php';
    },
    '/dadosGraficoSala' => function () {  
        require __DIR__ . '/Views/painel/graficos/graficosChamadosSala.php';
    },
    '/painelUsuarios' => function () {
        $_SESSION['PaginaAnterior']= "?route=/painelUsuarios";
        require __DIR__ . '/Views/painel/usuarios/index.php';
    },
    '/painelChamados' => function () {
        $_SESSION['PaginaAnterior']= "?route=/painelChamados";
        require __DIR__ . '/Views/painel/chamados/index.php';
    },
    '/painelChamadosAjax' => function () {
        require __DIR__ . '/Views/painel/chamados/chamados/listar_ajax.php';
    },
    '/painelEquipamentos' => function () {
        $_SESSION['PaginaAnterior']= "?route=/painelEquipamentos";
        require __DIR__ . '/Views/painel/equipamentos/index.php';
    },
    '/painelEquipamentosAjax' => function () {
        require __DIR__ . '/Views/painel/equipamentos/equipamentos/listar_ajax.php';
    },
    '/painelSalas' => function () {
        $_SESSION['PaginaAnterior']= "?route=/painelSalas";
        require __DIR__ . '/Views/painel/salas/index.php';
    },
    '/painelSalasAJax' => function () {
        require __DIR__ . '/Views/painel/salas/salas/listar_ajax.php';
    },
    '/painelCategorias' => function () {
        $_SESSION['PaginaAnterior']= "?route=/painelCategorias";
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
        $_SESSION['PaginaAnterior']= "?route=/comum";
        require __DIR__ . '/Views/comum/chamados/index.php';
    },
    '/comumChamadosAjax' => function () {
        require __DIR__ . '/Views/comum/chamados/chamados/listar_ajax.php';
    },
];
