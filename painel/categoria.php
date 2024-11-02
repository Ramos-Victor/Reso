<?php
require_once 'header.php';
require_once './equipamentos/categoria/function.php';
require_once './equipamentos/categoria/modal.php';
require_once './equipamentos/categoria/script.php';

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
            </div>
            <div class="col-sm-2 col-xs-2">
                <button class="btn btn-block d-flex flex-row" style="background-color:#03305c;" data-toggle="modal"
                    data-target="#addcategoria">
                    <a class="text-white mx-auto">
                        <i class="navicon bi bi-plus-circle"></i>
                        CATEGORIAS
                    </a>
                </button>
            </div>
        </div>
        <div class="row mt-3 overflow-auto"
            style="overflow-y: scroll; overflow-x: hidden; scrollbar-width: none; scroll-behavior: smooth;">
            <?php
    $listar = ListarCategorias("<h2 class='mx-auto text-white'>Cadastre suas categorias, elas serão exibidas aqui!</h2>");

    if ($listar) {
        foreach ($listar as $index => $l) {
    ?>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card border-0 shadow-sm"
                    style="background-color: <?= $index % 2 == 0 ? '#03305c' : '#0a4a8a'; ?>; border-radius: 10px;">
                    <div class="card-body text-center">
                        <h5 class="card-title text-white"><?= $l['categoria_nm'] ?></h5>
                        <h6 class="card-subtitle text-light">Data: <span
                                class="badge bg-secondary"><?= $l['dt_categoria'] ?></span></h6>
                        <h7 class="card-subtitle text-light">Por: <span
                                class="badge bg-info"><?= $l['nm_usuario'] ?></span></h7>
                    </div>
                    <div class="card-footer text-center">
                        <button class="btn btn-danger btn-sm deletar" data-toggle="modal" data-target="#deletar"
                            title="Deletar" cd="<?= $l['cd_categoria']; ?>" nome="<?= $l['categoria_nm']; ?>"
                            criado="<?= $l['id_usuario']; ?>" data="<?= $l['dt_categoria']; ?>">
                            <i class="botoes bi bi-trash3-fill"></i> Deletar
                        </button>
                        <button class="btn btn-primary btn-sm editar" data-toggle="modal" data-target="#editar"
                            title="Editar" cd="<?= $l['cd_categoria']; ?>" nome="<?= $l['categoria_nm']; ?>"
                            criado="<?= $l['id_usuario']; ?>" data="<?= $l['dt_categoria']; ?>">
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

    </div>
</body>
<?php
if(!empty($_POST)){
    if($_POST['action'] == "Criar"){
        CriarCategoria(
            strtoupper($_POST['nome']),
            $_SESSION['id'],
            $_SESSION['conexao'],
            "categoria.php"
        );
    }elseif($_POST['action'] == "Editar"){
        EditarCategoria(
            $_POST['cd'],
           strtoupper($_POST['nome']),
            $_SESSION['conexao'],
            "categoria.php"
        );
    }elseif($_POST['action'] == "Deletar"){
        DeletarCategoria(
            $_POST['cd'],
            $_POST['conexao'],
            "categoria.php"
            );
    }
}
?>