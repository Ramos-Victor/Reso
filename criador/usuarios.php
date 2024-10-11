<?php
require_once 'header.php';
require_once './usuarios/function.php';
require_once './usuarios/modal.php';
require_once './usuarios/script.php';
?>

<style>
    .botoes{
        font-size:1.5rem; 
    }

    @media(max-width: 1000px){
    }
</style>

<body>
    <?php
        require_once 'nav.php';
    ?>
    <div id="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h1>Usuarios Conectados</h1>
                </div>
            </div>
            <div class="row">
                <?php
                    $listar =ListarUsuarios();
                    if($listar){
                        foreach($listar as $l){
                    
                ?>
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td scope="col">Nome do Usuario</td>
                                        <td scope="col">Cargo na conexão</td>
                                        <td scope="col">Data de entrada</td>
                                        <td scope="col">Botões</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td scope="row"><?php echo $l['nm_usuario']?></td>
                                        <td scope="row"><?php echo strtoupper($l['cargo_usuario'])?></td>
                                        <td scope="row"><?php echo $l['dt_entrada']?></td>
                                        <td scope="row">
                                            <button class="btn btn-success btn-sm ver"
                                            data-toggle="modal"
                                            data-target="#ver"
                                            title="ver"
                                            cd="<?php echo $l['cd_conexao']; ?>"
                                            nome="<?php echo $l['nm_conexao']; ?>"
                                            cargo="<?php echo $l['cargo_usuario']; ?>"
                                            <?php
                                                if($l['cargo_usuario']=="comum" || $l['cargo_usuario']==    "suporte"){
                                            ?>
                                            codigo="Sem permissão para ver o código da conexão"
                                            <?php
                                                }else{
                                            ?>
                                            codigo="<?php echo $l['codigo_conexao']; ?>"
                                            <?php
                                                }
                                            ?>
                                            data="<?php echo $l['dt_entrada'];?>"
                                            >
                                                <i class="botoes bi bi-eye-fill"></i>
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
                                            <i class="botoes bi bi-trash3-fill"></i>
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
                                            <i class="botoes bi bi-box-arrow-right"></i>
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
</body>