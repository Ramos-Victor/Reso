<?php
require_once '../header.php';
require_once './categoria/function.php';
require_once './categoria/modal.php';
require_once './categoria/script.php';
?>

<style>
.botoes {
    font-size: 20px;
}
</style>

<body>
    <?php include_once '../nav.php'; ?>
    <br><br><br><br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10">
            </div>
            <div class="col-sm-2">
                <button class="btn btn-block d-flex flex-row" style="background-color:#03305c;" data-toggle="modal"
                    data-target="#addcategoria">
                    <i class="navicon bi bi-plus-circle"></i>
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
            url: './categoria/listar_ajax.php',
            method: 'GET',
            success: function (data) {
                $('#categorias-container').html(data);
            },
            error: function () {
                console.error('Erro ao carregar as categorias.');
            }
        });
    }

    // Atualiza as categorias a cada 10 segundos
    setInterval(carregarCategorias, 5000);

    // Carrega as categorias na inicialização
    $(document).ready(function () {
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
            "index.php"
        );
    }elseif($_POST['action'] == "Editar"){
        EditarCategoria(
            $_POST['cd'],
           strtoupper($_POST['nome']),
            $_SESSION['conexao'],
            "index.php"
        );
    }elseif($_POST['action'] == "Deletar"){
        DeletarCategoria(
            $_POST['cd'],
            $_POST['conexao'],
            "index.php"
            );
    }
}
?>