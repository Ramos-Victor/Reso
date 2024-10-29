<?php
require_once 'header.php';
require_once './salas/function.php';
require_once './salas/modal.php';
require_once './salas/script.php';

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
                    <h2><b>Salas</b></h2>
                </div>
                <div class="col-sm-2 col-xs-2">
                    <button class="btn btn-block d-flex flex-row" style="background-color:#03305c;" data-toggle="modal"
                        data-target="#addsala">
                        <a class="text-white mx-auto">
                            <i class="navicon bi bi-plus-circle"></i>
                            SALAS
                        </a>
                    </button>
                </div>
            </div>
            <div class="row mt-3 overflow-auto"
                style="max-height: 850px; overflow-y: scroll; overflow-x: hidden; scrollbar-width: none; scroll-behavior: smooth;">
                <?php
        $listar = ListarSalas();

        if($listar){
            foreach($listar as $index => $l){
    ?>
                <div class="col-sm-2 text-white">
                    <div class="card mt-3"
                        style="padding:5px;width: 14rem; height:14rem; <?php if ($index % 2 == 0) { echo "background-color:#03305c;"; } else { echo "background-color:#0a4a8a;"; } ?> border-radius:10px;">
                        <div class="card-body mx-auto">
                            <h5 class="card-title"><?= $l['nm_sala']?></h5>
                            <h6 class="card-subtitle text-white">Criado: <?=$l['dt_sala'] ?> </h6>
                            <h6 class="card-subtitle text-white mt-1">Descrição: 
                                <?= strlen($l['ds_sala']) > 30 ? substr($l['ds_sala'], 0, 30) . '...' : $l['ds_sala'] ?>
                            </h6>
                            <h7 class="card-subtitle text-white mt-1">Por: <?=$l['nm_usuario'] ?></h7>
                        </div>
                        <div class="card-footer mx-auto btn-group" style="margin-top:-10px ">
                            <button class="btn btn-success btn-sm ver" data-toggle="modal" data-target="#ver"
                                title="editar" cd="<?php echo $l['cd_sala']; ?>"
                                nome="<?php echo $l['nm_sala']; ?>" 
                                desc="<?php echo $l['ds_sala']; ?>" 
                                criado="<?php echo $l['nm_usuario']; ?>"
                                data="<?php echo $l['dt_sala'];?>">
                                <i class="botoes bi bi-eye-fill"></i>
                            </button>
                            <?php if($l['nm_sala']!="ESTOQUE"){?>
                            <button class="btn btn-danger btn-sm deletar" data-toggle="modal" data-target="#deletar"
                                title="deletar" cd="<?php echo $l['cd_sala']; ?>"
                                nome="<?php echo $l['nm_sala']; ?>" 
                                desc="<?php echo $l['ds_sala']; ?>" 
                                criado="<?php echo $l['id_usuario']; ?>"
                                data="<?php echo $l['dt_sala'];?>">
                                <i class="botoes bi bi-trash3-fill"></i>
                            </button>
                            <?php } ?>
                            <button class="btn btn-primary btn-sm editar" data-toggle="modal" data-target="#editar"
                                title="editar" cd="<?php echo $l['cd_sala']; ?>"
                                nome="<?php echo $l['nm_sala']; ?>" 
                                desc="<?php echo $l['ds_sala']; ?>" 
                                criado="<?php echo $l['id_usuario']; ?>"
                                data="<?php echo $l['dt_sala'];?>">
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
        CriarSala(
           strtoupper($_POST['nome']),
            $_POST['desc'],
            $_SESSION['id'],
            $_SESSION['conexao'],
            "salas.php"
        );
    }elseif($_POST['action'] == "Editar"){
        EditarSala(
            $_POST['cd'],
            strtoupper($_POST['nome']),
            $_POST['desc'],
            $_SESSION['id'],
            $_SESSION['conexao'],
            "salas.php"
        );
    }elseif($_POST['action'] == "Deletar"){
        ExcluirSala(
            $_POST['cd'],
            $_SESSION['conexao'],
            "salas.php"
            );
    }
}
?>