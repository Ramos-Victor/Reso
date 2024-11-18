<?php
session_start();
include_once './function.php';

$status = isset($_GET['status']) ? $_GET['status'] : null;
$listar = ListarChamados($status);

if ($listar && count($listar) > 0) {
    foreach ($listar as $index => $l) {
        ?>
<div class="col-md-4 col-sm-6">
    <div class="card mt-2 mb-3" style="border-radius: 10px; 
        background: linear-gradient(135deg, <?= $index % 2 == 0 ? '#0a4a8a' : '#03305c' ?>, <?= $index % 2 == 0 ? '#03305c' : '#0a4a8a' ?>);
        height: 400px; overflow: hidden;">

        <div class="card-body text-white d-flex justify-content-between">
            <div class="d-flex flex-column justify-content-between" style="flex: 1;">
                <div>
                    <h5 class="card-title"><?= $l['nm_chamado'] ?></h5>
                    <h6 class="card-subtitle text-light mt-2"><?= $l['ds_chamado'] ?></h6>

                    <div class="mt-2">
                        <p><strong>Aberto em:</strong> <?= $l['dt_abertura'] ?></p>
                        <?php if ($l['st_chamado'] == 'Concluido') { ?>
                        <p><strong>Finalizado em:</strong> <?= $l['dt_fechamento'] ?></p>
                        <?php } elseif ($l['st_chamado'] == 'Andamento') { ?>
                        <p><strong>Em andamento desde:</strong> <?= $l['dt_fechamento'] ?></p>
                        <?php } ?>
                        <?php if ($l['nm_equipamento']) { ?>
                        <p><strong>Equipamento:</strong> <?= $l['nm_equipamento'] ?></p>
                        <?php } ?>
                        <p><strong>Aberto por:</strong> <?= $l['usuario_abertura'] ?></p>
                        <?php if ($l['st_chamado'] == 'Concluido') { ?>
                        <p><strong>Finalizado por:</strong> <?= $l['usuario_fechamento'] ?></p>
                        <?php } ?>
                    </div>
                </div>
                <div>
                    <?php
                        $badgeClass = match ($l['st_chamado']) {
                            'Aberto' => 'bg-primary',
                            'Andamento' => 'bg-warning',
                            'Concluido' => 'bg-success',
                            default => 'bg-secondary',
                        };
                    ?>
                    <span class="badge <?= $badgeClass ?>" style="font-size: 15px;">Status:
                        <?= $l['st_chamado'] ?></span>
                </div>
            </div>
            <div>
                <?php if (!empty($l['ds_recado'])) { ?>
                <p class="feedback-text"><strong>Feedback:</strong><br><?= $l['ds_recado'] ?></p>
                <?php } ?>
            </div>
        </div>
        <div class="card-footer bg-transparent text-center">
            <?php if ($_SESSION['cargo'] != 'comum' || $l['st_chamado'] == 'Aberto') { ?>
            <button class="btn btn-danger btn-sm deletar" data-toggle="modal" data-target="#deletar" title="Deletar"
                cd="<?= $l['cd_chamado']; ?>" titulo="<?= $l['nm_chamado']; ?>">
                <i class="botoes bi bi-trash3-fill"></i> Deletar
            </button>
            <?php } 
                        if($l['st_chamado'] =='Aberto' && $l['id_abertura']== $_SESSION['id']){
                        ?>
            <button class="btn btn-primary btn-sm editar" data-toggle="modal" data-target="#modalEditar"
                cd="<?= $l['cd_chamado']; ?>" titulo="<?= $l['nm_chamado']; ?>" descricao="<?= $l['ds_chamado'] ?>"
                equipamento="<?= $l['nm_equipamento'] ?? 'Não especificado' ?>" status="<?= $l['st_chamado']; ?>"
                abertura="<?= $l['dt_abertura']; ?>" usuario="<?= $l['usuario_abertura']; ?>">
                <i class="botoes bi bi-hourglass-split"></i> Editar
            </button>
            <?php 
                        }
                        if ($l['st_chamado'] == 'Aberto' && $_SESSION['cargo'] != 'comum') { ?>
            <button class="btn btn-warning btn-sm andamento" data-toggle="modal" data-target="#modalAndamento"
                cd="<?= $l['cd_chamado']; ?>" titulo="<?= $l['nm_chamado']; ?>" descricao="<?= $l['ds_chamado'] ?>"
                equipamento="<?= $l['nm_equipamento'] ?? 'Não especificado' ?>" status="<?= $l['st_chamado']; ?>"
                abertura="<?= $l['dt_abertura']; ?>" usuario="<?= $l['usuario_abertura']; ?>">
                <i class="botoes bi bi-hourglass-split"></i> Atribuir Andamento
            </button>
            <?php } elseif ($l['st_chamado'] == 'Andamento' && $_SESSION['cargo'] != 'comum') { ?>
            <button class="btn btn-success btn-sm concluir" data-toggle="modal" data-target="#modalConclusao"
                cd="<?= $l['cd_chamado']; ?>" titulo="<?= $l['nm_chamado']; ?>">
                <i class="botoes bi bi-check-circle-fill"></i> Concluir
            </button>
            <?php }

                        if($l['st_chamado']=='Concluido'){
                       ?>
            <button class="btn btn-success btn-sm avaliar" data-toggle="modal" data-target="#modalAvaliar"
                cd="<?= $l['cd_chamado']; ?>" titulo="<?= $l['nm_chamado']; ?>">
                <i class="botoes bi bi-star-fill"></i> Avaliar
            </button>
            <?php }?>
        </div>
    </div>
</div>
<?php
    }
} else {
    echo "<div class='col-12 text-center text-muted my-3' style='position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);'><h5>Nenhuma chamado encontrado.</h5></div>";
}
?>