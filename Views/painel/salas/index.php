<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Reso/Views/painel/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Reso/Views/painel/salas/salas/function.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Reso/Views/painel/salas/salas/modal.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Reso/Views/painel/salas/salas/script.php';

?>

<style>
.btn-group {
    display: flex;
    justify-content: space-around;
    width: 200px;
}

.botoes {
    font-size: 20px;
}
</style>

<body>
    <?php
        require_once $_SERVER['DOCUMENT_ROOT'] . '/Reso/Views/painel/nav.php';
    ?>
    <br><br><br><br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2 col-xs-2">
                <button class="btn btn-block" style="background-color:#03305c;">
                    <a class="text-white mx-auto">
                        FILTROS
                    </a>
                </button>
            </div>
            <div class="col-sm-8">
            </div>
            <div class="col-sm-2 col-xs-2">
                <button class="btn btn-block d-flex flex-row" style="background-color:#03305c;" data-toggle="modal"
                    data-target="#addsala">
                    <a class="text-white mx-auto">
                        <i class="navicon bi bi-plus-circle"></i>
                        SALAS
                    </a>
                </button>
            </div>
        </div>
        <div class="container-fluid">
            <div id="salas-container" class="row mt-3 overflow-auto"
                style="max-height: 850px; overflow-y: scroll; overflow-x: hidden; scrollbar-width: none; scroll-behavior: smooth;">
                <!-- Salas carregadas dinamicamente via AJAX -->
            </div>
        </div>

    </div>
    <?php 
        include_once $_SERVER['DOCUMENT_ROOT'] . '/Reso/footer.php';
    ?>
</body>

<script>
function carregarSalas() {
    $.ajax({
        url: '?route=/painelSalasAJax',
        method: 'GET',
        success: function(data) {
            $('#salas-container').html(data);
        },
        error: function() {
            console.error('Erro ao carregar as salas.');
        }
    });
}

// Atualiza as salas a cada 10 segundos
setInterval(carregarSalas, 5000);

// Carrega as sala na inicialização
$(document).ready(function() {
    carregarSalas();
});
</script>
<?php
if(!empty($_POST)){
    if($_POST['action'] == "Criar"){
        CriarSala(
           strtoupper($_POST['nome']),
            $_POST['desc'],
            $_SESSION['id'],
            $_SESSION['conexao'],
            "index.php"
        );
    }elseif($_POST['action'] == "Editar"){
        EditarSala(
            $_POST['cd'],
            strtoupper($_POST['nome']),
            $_POST['desc'],
            $_SESSION['id'],
            $_SESSION['conexao'],
            "index.php"
        );
    }elseif($_POST['action'] == "Deletar"){
        ExcluirSala(
            $_POST['cd'],
            $_SESSION['conexao'],
            "index.php"
            );
    }
}
?>