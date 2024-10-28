<?php
require_once 'header.php';
require_once './equipamentos/function.php';
require_once './equipamentos/modal.php';
require_once './equipamentos/script.php';

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

.card-footer {
    border: none;
    background-color: rgba(0, 0, 0, 0);
}
</style>

<body>
    <?php
        require_once 'nav.php';
    ?>
    <div id="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2 col-xs-2">
                    <button class="btn btn-block" style="background-color:#03305c;">
                        <a class="text-white mx-auto">
                            FILTROS
                        </a>
                    </button>
                </div>
                <div class="col-sm-8 text-center text-white">
                    <h2><b>EQUIPAMENTOS</b></h2>
                </div>
                <div class="col-sm-2 col-xs-2">
                    <button class="btn btn-block d-flex flex-row" style="background-color:#03305c;" data-toggle="modal"
                        data-target="#addequipamento">
                        <a class="text-white mx-auto">
                            <i class="navicon bi bi-plus-circle"></i>
                            EQUIPAMENTOS
                        </a>
                    </button>
                </div>
            </div>
            <div class="row mt-3">
        <?php
        $listar = ListarEquipamentos();

        if ($listar) {
            foreach ($listar as $index =>$l) {
               
        ?>
                <div class="col-sm-2 text-white">
    <div class="card mt-3"
        style="width: 14rem; height:27rem; <?php if ($index % 2 == 0) { echo "background-color:#03305c;"; } else { echo "background-color:#0a4a8a;"; } ?> border-radius:10px;">
        <div class="card-body">
            <h5 class="card-title"><?= $l['nm_equipamento']?></h5>
            <h6 class="card-subtitle text-white mt-2"><?=$l['ds_equipamento']?></h6>
            <div class="mt-2">
                <span class="badge bg-secondary mt-3"><?=$l['categoria_nm']?></span>
            </div>
            <div class="mt-2">
                <p><strong>Localização:</strong> <?=$l['nm_sala']?></p>
                <p><strong>Por:</strong> <?=$l['nm_usuario']?></p>
                <p><strong>Registrado em:</strong> <?=$l['dt_equipamento']?></p>
            </div>
            <div style="margin-bottom:0">
                <span class="badge bg-primary">Status: <?=$l['st_equipamento']?></span><br>
            </div>
        </div>
        <div class="card-footer mx-auto btn-group">
            <button class="btn btn-danger btn-sm deletar" data-toggle="modal" data-target="#deletar"
                title="Deletar" 
                cd="<?= $l['cd_equipamento']; ?>"
                nome="<?= $l['nm_equipamento']; ?>">
                <i class="botoes bi bi-trash3-fill"></i>
            </button>
            <button class="btn btn-primary btn-sm editar" data-toggle="modal" data-target="#editar"
                title="Editar" cd="<?= $l['cd_equipamento']; ?>"
                nome="<?= $l['nm_equipamento']; ?>" 
                desc="<?= $l['ds_equipamento']; ?>" 
                sala="<?= $l['id_sala']; ?>" 
                categoria="<?= $l['id_categoria']; ?>" 
                data="<?= $l['dt_equipamento']; ?>"
                status="<?= $l['st_equipamento']; ?>">
                <i class="botoes bi bi-pencil-fill"></i>
            </button>
        </div>
    </div>
</div>
        <?php
            }
        }
        ?>
    </div>

        </div>
    </div>
</body>
<?php
if (!empty($_POST)) {
    if ($_POST['action'] == "Criar") {
        CriarEquipamento(
            $_POST['nome'], 
            $_POST['desc'], 
            $_POST['sala'], 
            $_POST['categoria'], 
            $_SESSION['id'], 
            $_SESSION['conexao'], 
            "equipamento.php");
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
            "equipamento.php");
    } elseif ($_POST['action'] == "Deletar") {
        ExcluirEquipamento(
            $_POST['cd'], 
            $_SESSION['conexao'], 
            "equipamento.php");
    }
}
?>