<?php
require_once 'header.php';
require_once './chamados/function.php';
require_once './chamados/modal.php';
require_once './chamados/script.php';

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
            <button class="btn btn-block" style="background-color:#03305c; position: sticky; top: 0; z-index: 100;">
                <span class="text-white mx-auto">FILTROS</span>
            </button>
        </div>
        <div class="col-sm-8">
        </div>
        <div class="col-sm-2 col-xs-2">
            <button class="btn btn-block d-flex flex-row" style="background-color:#03305c; position: sticky; top: 0; z-index: 100;" data-toggle="modal" data-target="#abrirChamado">
                <i class="navicon bi bi-plus-circle"></i>
                <span class="text-white mx-auto">CHAMADO</span>
            </button>
        </div>
    </div>
    <div class="row mt-3 overflow-auto" style="overflow-y: scroll; overflow-x: hidden; scrollbar-width: none; scroll-behavior: smooth;">
        <?php
        $listar = ListarChamados();

        if ($listar) {
            foreach ($listar as $index => $l) {
        ?>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card mt-3" style="border-radius: 10px; 
                background: linear-gradient(135deg, <?= $index % 2 == 0 ? '#0a4a8a' : '#03305c' ?>, <?= $index % 2 == 0 ? '#03305c' : '#0a4a8a' ?>);
                height: 350px; overflow: hidden;">

                    <div class="card-body text-white d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="card-title"><?= $l['nm_chamado'] ?></h5>
                            <h6 class="card-subtitle text-light mt-2"><?= $l['ds_chamado'] ?></h6>

                            <div class="mt-2">
                                <p><strong>Abertura:</strong> <?= date('d/m/Y H:i', strtotime($l['dt_abertura'])) ?></p>
                                <?php if ($l['st_chamado'] == 'Concluido') { ?>
                                    <p><strong>Fechamento:</strong> <?= date('d/m/Y H:i', strtotime($l['dt_fechamento'])) ?></p>
                                <?php } elseif ($l['st_chamado'] == 'Andamento') { ?>
                                    <p><strong>Início:</strong> <?= date('d/m/Y H:i', strtotime($l['dt_fechamento'])) ?></p>
                                <?php } ?>

                                <?php if ($l['nm_equipamento']) { ?>
                                    <p><strong>Equipamento:</strong> <?= $l['nm_equipamento'] ?></p>
                                <?php } ?>

                                <p><strong>Aberto por:</strong> <?= $l['usuario_abertura'] ?></p>
                            </div>
                        </div>

                        <div>
                            <?php
                            $badgeClass = '';
                            switch ($l['st_chamado']) {
                                case 'Aberto':
                                    $badgeClass = 'bg-primary';
                                    break;
                                case 'Andamento':
                                    $badgeClass = 'bg-warning';
                                    break;
                                case 'Concluido':
                                    $badgeClass = 'bg-success';
                                    break;
                                default:
                                    $badgeClass = 'bg-secondary';
                            }
                            ?>
                            <span class="badge <?= $badgeClass ?>" style="font-size: 15px;">Status: <?= $l['st_chamado'] ?></span>
                        </div>
                    </div>

                    <div class="card-footer bg-transparent text-center">
                        <?php if ($_SESSION['cargo'] != 'comum' || $l['st_chamado'] == 'Aberto') { ?>
                            <button class="btn btn-danger btn-sm deletar" data-toggle="modal" data-target="#deletar"
                                title="Deletar" cd="<?= $l['cd_chamado']; ?>" titulo="<?= $l['nm_chamado']; ?>">
                                <i class="botoes bi bi-trash3-fill"></i> Deletar
                            </button>
                        <?php } ?>
                        <?php if ($l['st_chamado'] == 'Aberto' && $_SESSION['cargo'] != 'comum') { ?>
                            <button class="btn btn-warning btn-sm andamento" data-toggle="modal"
                                data-target="#modalAndamento" cd="<?= $l['cd_chamado']; ?>"
                                titulo="<?= $l['nm_chamado']; ?>" descricao="<?= $l['ds_chamado'] ?>"
                                equipamento="<?= $l['nm_equipamento'] ?? 'Não especificado' ?>"
                                status="<?= $l['st_chamado']; ?>" abertura="<?= $l['dt_abertura']; ?>"
                                usuario="<?= $l['usuario_abertura']; ?>">
                                <i class="botoes bi bi-hourglass-split"></i> Andamento
                            </button>
                        <?php } elseif ($l['st_chamado'] == 'Andamento' && $_SESSION['cargo'] != 'comum') { ?>
                            <button class="btn btn-success btn-sm concluir" data-toggle="modal"
                                data-target="#modalConclusao" cd="<?= $l['cd_chamado']; ?>"
                                titulo="<?= $l['nm_chamado']; ?>">
                                <i class="botoes bi bi-check-circle-fill"></i> Concluir
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
            $_POST['cd'],
            $_SESSION['id'], 
            $_SESSION['conexao'], 
            "chamados.php"
        );
    } elseif ($_POST['action'] == "DeletarChamado") {
        DeletarChamado(
            $_POST['cd'], 
            $_SESSION['conexao'], 
            "chamados.php");
    }elseif ($_POST['action'] == "ConcluirChamado") {
        ConcluirChamado(
            $_POST['cd'],
            $_POST['recado'],
            $_SESSION['id'],
            $_SESSION['conexao'],
            "chamados.php"
        );
    }
}
?>