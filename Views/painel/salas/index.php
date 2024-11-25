<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Reso/Views/painel/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Reso/Views/painel/salas/salas/function.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Reso/Views/painel/salas/salas/modal.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Reso/Views/painel/salas/salas/script.php';

?>

<style>
.botoes {
    font-size: 1.5rem;
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
    <?php
        require_once $_SERVER['DOCUMENT_ROOT'] . '/Reso/Views/painel/nav.php';
    ?>
    <br><br><br><br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2 col-xs-2">
            </div>
            <div class="col-sm-8">
                <h4 class="text-muted text-center mt-2">LISTA DE SALAS</h4>
            </div>
            <div class="col-sm-2 col-xs-2">
                <button class="btn btn-block d-flex flex-row" style="background-color:#03305c;" data-toggle="modal"
                    data-target="#addsala">
                    <a class="text-white mx-auto">
                        SALAS
                    </a>
                </button>
            </div>
        </div>
        <div class="container-fluid">
            <div id="salas-container" class="row mt-3 overflow-auto"
                style="max-height: 850px; overflow-y: scroll; overflow-x: hidden; scrollbar-width: none; scroll-behavior: smooth;">
          
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


setInterval(carregarSalas, 5000);


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
            $_SESSION['unidade'],
            "?route=/painelSalas"
        );
    }elseif($_POST['action'] == "Editar"){
        EditarSala(
            $_POST['cd'],
            strtoupper($_POST['nome']),
            $_POST['desc'],
            $_SESSION['id'],
            $_SESSION['unidade'],
            "?route=/painelSalas"
        );
    }elseif($_POST['action'] == "Deletar"){
        ExcluirSala(
            $_POST['cd'],
            $_SESSION['unidade'],
            "?route=/painelSalas"
            );
    }
}
?>