<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Reso/Views/painel/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Reso/Views/painel/usuarios/usuarios/function.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Reso/Views/painel/usuarios/usuarios/modal.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Reso/Views/painel/usuarios/usuarios/script.php';
?>

<style>
.botoes {
    font-size: 1.5rem;
}

.table-responsive {
    height: 85vh;
    overflow-y: auto;
    position: relative;
    overflow-y: scroll;
    overflow-x: hidden;
    scrollbar-width: none;
    scroll-behavior: smooth;
}

.table thead {
    position: sticky;
    top: 0;
    z-index: 2;
    background-color: #007bff;
    color: white;
    border-top: 1px solid #dee2e6;
}

tbody {
    background-color: #f8f9fa;
}

tbody tr {
    scroll-margin-top: 50px;
}
</style>

<body>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Reso/Views/painel/nav.php'; ?>
    <br><br><br><br>
    <div class="container-fluid mt-2">
        <div class="row mt-3 container-fluid">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="text-center">
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
                        <tr class="text-center" id="id<?= $l['cd_usuario'] ?>">
                            <td><?php echo $l['nm_usuario']; ?></td>
                            <td><?php echo strtoupper($l['cargo_usuario']); ?></td>
                            <td><?php echo $l['dt_entrada']; ?></td>
                            <td>
                                <div class="btn-group">
                                    <?php if ($l['cargo_usuario'] != "criador"): ?>
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
                                    <?php endif; ?>
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
            "?route=/painelUsuarios"
        );
    } elseif ($_POST['action'] == "Deletar") {
        ExcluirUsuario(
            $_POST['cd'],
            $_SESSION['conexao'],
            "?route=/painelUsuarios"
        );
    }
}
?>