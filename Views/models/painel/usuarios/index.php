<?php
require_once '../header.php';
require_once './usuarios/function.php';
require_once './usuarios/modal.php';
require_once './usuarios/script.php';
?>

<style>
.botoes {
    font-size: 1.5rem;
}

.table td {
    border-top: none;
}

thead {
    border-bottom: 1px solid;
}

.table thead th {
    background-color: #03305c;
    position: sticky;
    top: 0;
    z-index: 10;
}
</style>

<body>
    <?php require_once '../nav.php'; ?>
    <br><br><br><br>
    <div class="container-fluid mt-2">
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="table-responsive" style="overflow-y: auto;">
                    <table class="table text-white" style="border-collapse: separate; border-spacing: 0;">
                        <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Cargo</th>
                                <th scope="col">Data</th>
                                <th scope="col" style="width: 200px;">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $listar = ListarUsuarios();
                            if ($listar) {
                                foreach ($listar as $index => $l) {
                                    ?>
                            <tr
                                style="<?php echo ($index % 2 == 0) ? 'background-color:#03305c;' : 'background-color:#0a4a8a;'; ?>">
                                <td><?php echo $l['nm_usuario']; ?></td>
                                <td><?php echo strtoupper($l['cargo_usuario']); ?></td>
                                <td><?php echo $l['dt_entrada']; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <?php if($l['cargo_usuario']!= "criador"): ?>
                                        <button class="btn btn-primary btn-sm editar" data-toggle="modal"
                                            data-target="#editar" title="Editar" cd="<?php echo $l['id_usuario']; ?>"
                                            nome="<?php echo $l['nm_usuario']; ?>"
                                            cargo="<?php echo $l['cargo_usuario']; ?>"
                                            data="<?php echo $l['dt_entrada']; ?>">
                                            <i class="botoes bi bi-pencil-fill"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm deletar" data-toggle="modal"
                                            data-target="#deletar" title="Deletar" cd="<?php echo $l['id_usuario']; ?>"
                                            nome="<?php echo $l['nm_usuario']; ?>"
                                            cargo="<?php echo $l['cargo_usuario']; ?>"
                                            data="<?php echo $l['dt_entrada']; ?>">
                                            <i class="botoes bi bi-trash-fill"></i>
                                        </button>
                                        <?php endif;?>
                                    </div>
                                </td>
                            </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/Reso/footer.php';
    ?>
</body>

<?php
if (!empty($_POST)) {
    if ($_POST['action'] == "Editar") {
        EditarUsuario(
            $_POST['cd'],
            $_POST['cargo'],
            $_SESSION['conexao'],
            "index.php"
        );
    } elseif ($_POST['action'] == "Deletar") {
        ExcluirUsuario(
            $_POST['cd'],
            $_SESSION['conexao'],
            "index.php"
        );
    }
}
?>