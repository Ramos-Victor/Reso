<?php
require_once '../header.php';
require_once './salas/function.php';
require_once './salas/modal.php';
require_once './salas/script.php';

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
        require_once '../nav.php';
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
        <div class="row mt-3 overflow-auto"
            style="max-height: 850px; overflow-y: scroll; overflow-x: hidden; scrollbar-width: none; scroll-behavior: smooth;">
            <?php
    $listar = ListarSalas();
    if ($listar) {
        foreach ($listar as $index => $l) {
    ?>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card border-0 shadow-sm"
                    style="background-color: <?= $index % 2 == 0 ? '#03305c' : '#0a4a8a'; ?>; border-radius: 10px;">
                    <div class="card-body text-center text-white">
                        <h5 class="card-title"><?= $l['nm_sala'] ?></h5>
                        <h6 class="card-subtitle">Criado: <span class="badge bg-secondary"><?= $l['dt_sala'] ?></span>
                        </h6>
                        <h6 class="card-subtitle mt-1">Descrição:
                            <?= strlen($l['ds_sala']) > 30 ? substr($l['ds_sala'], 0, 30) . '...' : $l['ds_sala'] ?>
                        </h6>
                        <h7 class="card-subtitle mt-1">Por: <?= $l['nm_usuario'] ?></h7>
                    </div>
                    <div class="card-footer text-center">
                        <button class="btn btn-success btn-sm ver" data-toggle="modal" data-target="#ver" title="Ver"
                            cd="<?= $l['cd_sala']; ?>" nome="<?= $l['nm_sala']; ?>" desc="<?= $l['ds_sala']; ?>"
                            criado="<?= $l['nm_usuario']; ?>" data="<?= $l['dt_sala']; ?>">
                            <i class="botoes bi bi-eye-fill"></i> Ver
                        </button>
                        <?php if ($l['nm_sala'] != "ESTOQUE") { ?>
                        <button class="btn btn-danger btn-sm deletar" data-toggle="modal" data-target="#deletar"
                            title="Deletar" cd="<?= $l['cd_sala']; ?>" nome="<?= $l['nm_sala']; ?>"
                            desc="<?= $l['ds_sala']; ?>" criado="<?= $l['id_usuario']; ?>" data="<?= $l['dt_sala']; ?>">
                            <i class="botoes bi bi-trash3-fill"></i> Deletar
                        </button>
                        <?php } 
                        if ($l['nm_sala'] != "ESTOQUE") { ?>
                        <button class="btn btn-primary btn-sm editar" data-toggle="modal" data-target="#editar"
                            title="Editar" cd="<?= $l['cd_sala']; ?>" nome="<?= $l['nm_sala']; ?>"
                            desc="<?= $l['ds_sala']; ?>" criado="<?= $l['id_usuario']; ?>" data="<?= $l['dt_sala']; ?>">
                            <i class="botoes bi bi-pencil-fill"></i> Editar
                        </button>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    ?>
        </div>

    </div>
</body>
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