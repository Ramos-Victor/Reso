<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/Reso/Views/comum/header.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/Reso/Views/comum/chamados/function.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/Reso/Views/comum/chamados/modal.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/Reso/Views/comum/chamados/script.php';

?>

<style>
.botoes {
    font-size: 20px;
}
</style>

<body>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/Reso/Views/comum/nav.php'; ?>
    <br><br><br><br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2 col-xs-2">
                <form method="GET" action="" id="filter-form">
                    <button class="btn btn-block"
                        style="background-color:#03305c; position: sticky; top: 0; z-index: 100;" type="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="text-white mx-auto">FILTROS</span>
                    </button>
                    <div class="dropdown-menu">
                        <button class="dropdown-item filter-btn" type="button" data-status="Aberto">Aberto</button>
                        <button class="dropdown-item filter-btn" type="button"
                            data-status="Andamento">Andamento</button>
                        <button class="dropdown-item filter-btn" type="button"
                            data-status="Concluido">Concluído</button>
                        <button class="dropdown-item filter-btn" type="button" data-status="">Limpar</button>
                    </div>
                </form>
            </div>
            <div class="col-sm-8 text-left mt-2">
                <h5 id="filter-text"></h5>
            </div>
            <div class="col-sm-2 col-xs-2">
                <button class="btn btn-block d-flex flex-row"
                    style="background-color:#03305c; position: sticky; top: 0; z-index: 100;" data-toggle="modal"
                    data-target="#abrirChamado">
                    <i class="navicon bi bi-plus-circle"></i>
                    <span class="text-white mx-auto">CHAMADO</span>
                </button>
            </div>
        </div>
        <div class="container-fluid">
            <div id="chamados-container" class="row overflow-auto"
                style="overflow-y: scroll; overflow-x: hidden; scrollbar-width: none; scroll-behavior: smooth;">
            </div>
        </div>
    </div>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/Reso/footer.php'; ?>
</body>

<script>
let statusFilter = '';

function carregarChamados() {
    $.ajax({
        url: './chamados/listar_ajax.php',
        method: 'GET',
        data: {
            status: statusFilter
        },
        success: function(data) {
            $('#chamados-container').html(data);
        },
        error: function() {
            console.error('Erro ao carregar os chamados.');
        }
    });
}

setInterval(carregarChamados, 5000);

$(document).ready(function() {
    carregarChamados();

    $('.filter-btn').on('click', function() {
        statusFilter = $(this).data('status');
        $('#filter-text').html(statusFilter ? `Filtro selecionado: ${statusFilter}` : '');
        carregarChamados();
    });
});
</script>
<?php
if (!empty($_POST)) {
    if ($_POST['action'] == "Abrir") {
        $id_equipamento = !empty($_POST['equipamento']) ? intval($_POST['equipamento']) : null;
        AbrirChamado(
            strtoupper($_POST['titulo']), 
            $_POST['descricao'], 
            $id_equipamento,
            $_SESSION['id'], 
            $_SESSION['conexao'], 
            "index.php");
    } elseif($_POST['action'] == "EmAndamento") {
        ColocarEmAndamento(
            $_POST['cd'],
            $_SESSION['id'], 
            $_SESSION['conexao'], 
            "index.php"
        );
    } elseif ($_POST['action'] == "DeletarChamado") {
        DeletarChamado(
            $_POST['cd'], 
            $_SESSION['conexao'], 
            "index.php");
    }elseif ($_POST['action'] == "ConcluirChamado") {
        ConcluirChamado(
            $_POST['cd'],
            $_POST['recado'],
            $_SESSION['id'],
            $_SESSION['conexao'],
            "index.php"
        );
    }
}
?>