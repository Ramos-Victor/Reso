<?php
session_start();
include_once './function.php';

$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : null;
$sala = isset($_GET['sala']) ? $_GET['sala'] : null;

// Passar os dois filtros para a função ListarEquipamentos
$listar = ListarEquipamentos($categoria, $sala);

if ($listar && count($listar) > 0) {
    ?>
<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <thead class="bg-primary text-white text-center">
            <tr>
                <th style="width: 10%;">#</th>
                <th style="width: 15%;">Nome</th>
                <th style="width: 15%;">Categoria</th>
                <th style="width: 15%;">Status</th>
                <th style="width: 15%;">Local</th>
                <th style="width: 40%;">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($listar as $l){ ?>
            <tr class="text-center">
                <td><?= $l['cd_equipamento'] ?></td>
                <td><?= $l['nm_equipamento'] ?></td>
                <td><?= $l['categoria_nm'] ?></td>
                <td>
                    <span class="badge <?= $l['st_equipamento'] == 'Ativo' ? 'bg-success' : 'bg-danger' ?>"
                        style="font-size: 15px;">
                        <?= $l['st_equipamento'] ?>
                    </span>
                </td>
                <td><?= $l['nm_sala'] ?></td>
                <td>
                    <button class="btn btn-danger btn-sm deletar" data-toggle="modal" data-target="#deletar"
                        title="Deletar" cd="<?= $l['cd_equipamento']; ?>" nome="<?= $l['nm_equipamento']; ?>">
                        <i class="botoes bi bi-trash3-fill"></i> Deletar
                    </button>
                    <button class="btn btn-primary btn-sm editar" data-toggle="modal" data-target="#modalEditar"
                        cd="<?= $l['cd_equipamento']; ?>" nome="<?= $l['nm_equipamento']; ?>"
                        categoria="<?= $l['id_categoria']; ?>" sala="<?= $l['id_sala']; ?>"
                        status="<?= $l['st_equipamento']; ?>" descricao="<?= $l['ds_equipamento']; ?>">
                        <i class="botoes bi bi-pencil-fill"></i> Editar
                    </button>
                </td>
            </tr>
        </tbody>
        <?php } ?>
    </table>
</div>
<?php
} else {
    echo "<tr><td colspan='6' class='text-center text-muted'>Nenhum equipamento encontrado.</td></tr>";
}
?>
