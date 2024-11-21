<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/Reso/Views/painel/salas/salas/function.php';

$listar = ListarSalas();
if ($listar) {
    ?>
<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <thead class="bg-primary text-white text-center">
            <tr>
                <th style="width: 20%;">Nome</th>
                <th style="width: 20%;">Criado em</th>
                <th style="width: 20%;">Descrição</th>
                <th style="width: 20%;">Criado por</th>
                <th style="width: 20%;">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listar as $l) { ?>
            <tr class="text-center" id="id<?= $l['cd_sala'] ?>">
                <td><?= $l['nm_sala'] ?></td>
                <td><?= $l['dt_sala'] ?></td>
                <td>
                    <?= strlen($l['ds_sala']) > 30 ? substr($l['ds_sala'], 0, 30) . '...' : $l['ds_sala'] ?>
                </td>
                <td><a href="?route=/painelUsuarios#id<?= $l['id_usuario'] ?>"><?= $l['nm_usuario'] ?></a></td>
                <td class="btn-group justify-content-center" style="border:none;column-gap:5px;">
                    <button class="btn btn-success btn-sm ver" data-toggle="modal" data-target="#ver" title="Ver"
                        cd="<?= $l['cd_sala']; ?>" nome="<?= $l['nm_sala']; ?>" desc="<?= $l['ds_sala']; ?>"
                        criado="<?= $l['nm_usuario']; ?>" data="<?= $l['dt_sala']; ?>">
                        <i class="botoes bi bi-eye-fill"></i> Ver
                    </button>
                    <?php if ($l['nm_sala'] != "ESTOQUE") { ?>
                    <button class="btn btn-danger btn-sm deletar" data-toggle="modal" data-target="#deletar"
                        title="Deletar" cd="<?= $l['cd_sala']; ?>" nome="<?= $l['nm_sala']; ?>" desc="<?= $l['ds_sala']; ?>"
                        criado="<?= $l['id_usuario']; ?>" data="<?= $l['dt_sala']; ?>">
                        <i class="botoes bi bi-trash3-fill"></i> Deletar
                    </button>
                    <button class="btn btn-primary btn-sm editar" data-toggle="modal" data-target="#editar"
                        title="Editar" cd="<?= $l['cd_sala']; ?>" nome="<?= $l['nm_sala']; ?>" desc="<?= $l['ds_sala']; ?>"
                        criado="<?= $l['id_usuario']; ?>" data="<?= $l['dt_sala']; ?>">
                        <i class="botoes bi bi-pencil-fill"></i> Editar
                    </button>
                    <?php } ?>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php
} else {
    echo "<div class='col-12 text-center text-muted my-3' style='position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);'><h5>Nenhuma sala encontrada.</h5></div>";
}
?>
