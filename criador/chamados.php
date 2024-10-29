<?php
require_once 'header.php';
require_once './chamados/function.php';
require_once './chamados/modal.php';
require_once './chamados/script.php';

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
                    <h2><b>CHAMADOS</b></h2>
                </div>
                <div class="col-sm-2 col-xs-2">
                    <button class="btn btn-block d-flex flex-row" style="background-color:#03305c;" data-toggle="modal"
                        data-target="#abrirChamado">
                        <a class="text-white mx-auto">
                            <i class="navicon bi bi-plus-circle"></i>
                            CHAMADO
                        </a>
                    </button>
                </div>
            </div>
            <div class="row mt-3">
                <?php
        $listar = ListarChamados();

        if ($listar) {
            foreach ($listar as $index =>$l) {
               
        ?>
                <div class="col-sm-2 text-white">
                    <div class="card mt-3"
                        style="width: 16rem; height:30rem; <?php if ($index % 2 == 0) { echo "background-color:#03305c;"; } else { echo "background-color:#0a4a8a;"; } ?> border-radius:10px;">
                        <div class="card-body text-white">
                            <h5 class="card-title"><?= $l['nm_chamado'] ?></h5>
                            <h6 class="card-subtitle text-light mt-2"><?= $l['ds_chamado'] ?></h6>

                            <div class="mt-2">
                                <p><strong>Abertura em:</strong> <?= $l['dt_abertura'] ?></p>
                                <?php if ($l['st_chamado'] == 'Concluido') { ?>
                                <p><strong>Fechamento:</strong> <?= $l['dt_fechamento'] ?></p>
                                <?php } elseif ($l['st_chamado'] == 'Andamento') { ?>
                                <p><strong>Início Andamento:</strong> <?= $l['dt_fechamento'] ?></p>
                                <?php } ?>

                                <?php if ($l['nm_equipamento']) { ?>
                                <p><strong>Equipamento:</strong> <?= $l['nm_equipamento'] ?></p>
                                <?php } ?>

                                <p><strong>Aberto por:</strong> <?= $l['usuario_abertura'] ?></p>

                                <?php if ($l['st_chamado'] == 'Concluido') { ?>
                                <p><strong>Concluído por:</strong> <?= $l['usuario_fechamento'] ?></p>
                                <?php } ?>

                                <?php if (!empty($l['ds_recado'])) { ?>
                                <p><strong>Recado:</strong> <?= $l['ds_recado'] ?></p>
                                <?php } ?>
                            </div>

                            <div style="margin-bottom:0">
                                <span class="badge bg-primary" style="font-size:15px;">Status:
                                    <?= $l['st_chamado'] ?></span><br>
                            </div>
                        </div>

                        <div class="card-footer mx-auto btn-group">
                            <?php if($_SESSION['cargo']!='comum'|| $l['st_chamado'] == 'Aberto'){ ?>
                            <button class="btn btn-danger btn-sm deletar" data-toggle="modal" data-target="#deletar"
                                title="Deletar" cd="<?= $l['cd_chamado']; ?>" titulo="<?= $l['nm_chamado']; ?>">
                                <i class="botoes bi bi-trash3-fill"></i>
                            </button>
                            <?php }?>
                            <?php if($l['st_chamado']=='Aberto' && $_SESSION['cargo']!='comum'){?>
                            <button class="btn btn-warning btn-sm andamento" data-toggle="modal"
                                data-target="#modalAndamento" cd="<?= $l['cd_chamado']; ?>"
                                titulo="<?= $l['nm_chamado']; ?>" descricao="<?= $l['ds_chamado'] ?>"
                                equipamento="<?= $l['nm_equipamento'] ?? 'Não especificado' ?>"
                                status="<?= $l['st_chamado']; ?>" abertura="<?= $l['dt_abertura']; ?>"
                                usuario="<?= $l['usuario_abertura']; ?>">
                                <i class="botoes bi bi-hourglass-split"></i>
                            </button>
                            <?php }elseif($l['st_chamado']=='Andamento' && $_SESSION['cargo']!='comum'){?>
                            <button class="btn btn-success btn-sm concluir" data-toggle="modal"
                                data-target="#modalConclusao" cd="<?= $l['cd_chamado']; ?>"
                                titulo="<?= $l['nm_chamado']; ?>">
                                <i class="botoes bi bi-check-circle-fill"></i>
                            </button>
                            <?php }?>
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
    if ($_POST['action'] == "Abrir") {
        $id_equipamento = !empty($_POST['equipamento']) ? intval($_POST['equipamento']) : null;
        AbrirChamado(
            strtoupper($_POST['titulo']), 
            $_POST['descricao'], 
            $id_equipamento,
            $_SESSION['id'], 
            $_SESSION['conexao'], 
            "chamados.php");
    } elseif($_POST['action'] == "EmAndamento") {
        ColocarEmAndamento(
            $_POST['cd_chamado'],
            $_SESSION['id'], 
            $_SESSION['conexao'], 
            "chamados.php"
        );
    } elseif ($_POST['action'] == "Deletar") {
        ExcluirEquipamento(
            $_POST['cd'], 
            $_SESSION['conexao'], 
            "chamados.php");
    }elseif ($_POST['action'] == "ConcluirChamado") {
        ConcluirChamado(
            $_POST['cd_chamado'],
            $_POST['recado'],
            $_SESSION['id'],
            $_SESSION['conexao'],
            "chamados.php"
        );
    }
}
?>