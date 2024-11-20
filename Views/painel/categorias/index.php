<?php
require_once  $_SERVER['DOCUMENT_ROOT'] . '/Reso/Views/painel/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Reso/Views/painel/categorias/categoria/function.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Reso/Views/painel/categorias/categoria/modal.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Reso/Views/painel/categorias/categoria/script.php';
?>

<style>
.botoes {
    font-size: 20px;
}

.table-responsive {
    height: 83vh;
    overflow-y: auto;
    position: relative;
    overflow-y: scroll;
    overflow-x: hidden;
    scrollbar-width: none;
    scroll-behavior: smooth;
}

.table thead {
    position: sticky;
    top: 0;
    z-index: 2;
    background-color: #007bff;
    color: white;
    border-top: 1px solid #dee2e6;
}

tbody {
    background-color: #f8f9fa;
}

tbody tr {
    scroll-margin-top: 50px;
}
</style>

<body>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/Reso/Views/painel/nav.php'; ?>
    <br><br><br><br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-8">
                <h4 class="text-muted text-center mt-2">LISTA DE USUARIOS</h4>
            </div>
            <div class="col-sm-2">
                <button class="btn btn-block d-flex flex-row" style="background-color:#03305c;" data-toggle="modal"
                    data-target="#addcategoria">
                    <span class="text-white mx-auto">CATEGORIA</span>
                </button>
            </div>
        </div>
        <div class="container-fluid">
            <div id="categorias-container" class="row mt-3 overflow-auto"
                style="overflow-y: scroll; overflow-x: hidden; scrollbar-width: none; scroll-behavior: smooth;">
                <!-- Categorias carregadas dinamicamente via AJAX -->
            </div>
        </div>
    </div>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/Reso/footer.php'; ?>
</body>

<script>
function carregarCategorias() {
    $.ajax({
        url: '?route=/painelCategoriasAjax',
        method: 'GET',
        success: function(data) {
            $('#categorias-container').html(data);
        },
        error: function() {
            console.error('Erro ao carregar as categorias.');
        }
    });
}

// Atualiza as categorias a cada 10 segundos
setInterval(carregarCategorias, 5000);

// Carrega as categorias na inicialização
$(document).ready(function() {
    carregarCategorias();
});
</script>
<?php
if(!empty($_POST)){
    if($_POST['action'] == "Criar"){
        CriarCategoria(
            strtoupper($_POST['nome']),
            $_SESSION['id'],
            $_SESSION['conexao'],
            "?route=/painelCategorias"
        );
    }elseif($_POST['action'] == "Editar"){
        EditarCategoria(
            $_POST['cd'],
           strtoupper($_POST['nome']),
            $_SESSION['conexao'],
            "?route=/painelCategorias"
        );
    }elseif($_POST['action'] == "Deletar"){
        DeletarCategoria(
            $_POST['cd'],
            $_POST['conexao'],
            "?route=/painelCategorias"
            );
    }
}
?>