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
                    <div class="card shadow p-3 mb-5 bg-white rounded">
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
                                            <button class="btn btn-primary btn-sm editar"
                                            data-toggle="modal"
                                            data-target="#editar"
                                            title="editar"
                                            cd="<?php echo $l['id_usuario']; ?>"
                                            nome="<?php echo $l['nm_usuario']; ?>"
                                            cargo="<?php echo $l['cargo_usuario']; ?>"
                                            data="<?php echo $l['dt_entrada'];?>"
                                            >
                                                <i class="botoes bi bi-pencil-fill"></i>
                                            </button>
                                            <button class="btn btn-danger btn-sm deletar"
                                            data-toggle="modal"
                                            data-target="#deletar"
                                            title="deletar"
                                            cd="<?php echo $l['id_usuario']; ?>"
                                            nome="<?php echo $l['nm_usuario']; ?>"
                                            cargo="<?php echo $l['cargo_usuario']; ?>"
                                            data="<?php echo $l['dt_entrada'];?>"
                                            >
                                            <i class="botoes bi bi-trash-fill"></i>
                                            </button>
                                         
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
        if($_POST['action']=="Editar"){
            EditarUsuario(
                $_POST['cd'],
                $_POST['cargo'],
                $_SESSION['conexao'],
                "usuarios.php"
            );
        }elseif($_POST['action']=="Deletar"){
            ExcluirUsuario(
                $_POST['cd'],
                $_SESSION['conexao'],
                "usuarios.php"
            );
        }
    }
?>