<?php
require_once 'header.php';
require_once './equipamentos/function.php';
require_once './equipamentos/modal.php';
require_once './equipamentos/script.php';

?>

<style>

.botoes {
    font-size: 20px;
}

</style>

<body>
    <?php
        require_once 'nav.php';
    ?>
    <br><br><br>
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
                <h2></h2>
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
        foreach ($listar as $index => $l) {
    ?>
    <div class="col-md-4 col-sm-6 mb-4">
        <div class="card border-0" style="background-color: #0a4a8a; color: white; border-radius: 10px; background: linear-gradient(135deg, #0a4a8a, #03305c);">
            <div class="card-body">
                <h5 class="card-title"><?= $l['nm_equipamento'] ?></h5>
                <h6 class="card-subtitle mb-2"><?= $l['ds_equipamento'] ?></h6>
                <span class="badge bg-secondary"><?= $l['categoria_nm'] ?></span>
                <p class="mt-2"><strong>Localização:</strong> <?= $l['nm_sala'] ?></p>
                <p><strong>Por:</strong> <?= $l['nm_usuario'] ?></p>
                <p><strong>Registrado em:</strong> <?= $l['dt_equipamento'] ?></p>
                <span class="badge bg-primary">Status: <?= $l['st_equipamento'] ?></span>
            </div>
            <div class="card-footer bg-transparent text-center">
                <button class="btn btn-danger btn-sm deletar" data-toggle="modal" data-target="#deletar"
                    cd="<?= $l['cd_equipamento']; ?>"
                 nome="<?= $l['nm_equipamento']; ?>">
                    <i class="botoes bi bi-trash3-fill"></i> Deletar
                </button>
                <button class="btn btn-primary btn-sm editar" data-toggle="modal" data-target="#editar"
                    cd="<?= $l['cd_equipamento']; ?>" 
                    nome="<?= $l['nm_equipamento']; ?>"
                    desc="<?= $l['ds_equipamento']; ?>" 
                    sala="<?= $l['id_sala']; ?>"
                    categoria="<?= $l['id_categoria']; ?>" 
                    data="<?= $l['dt_equipamento']; ?>"
                    status="<?= $l['st_equipamento']; ?>">
                    <i class="botoes bi bi-pencil-fill"></i> Editar
                </button>
            </div>
        </div>
    </div>
    <?php
        }
    }
    ?>
</div>
</body>
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