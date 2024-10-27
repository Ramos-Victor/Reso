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

    .table td {
    border-top: none;
    }

    thead {
        border-bottom: 1px solid;
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
                    <h1>Usuarios Conectados</h1>
                </div>
            </div>
            <div class="row">
                <?php
                    $listar =ListarUsuarios();
                    if($listar){
                        foreach($listar as $index => $l){
                    
                ?>
                <div class="col-sm-4">
                    <div class="card shadow p-3 mb-5 rounded" style="<?php if ($index % 2 == 0) { echo "background-color:#03305c;"; } else { echo "background-color:#0a4a8a;"; } ?>">
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