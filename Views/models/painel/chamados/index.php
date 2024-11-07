<?php
include_once '../header.php';
include_once './chamados/function.php';
include_once './chamados/modal.php';
include_once './chamados/script.php';

?>

<style>
.botoes {
    font-size: 20px;
}
</style>

<body>
    <?php
        include_once '../nav.php';
    ?>
     <br><br><br><br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2 col-xs-2">
                <form method="GET" action="">
                    <button class="btn btn-block"
                        style="background-color:#03305c; position: sticky; top: 0; z-index: 100;" type="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="text-white mx-auto">FILTROS</span>
                    </button>
                    <div class="dropdown-menu">
                        <button class="dropdown-item" type="submit" name="status" value="Aberto">Aberto</button>
                        <button class="dropdown-item" type="submit" name="status" value="Andamento">Andamento</button>
                        <button class="dropdown-item" type="submit" name="status" value="Concluido">Concluído</button>
                        <button class="dropdown-item" type="submit" name="status" value="">Limpar</button>
                    </div>
                </form>
            </div>
            <div class="col-sm-8 text-left mt-2">
                <h5><?php if(!empty($_GET['status']) && $_GET['status']!="")echo "<h9 class='text-muted'>Filtro selecionado: ".$_GET['status']."</h9>";?></h5>
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
        <div class="row overflow-auto"
            style="overflow-y: scroll; overflow-x: hidden; scrollbar-width: none; scroll-behavior: smooth;">
            <?php
        $status = isset($_GET['status']) ? $_GET['status'] : null;
        $listar = ListarChamados($status);
        

        if ($listar && count($listar)> 0 ) {
            foreach ($listar as $index => $l) {
        ?>
            <div class="col-md-4 col-sm-6">
                <div class="card mt-2 mb-3" style="border-radius: 10px; 
                background: linear-gradient(135deg, <?= $index % 2 == 0 ? '#0a4a8a' : '#03305c' ?>, <?= $index % 2 == 0 ? '#03305c' : '#0a4a8a' ?>);
                height: 350px; overflow: hidden;">

                    <div class="card-body text-white d-flex justify-content-between">
                        <div class="d-flex flex-column justify-content-between" style="flex: 1;">
                            <div>
                                <h5 class="card-title"><?= $l['nm_chamado'] ?></h5>
                                <h6 class="card-subtitle text-light mt-2"><?= $l['ds_chamado'] ?></h6>

                                <div class="mt-2">
                                    <p><strong>Aberto em:</strong> <?= $l['dt_abertura'] ?>
                                    </p>
                                    <?php if ($l['st_chamado'] == 'Concluido') { ?>
                                    <p><strong>Finalizado em:</strong>
                                        <?= $l['dt_fechamento'] ?></p>
                                    <?php } elseif ($l['st_chamado'] == 'Andamento') { ?>
                                    <p><strong>Aberto em:</strong> <?= $l['dt_fechamento'] ?>
                                    </p>
                                    <?php } ?>

                                    <?php if ($l['nm_equipamento']) { ?>
                                    <p><strong>Equipamento:</strong> <?= $l['nm_equipamento'] ?></p>
                                    <?php } ?>

                                    <p><strong>Aberto por:</strong> <?= $l['usuario_abertura'] ?></p>
                                    <p><strong>Finalizado por:</strong> <?= $l['usuario_fechamento'] ?></p>
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
                                <span class="badge <?= $badgeClass ?>" style="font-size: 15px;">Status:
                                    <?= $l['st_chamado'] ?></span>
                            </div>
                        </div>

                        <div class="d-flex align-items-start  overflow-auto" style="flex-shrink: 0; text-align: right; overflow-y: scroll;
  overflow-x: hidden;
  scrollbar-width: none;
  scroll-behavior: smooth;">
                            <?php if (!empty($l['ds_recado'])) { ?>
                            <p style="word-wrap: break-word; max-width: 200px; "><strong>Feedback:</strong><br>
                                <?= $l['ds_recado'] ?></p>
                            <?php } ?>
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
                            <i class="botoes bi bi-hourglass-split"></i> Atribuir Andamento
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
        }else {
            echo "<div class='col-12 text-center text-muted' style='position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);'><h5>Nenhum chamado encontrado.</h5></div>";
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