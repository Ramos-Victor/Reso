<?php
include_once '../header.php';
include_once './equipamentos/modal.php';
include_once './equipamentos/function.php';
include_once './equipamentos/script.php';
?>

<style>
.botoes {
    font-size: 20px;
}

.feedback-text {
    word-wrap: break-word;
    max-width: 200px;
    overflow: auto;
}
</style>

<body>
    <?php include_once '../nav.php'; ?>
    <br><br><br><br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2 col-xs-2">
                <div></div>
            </div>
            <div class="col-sm-8 text-left mt-2">
                <h5 id="filter-text"></h5>
            </div>
            <div class="col-sm-2 col-xs-2">
                <button class="btn btn-block d-flex flex-row"
                    style="background-color:#03305c; position: sticky; top: 0; z-index: 100;" data-toggle="modal"
                    data-target="#abrirEquipamento">
                    <i class="navicon bi bi-plus-circle"></i>
                    <span class="text-white mx-auto">EQUIPAMENTO</span>
                </button>
            </div>
        </div>

        <div id="equipamentos-container" class="row mt-3 overflow-auto"
            style="overflow-y: scroll; overflow-x: hidden; scrollbar-width: none; scroll-behavior: smooth;">
            <!-- Equipamentos carregadas dinamicamente via AJAX -->
        </div>
    </div>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/Reso/footer.php'; ?>
</body>
<script>
let categoriaFilter = '';
let salaFilter = '';

function carregarEquipamentos() {
    $.ajax({
        url: './equipamentos/listar_ajax.php',
        method: 'GET',
        data: {
            categoria: categoriaFilter,
            sala: salaFilter 
        },
        success: function(data) {
            $('#equipamentos-container').html(data);
        },
        error: function() {
            console.error('Erro ao carregar os equipamentos.');
        }
    });
}

setInterval(carregarEquipamentos, 5000);

$(document).ready(function() {
    carregarEquipamentos();
});
</script>

<?php
if (!empty($_POST)) {
    if ($_POST['action'] == "Criar") {
        $id_categoria = !empty($_POST['categoria']) ? intval($_POST['categoria']) : null;
        CriarEquipamento(
            strtoupper($_POST['nome']), 
            $_POST['desc'], 
            $id_categoria,
            $_SESSION['id'], 
            $_SESSION['conexao'], 
            "index.php");
    } elseif ($_POST['action'] == "Editar") {
        EditarEquipamento(
            $_POST['cd'], 
            $_POST['nome'], 
            $_POST['desc'], 
            $_POST['status'], 
            $_POST['sala'], 
            $_POST['categoria'], 
            $_SESSION['id'], 
            $_SESSION['conexao'], 
            "index.php");
    } elseif ($_POST['action'] == "Deletar") {
        ExcluirEquipamento(
            $_POST['cd'], 
            "index.php");
    }
}
?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dropdownButton = document.getElementById('filterDropdownButton');
    const filterDropdown = document.getElementById('filterDropdown');

    filterDropdown.addEventListener('click', function(event) {
        event.stopPropagation();
    });

    document.getElementById('filterForm').addEventListener('submit', function(event) {
        $(filterDropdown).removeClass('show');
        $('.dropdown-menu').removeClass('show');
    });
});

document.getElementById('clearFilters').addEventListener('click', function() {
    document.getElementById('filterForm').reset();
    window.location.href = window.location.pathname;
});
</script>