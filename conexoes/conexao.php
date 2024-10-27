<?php
    require_once 'header.php';
    require_once 'function.php';
    require_once 'modal.php';
    require_once 'script.php';
?>
<style>
.botoes {
    font-size: 1.5rem;
}

a:hover {
    color: #ffd700;
    text-decoration: none;
}

.btn-group {
    display: flex;
    justify-content: space-around;
    width: 200px;
}

.btn-group button {
    margin: 0 5px;

}

.table td {
    border-top: none;
}

thead {
    border-bottom: 1px solid;
}
</style>
</style>

<body>
    <?php
    require_once 'nav.php';
?>
    <div id="main-content">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-sm-2">
                    <button class="btn btn-block d-flex flex-row" style="background-color:#03305c;" data-toggle="modal"
                        data-target="#addconexao">
                        <a class="mx-auto text-white">
                            <i class="navicon bi bi-plus-circle"></i>
                            Criar
                        </a>
                    </button>
                </div>
                <div class="col-sm-8 text-center text-white">
                    <h2>Conexões</h2>
                </div>
                <div class="col-sm-2 ">
                    <button class="btn btn-block d-flex flex-row" style="background-color:#03305c;" data-toggle="modal"
                        data-target="#entrarconexao">
                        <a class="mx-auto text-white">
                            <i class="navicon bi bi-plus-circle"></i>
                            Conectar
                        </a>
                    </button>
                </div>
            </div>


            <div class="row mt-3 overflow-auto"
                style="max-height: 850px; overflow-y: scroll; overflow-x: hidden; scrollbar-width: none; scroll-behavior: smooth;">
                <?php
            $listar = ListarConexao();
            if($listar){
                foreach($listar as $l){
            ?>
                <div class="col-md-3 mt-3">
                    <div class="card"
                        style="<?php if($l['cd_conexao'] % 2 == 0){ echo "background-color:#03305c";} else { echo "background-color:#0a4a8a";} ?>; border-radius:10px; width:18rem">
                        <div class="card-body" style="padding:1rem">
                            <h5 class="card-title text-white"><?php echo $l['nm_conexao']; ?></h5>
                            <h6 class="card-subtitle mb-2 text-white"><?php echo strtoupper($l['cargo_usuario']); ?>
                            </h6>
                            <p class="card-text text-white">
                                <?php
                if($l['id_criador'] == $_SESSION['id']){
                    echo 'Data de criação: ' . $l['dt_entrada'];
                } else {
                    echo 'Data entrada: ' . $l['dt_entrada'];
                }
                ?>
                            </p>
                            <div class="btn-group mx-auto" role="group">
                                <button class="btn btn-success btn-sm ver" data-toggle="modal" data-target="#ver"
                                    title="ver" cd="<?php echo $l['cd_conexao']; ?>"
                                    nome="<?php echo $l['nm_conexao']; ?>" cargo="<?php echo $l['cargo_usuario']; ?>"
                                    <?php if($l['cargo_usuario'] == "comum" || $l['cargo_usuario'] == "suporte"){ ?>
                                    codigo="Sem permissão para ver o código da conexão" <?php } else { ?>
                                    codigo="<?php echo $l['codigo_conexao']; ?>" <?php } ?>
                                    data="<?php echo $l['dt_entrada'];?>">
                                    <i class="botoes bi bi-eye-fill"></i>
                                </button>

                                <?php if($l['cargo_usuario'] == "criador"){ ?>
                                <button class="btn btn-danger btn-sm deletar" data-toggle="modal" data-target="#deletar"
                                    title="deletar" cd="<?php echo $l['cd_conexao']; ?>"
                                    nome="<?php echo $l['nm_conexao']; ?>" cargo="<?php echo $l['cargo_usuario']; ?>"
                                    codigo="<?php echo $l['codigo_conexao']; ?>" data="<?php echo $l['dt_entrada'];?>">
                                    <i class="botoes bi bi-trash3-fill"></i>
                                </button>
                                <?php } else { ?>
                                <button class="btn btn-danger btn-sm sair" data-toggle="modal" data-target="#sair"
                                    title="sair" cd="<?php echo $l['cd_conexao']; ?>"
                                    nome="<?php echo $l['nm_conexao']; ?>" cargo="<?php echo $l['cargo_usuario']; ?>"
                                    codigo="<?php echo $l['codigo_conexao']; ?>" data="<?php echo $l['dt_entrada'];?>">
                                    <i class="botoes bi bi-box-arrow-right"></i>
                                </button>
                                <?php } ?>

                                <?php if($l['cargo_usuario'] == "criador"){ ?>
                                <button class="btn btn-primary btn-sm editar" data-toggle="modal" data-target="#editar"
                                    title="editar" cd="<?php echo $l['cd_conexao']; ?>"
                                    nome="<?php echo $l['nm_conexao']; ?>" cargo="<?php echo $l['cargo_usuario']; ?>"
                                    codigo="<?php echo $l['codigo_conexao']; ?>" data="<?php echo $l['dt_entrada'];?>">
                                    <i class="botoes bi bi-pencil-fill"></i>
                                </button>
                                <?php } ?>
                            </div>
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
    <?php
    require_once '../footer.php';
?>
</body>

<?php
 if(!empty($_POST)){
    if($_POST['action'] == "Criar"){
        CriarConexao(
            $_POST['nome'],
            $_SESSION['id'],
            "conexao.php"
        );
    }else if($_POST['action']== "Deletar"){
        DeletarConexao(
            $_POST['cd'],
            "conexao.php"
        );
    }else if($_POST['action']=="Sair"){
        SairConexao(
            $_SESSION['id'],
            $_POST['cd'],
            "conexao.php"
        );
    }else if($_POST['action']== "Entrar"){
        EntrarConexao(
            $_SESSION['id'],
            $_POST['code'],
            "conexao.php"
        );
    }else if($_POST['action']=="Acessar"){
        $_SESSION['conexao']=$_POST['cd'];
        if($_POST['cargo']=="criador"){
            ?>
<script>
location.href = "../criador/index.php";
</script>
<?php
        }else if($_POST['cargo']=="comum"){
            ?>
<script>
location.href = "../comum/index.php";
</script>
<?php
        }else if($_POST['cargo']=="suporte"){
            ?>
<script>
location.href = "../suporte/index.php";
</script>
<?php
        }
    }else if($_POST['action']=="Editar"){
        EditarConexao(
            $_POST['cd'],
            $_POST['nome'],
            "conexao.php"
        );
    }
 }
?>