<?php
require_once 'header.php';
require_once './equipamentos/categoria/function.php';
require_once './equipamentos/categoria/modal.php';
require_once './equipamentos/categoria/script.php';

?>

<style>
.btnequi {
    background-color: #03305c;
    color: white;
}

.btnequi:hover {
    background-color: #0a539c;
    color: white;
}

.btn-group {
    display: flex;
    justify-content: space-around;
    width: 200px;
}

.botoes {
    font-size: 20px;
}

.card-footer {
    background-color: #03305c;
    border: none;
}
</style>

<body>
    <?php
        require_once 'nav.php';
    ?>
    <div id="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 text-center text-white">
                    <h2><b>Categorias</b></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-10 col-xs-10"></div>
                <div class="col-sm-2 col-xs-2">
                    <button class="btn btn-block d-flex flex-row" style="background-color:#03305c;" data-toggle="modal"
                        data-target="#addcategoria">
                        <a class="text-white">
                            <i class="navicon bi bi-plus-circle"></i>
                            Categoria
                        </a>
                    </button>
                </div>
            </div>
            <div class="row mt-3">
                <?php
                    $listar = ListarCategorias();

                    if($listar){
                        foreach($listar as $l){
                ?>
                <div class="col-sm-4 text-white">
                    <div class="card  mx-auto" style="width: 16rem; background-color:#03305c">
                        <div class="card-body">
                            <h5 class="card-title"><?= $l['categoria_nm']?></h5>
                            <h6 class="card-subtitle mb-2 text-white">Criado:<?=$l['dt_categoria'] ?> </h6>
                            <h7 class="card-subtitle mb-2 text-white">Por:<?= $l['nm_usuario'] ?></h7>
                        </div>
                        <div class="card-footer mx-auto btn-group">
                            <button class="btn btn-danger btn-sm deletar" data-toggle="modal" data-target="#deletar"
                                title="deletar"
                                cd="<?php echo $l['cd_categoria']; ?>"
                                nome="<?php echo $l['categoria_nm']; ?>" 
                                criado="<?php echo $l['id_usuario']; ?>"
                                data="<?php echo $l['dt_categoria'];?>">
                                <i class="botoes bi bi-trash3-fill"></i>
                            </button>
                            <button class="btn btn-primary btn-sm editar" data-toggle="modal" data-target="#editar"
                                title="editar" 
                                cd="<?php echo $l['cd_categoria']; ?>"
                                nome="<?php echo $l['categoria_nm']; ?>" 
                                criado="<?php echo $l['id_usuario']; ?>"
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
    }
}
?>