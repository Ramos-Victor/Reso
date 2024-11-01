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

.card {
    overflow: hidden;
    border-radius: 10px;
}

.table td {
    white-space: nowrap; /* Mantém o texto em uma linha */
    overflow: hidden; /* Esconde o texto excedente */
    text-overflow: ellipsis; /* Adiciona "..." para texto longo */
    max-width: 150px; /* Define a largura máxima para a célula */
}

.card-body {
    overflow-wrap: break-word; /* Quebra palavras longas */
    word-break: break-word; /* Quebra palavras longas */
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


            <div class="row mt-3 overflow-auto "
                style="max-height: 850px; overflow-y: scroll; overflow-x: hidden; scrollbar-width: none; scroll-behavior: smooth;">
                <?php
            $listar = ListarConexao();
            if($listar){
                foreach($listar as $index => $l){
            ?>
                <div class="col-md-6 mt-3 abuble">
                    <div class="card" style="<?php if ($index % 2 == 0) { echo "background-color:#03305c;"; } else { echo "background-color:#0a4a8a;"; } ?>">
                        <div class="card-body">
                            <table class="table text-white">
                                <thead>
                                    <tr>
                                        <td scope="col">Nome</td>
                                        <td scope="col">Cargo</td>                                     
                                        <td scope="col">Data</td>                               
                                        <td scope="col">Botões</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td scope="row"><?php echo $l['nm_conexao']?></td>
                                        <td scope="row"><?php echo strtoupper($l['cargo_usuario'])?></td>
                                        <td scope="row"><?php echo $l['dt_entrada']?></td>
                                        <td scope="row">
                                            <div class="btn-group">
                                                <button class="btn btn-success btn-sm ver" data-toggle="modal"
                                                    data-target="#ver" title="ver" cd="<?php echo $l['cd_conexao']; ?>"
                                                    nome="<?php echo $l['nm_conexao']; ?>"
                                                    cargo="<?php echo $l['cargo_usuario']; ?>" <?php
                                                    if($l['cargo_usuario']=="comum" || $l['cargo_usuario'] == "suporte"){
                                                ?> codigo="Sem permissão para ver o código da conexão" <?php
                                                    }else{
                                                ?> codigo="<?php echo $l['codigo_conexao']; ?>" <?php
                                                    }
                                                ?> data="<?php echo $l['dt_entrada'];?>">
                                                    <i class="botoes bi bi-eye-fill"></i>
                                                </button>

                                                <?php
                                                    if($l['cargo_usuario']=="criador"){
                                                ?>
                                                <button class="btn btn-danger btn-sm deletar" data-toggle="modal"
                                                    data-target="#deletar" title="deletar"
                                                    cd="<?php echo $l['cd_conexao']; ?>"
                                                    nome="<?php echo $l['nm_conexao']; ?>"
                                                    cargo="<?php echo $l['cargo_usuario']; ?>"
                                                    codigo="<?php echo $l['codigo_conexao']; ?>"
                                                    data="<?php echo $l['dt_entrada'];?>">
                                                    <i class="botoes bi bi-trash3-fill"></i>
                                                </button>
                                                <?php                                               
                                                    }else{
                                                ?>
                                                <button class="btn btn-danger btn-sm sair" data-toggle="modal"
                                                    data-target="#sair" title="sair"
                                                    cd="<?php echo $l['cd_conexao']; ?>"
                                                    nome="<?php echo $l['nm_conexao']; ?>"
                                                    cargo="<?php echo $l['cargo_usuario']; ?>"
                                                    codigo="<?php echo $l['codigo_conexao']; ?>"
                                                    data="<?php echo $l['dt_entrada'];?>">
                                                    <i class="botoes bi bi-box-arrow-right"></i>
                                                </button>
                                                <?php                                               
                                                    }
                                                ?>

                                                <?php                                               
                                                    if($l['cargo_usuario']=="criador"){
                                                ?>
                                                <button class="btn btn-primary btn-sm editar" data-toggle="modal"
                                                    data-target="#editar" title="editar"
                                                    cd="<?php echo $l['cd_conexao']; ?>"
                                                    nome="<?php echo $l['nm_conexao']; ?>"
                                                    cargo="<?php echo $l['cargo_usuario']; ?>"
                                                    codigo="<?php echo $l['codigo_conexao']; ?>"
                                                    data="<?php echo $l['dt_entrada'];?>">
                                                    <i class="botoes bi bi-pencil-fill"></i>
                                                </button>
                                                <?php                                               
                                                    }
                                                ?>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
        $_SESSION['nm_conexao']=$_POST['nome'];
        $_SESSION['cargo']=$_POST['cargo'];
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