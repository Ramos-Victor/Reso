<?php
    require_once 'header.php';
    require_once 'function.php';
    require_once 'modal.php';
    require_once 'script.php';
?>
<style>
    .bi{
        font-size:1rem; 
    }
</style>
<body>
<?php
    require_once 'nav.php';
?>
<div id="main-content">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-sm-12 text-center">
                <h2>Conexões</h2>
            </div>
        </div>
                
        <div class="row">
            <div class="col-sm-8"></div>
            <div class="col-sm-2">
                <button class="btn btn-block text-white" style="background-color:#03305c" data-toggle="modal" data-target="#addconexao">
                <i class="navicon bi bi-plus-circle "></i> Criar
                </button>
            </div>
            <div class="col-sm-2">
                <button class="btn btn-block text-white" style="background-color:#03305c" data-toggle="modal" data-target="#entrarconexao">
                <i class="navicon bi bi-plus-circle "></i> Conectar
                </button>
            </div>
        </div>
        <div class="row mt-3">
            <?php
            $listar = ListarConexao();
            if($listar){
                foreach($listar as $l){
            ?>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td scope="col">Nome da Conexão</td>
                                    <td scope="col">Cargo na conexão</td>
                                    <?php
                                        if($l['id_criador']==$_SESSION['id']){
                                            echo '<td scope="col">Data de criação</td>';
                                        }else{
                                            echo '<td scope="col">Data entrada</td>';
                                        }
                                    ?>
                                    <td scope="col">Botões</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row"><?php echo $l['nm_conexao']?></td>
                                    <td scope="row"><?php echo strtoupper($l['cargo_usuario'])?></td>
                                    <td scope="row"><?php echo $l['dt_entrada']?></td>
                                    <td scope="row btn-group">
                                        <button class="btn btn-success btn-sm ver"
                                        data-toggle="modal"
                                        data-target="#ver"
                                        title="ver"
                                        cd="<?php echo $l['cd_conexao']; ?>"
                                        nome="<?php echo $l['nm_conexao']; ?>"
                                        cargo="<?php echo $l['cargo_usuario']; ?>"
                                        codigo="<?php echo $l['codigo_conexao']; ?>"
                                        data="<?php echo $l['dt_entrada'];?>"
                                        >
                                            <i class="bi bi-eye-fill"></i>
                                        </button>
                                        <?php
                                            if($l['cargo_usuario']=="criador"){
                                        ?>
                                        <button class="btn btn-danger btn-sm deletar"
                                        data-toggle="modal"
                                        data-target="#deletar"
                                        title="deletar"
                                        cd="<?php echo $l['cd_conexao']; ?>"
                                        nome="<?php echo $l['nm_conexao']; ?>"
                                        cargo="<?php echo $l['cargo_usuario']; ?>"
                                        codigo="<?php echo $l['codigo_conexao']; ?>"
                                        data="<?php echo $l['dt_entrada'];?>"
                                        >
                                        <i class="bi bi-trash3-fill"></i>
                                        </button>
                                        <?php                                               
                                            }else{
                                        ?>
                                            <button class="btn btn-danger btn-sm sair"
                                        data-toggle="modal"
                                        data-target="#sair"
                                        title="sair"
                                        cd="<?php echo $l['cd_conexao']; ?>"
                                        nome="<?php echo $l['nm_conexao']; ?>"
                                        cargo="<?php echo $l['cargo_usuario']; ?>"
                                        codigo="<?php echo $l['codigo_conexao']; ?>"
                                        data="<?php echo $l['dt_entrada'];?>"
                                        >
                                        <i class="bi bi-box-arrow-right"></i>
                                        </button>
                                        <?php                                               
                                            }
                                        ?>
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
            $_POST['name'],
            $_POST['code'],
            $_SESSION['id'],
            "conexao.php"
        );
    }else if($_POST['action']== "Deletar"){
        DeletarConexao(
            $_POST['cd'],
            "conexao.php"
        );
    }else if($_POST['action']== "Entrar"){
        EntrarConexao(
            $_SESSION['id'],
            $_POST['code'],
            "conexao.php"
        );
    }
 }
?>