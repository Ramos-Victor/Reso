<?php
require_once 'header.php';
require_once './equipamentos/categoria/function.php';
require_once './equipamentos/categoria/modal.php';
require_once './equipamentos/categoria/script.php';

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
                    <h2><b>Categorias</b></h2>
                </div>
                <div class="col-sm-2 col-xs-2">
                    <button class="btn btn-block d-flex flex-row" style="background-color:#03305c;" data-toggle="modal"
                        data-target="#addcategoria">
                        <a class="text-white mx-auto">
                            <i class="navicon bi bi-plus-circle"></i>
                            Categoria
                        </a>
                    </button>
                </div>
            </div>
            <div class="row mt-3 overflow-auto" style="max-height: 850px; overflow-y: scroll; overflow-x: hidden; scrollbar-width: none; scroll-behavior: smooth;">
                <?php
        $listar = ListarCategorias();

        if($listar){
            foreach($listar as $l){
    ?>
                <div class="col-sm-2 text-white">
                    <div class="card mt-3" style="width: 14rem;<?php if($l['cd_categoria'] % 2 ==0){ echo "background-color:#03305c";}else{ echo "background-color:#0a4a8a";} ?>; border-radius:10px;">
                        <div class="card-body mx-auto">
                            <h5 class="card-title"><?= $l['categoria_nm']?></h5>
                            <h6 class="card-subtitle text-white">Criado: <?=$l['dt_categoria'] ?> </h6>
                            <h7 class="card-subtitle text-white">Por: <?=$l['nm_usuario'] ?></h7>
                        </div>
                        <div class="card-footer mx-auto btn-group" style="margin-top:-10px ">
                            <button class="btn btn-danger btn-sm deletar" data-toggle="modal" data-target="#deletar"
                                title="deletar" cd="<?php echo $l['cd_categoria']; ?>"
                                nome="<?php echo $l['categoria_nm']; ?>" criado="<?php echo $l['id_usuario']; ?>"
                                data="<?php echo $l['dt_categoria'];?>">
                                <i class="botoes bi bi-trash3-fill"></i>
                            </button>
                            <button class="btn btn-primary btn-sm editar" data-toggle="modal" data-target="#editar"
                                title="editar" cd="<?php echo $l['cd_categoria']; ?>"
                                nome="<?php echo $l['categoria_nm']; ?>" criado="<?php echo $l['id_usuario']; ?>"
                                data="<?php echo $l['dt_categoria'];?>">
                                <i class="botoes bi bi-pencil-fill"></i>
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
    </div>
</body>
<?php
if(!empty($_POST)){
    if($_POST['action'] == "Criar"){
        CriarCategoria(
            $_POST['nome'],
            $_SESSION['id'],
            $_SESSION['conexao'],
            "categoria.php"
        );
    }elseif($_POST['action'] == "Editar"){
        EditarCategoria(
            $_POST['cd'],
            $_POST['nome'],
            $_SESSION['conexao'],
            "categoria.php"
        );
    }
}
?>