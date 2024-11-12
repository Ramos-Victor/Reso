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

</style>

<body>
    <?php
    require_once 'nav.php';
?>
    <br><br><br><br>
    <div class="container-fluid mt-2">
        <div class="row mb-3">
            <div class="col-12 col-sm-6 col-md-4">
                <button class="btn btn-block d-flex flex-row align-items-center justify-content-center"
                    style="background-color:#03305c;" data-toggle="modal" data-target="#addconexao">
                    <i class="navicon bi bi-plus-circle me-2"></i>
                    <span class="text-white">Criar</span>
                </button>
            </div>
            <div class="col-12 col-sm-6 col-md-4"></div>
            <div class="col-12 col-sm-6 col-md-4">
                <button class="btn btn-block d-flex flex-row justify-content-center" style="background-color:#03305c;"
                    data-toggle="modal" data-target="#entrarconexao">
                    <i class="navicon bi bi-plus-circle me-2"></i>
                    <span class="text-white">Conectar</span>
                </button>
            </div>
        </div>


        <div class="row mt-3">
            <div class="col-md-12">
                <div class="table-responsive" style="overflow-y: auto;">
                    <table class="table text-white" style="border-collapse: separate; border-spacing: 0;">
                        <thead style="background-color:#03305c; position: sticky; top: 0; z-index: 10;">
                            <tr>
                                <th scope="col" style="border-bottom:none;">Nome</th>
                                <th scope="col" style="border-bottom:none;">Cargo</th>
                                <th scope="col" style="border-bottom:none;">Data</th>
                                <th scope="col" style="border-bottom:none; width: 200px;">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                    $listar = ListarConexao();
                    if ($listar) {
                        foreach ($listar as $index => $l) {
                            ?>
                            <tr
                                style="<?php echo ($index % 2 == 0) ? 'background-color:#03305c;' : 'background-color:#0a4a8a;'; ?>">
                                <td><?php echo $l['nm_conexao']; ?></td>
                                <td><?php echo strtoupper($l['cargo_usuario']); ?></td>
                                <td><?php echo $l['dt_entrada']; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-success btn-sm ver" data-toggle="modal"
                                            data-target="#ver" title="ver" cd="<?php echo $l['cd_conexao']; ?>"
                                            nome="<?php echo $l['nm_conexao']; ?>"
                                            cargo="<?php echo $l['cargo_usuario']; ?>"
                                            <?php if ($l['cargo_usuario'] == "comum" || $l['cargo_usuario'] == "suporte") { ?>
                                            codigo="Sem permissão para ver o código da conexão" <?php } else { ?>
                                            codigo="<?php echo $l['codigo_conexao']; ?>" <?php } ?>
                                            data="<?php echo $l['dt_entrada']; ?>">
                                            <i class="botoes bi bi-eye-fill"></i>
                                        </button>

                                        <?php if ($l['cargo_usuario'] == "criador") { ?>
                                        <button class="btn btn-danger btn-sm deletar" data-toggle="modal"
                                            data-target="#deletar" title="deletar" cd="<?php echo $l['cd_conexao']; ?>"
                                            nome="<?php echo $l['nm_conexao']; ?>"
                                            cargo="<?php echo $l['cargo_usuario']; ?>"
                                            codigo="<?php echo $l['codigo_conexao']; ?>"
                                            data="<?php echo $l['dt_entrada']; ?>">
                                            <i class="botoes bi bi-trash3-fill"></i>
                                        </button>
                                        <?php } else { ?>
                                        <button class="btn btn-danger btn-sm sair" data-toggle="modal"
                                            data-target="#sair" title="sair" cd="<?php echo $l['cd_conexao']; ?>"
                                            nome="<?php echo $l['nm_conexao']; ?>"
                                            cargo="<?php echo $l['cargo_usuario']; ?>"
                                            codigo="<?php echo $l['codigo_conexao']; ?>"
                                            data="<?php echo $l['dt_entrada']; ?>">
                                            <i class="botoes bi bi-box-arrow-right"></i>
                                        </button>
                                        <?php } ?>

                                        <?php if ($l['cargo_usuario'] == "criador") { ?>
                                        <button class="btn btn-primary btn-sm editar" data-toggle="modal"
                                            data-target="#editar" title="editar" cd="<?php echo $l['cd_conexao']; ?>"
                                            nome="<?php echo $l['nm_conexao']; ?>"
                                            cargo="<?php echo $l['cargo_usuario']; ?>"
                                            codigo="<?php echo $l['codigo_conexao']; ?>"
                                            data="<?php echo $l['dt_entrada']; ?>">
                                            <i class="botoes bi bi-pencil-fill"></i>
                                        </button>
                                        <?php } ?>
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



        <?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/Reso/footer.php';
?>
</body>

<?php
 if(!empty($_POST)){
    if($_POST['action'] == "Criar"){
        CriarConexao(
            $_POST['nome'],
            $_SESSION['id'],
            "index.php"
        );
    }else if($_POST['action']== "Deletar"){
        DeletarConexao(
            $_POST['cd'],
            "index.php"
        );
    }else if($_POST['action']=="Sair"){
        SairConexao(
            $_SESSION['id'],
            $_POST['cd'],
            "index.php"
        );
    }else if($_POST['action']== "Entrar"){
        EntrarConexao(
            $_SESSION['id'],
            $_POST['code'],
            "index.php"
        );
    }else if($_POST['action']=="Acessar"){
        $_SESSION['conexao']=$_POST['cd'];
        $_SESSION['nm_conexao']=$_POST['nome'];
        $_SESSION['cargo']=$_POST['cargo'];
        if($_POST['cargo']!="comum"){
            ?>
<script>
location.href = "../painel/index.php";
</script>
<?php
        }else if($_POST['cargo']=="comum"){
            ?>
<script>
location.href = "../comum/index.php";
</script>
<?php
        }
    }else if($_POST['action']=="Editar"){
        EditarConexao(
            $_POST['cd'],
            $_POST['nome'],
            "index.php"
        );
    }
 }
?>