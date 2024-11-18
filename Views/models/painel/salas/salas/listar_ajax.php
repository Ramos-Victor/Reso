<?php

session_start();

require_once './function.php';

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
            <button class="btn btn-danger btn-sm deletar" data-toggle="modal" data-target="#deletar" title="Deletar"
                cd="<?= $l['cd_sala']; ?>" nome="<?= $l['nm_sala']; ?>" desc="<?= $l['ds_sala']; ?>"
                criado="<?= $l['id_usuario']; ?>" data="<?= $l['dt_sala']; ?>">
                <i class="botoes bi bi-trash3-fill"></i> Deletar
            </button>
            <?php } 
                        if ($l['nm_sala'] != "ESTOQUE") { ?>
            <button class="btn btn-primary btn-sm editar" data-toggle="modal" data-target="#editar" title="Editar"
                cd="<?= $l['cd_sala']; ?>" nome="<?= $l['nm_sala']; ?>" desc="<?= $l['ds_sala']; ?>"
                criado="<?= $l['id_usuario']; ?>" data="<?= $l['dt_sala']; ?>">
                <i class="botoes bi bi-pencil-fill"></i> Editar
            </button>
            <?php } ?>
        </div>
    </div>
</div>
<?php
        }
} else {
    echo "<div class='col-12 text-center text-muted'><h5>Nenhuma categoria encontrada.</h5></div>";
}
?>