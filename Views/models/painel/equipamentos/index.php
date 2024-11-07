<?php


require_once '../header.php';
require_once './equipamentos/function.php';
require_once './equipamentos/modal.php';
require_once './equipamentos/script.php';

?>

<style>
.botoes {
    font-size: 20px;
}
</style>

<body>
    <?php
        require_once '../nav.php';
    ?>
    <br><br><br><br>
    <div class="container-fluid">
        <div class="row">
            <?php $filtro = ListarEquipamentos(); if(!empty($filtro)):?>
            <div class="col-sm-2 col-xs-2">
                <button class="btn btn-block" style="background-color:#03305c;" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false" id="filterDropdownButton">
                    <a class="text-white mx-auto">
                        FILTROS
                    </a>
                </button>
                <div class="dropdown-menu" aria-labelledby="filterDropdownButton" id="filterDropdown">
                    <form method="GET" action="" class="p-3" id="filterForm">
                        <h6 class="dropdown-header">Filtrar Equipamentos</h6>
                        <div class="form-group">
                            <label for="categoria">Categoria</label>
                            <select name="categoria" id="categoria" class="form-control fixed-select" style="min-width: 200px;">
                                <option value="">Selecione uma Categoria</option>
                                <?php
                    $categorias = ListarCategorias("Nenhuma categoria encontrada.");
                    while ($row = $categorias->fetch_assoc()) {
                        echo "<option value='{$row['cd_categoria']}'>{$row['categoria_nm']}</option>";
                    }
                    ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sala">Sala</label>
                            <select name="sala" id="sala" class="form-control fixed-select" style="min-width: 200px;">
                                <option value="">Selecione uma Sala</option>
                                <?php
                    $salas = ListarSalas();

                    if ($salas) {
                        foreach ($salas as $index => $l) {
                    ?>
                                <option value="<?= $l['cd_sala'] ?>"><?= $l['nm_sala'] ?></option>
                                <?php
                        }
                    }
                    ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Filtrar</button>
                        <button type="button" class="btn btn-secondary" id="clearFilters">Limpar Filtros</button>
                    </form>
                </div>
            </div>
            <?php ELSE:
                echo '<div class="col-sm-2 col-xs-2"></div>';
                ENDIF;
            ?>
            <div class="col-sm-8">
            </div>
            <div class="col-sm-2 col-xs-2">
                <button class="btn btn-block d-flex flex-row" style="background-color:#03305c;" data-toggle="modal"
                    data-target="#addequipamento">
                    <a class="text-white mx-auto">
                        <i class="navicon bi bi-plus-circle"></i>
                        EQUIPAMENTOS
                    </a>
                </button>
            </div>
        </div>
        <div class="row mt-3">

            <?php
            $categoria = $_GET['categoria'] ?? null;
            $data = $_GET['data'] ?? null;
            $sala = $_GET['sala'] ?? null;
            
            $listar = ListarEquipamentos($categoria, $data, $sala);

    if ($listar && count($listar)>0) {
        foreach ($listar as $index => $l) {
    ?>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card border-0"
                    style="background-color: #0a4a8a; color: white; border-radius: 10px; background: linear-gradient(135deg, #0a4a8a, #03305c);">
                    <div class="card-body">
                        <h5 class="card-title"><?= $l['nm_equipamento'] ?></h5>
                        <h6 class="card-subtitle mb-2"><?= $l['ds_equipamento'] ?></h6>
                        <span class="badge bg-secondary"><?= $l['categoria_nm'] ?></span>
                        <p class="mt-2"><strong>Localização:</strong> <?= $l['nm_sala'] ?></p>
                        <p><strong>Por:</strong> <?= $l['nm_usuario'] ?></p>
                        <p><strong>Registrado em:</strong> <?= $l['dt_equipamento'] ?></p>
                        <?php
            $badgeClass = '';
            switch ($l['st_equipamento']) {
                case 'Ativo':
                    $badgeClass = 'bg-success';
                    break;
                case 'Manuntencao':
                    $badgeClass = 'bg-warning';
                    break;
                case 'Desativado':
                    $badgeClass = 'bg-secondary';
                    break;
            }
            ?>
                        <span class="badge <?= $badgeClass ?>">Status: <?= $l['st_equipamento'] ?></span>
                    </div>
                    <div class="card-footer bg-transparent text-center">
                        <button class="btn btn-danger btn-sm deletar" data-toggle="modal" data-target="#deletar"
                            cd="<?= $l['cd_equipamento']; ?>" nome="<?= $l['nm_equipamento']; ?>">
                            <i class="botoes bi bi-trash3-fill"></i> Deletar
                        </button>
                        <button class="btn btn-primary btn-sm editar" data-toggle="modal" data-target="#editar"
                            cd="<?= $l['cd_equipamento']; ?>" nome="<?= $l['nm_equipamento']; ?>"
                            desc="<?= $l['ds_equipamento']; ?>" sala="<?= $l['id_sala']; ?>"
                            categoria="<?= $l['id_categoria']; ?>" data="<?= $l['dt_equipamento']; ?>"
                            status="<?= $l['st_equipamento']; ?>">
                            <i class="botoes bi bi-pencil-fill"></i> Editar
                        </button>
                    </div>
                </div>
            </div>
            <?php
        }
    }else {
        echo "<div class='col-12 text-center text-muted my-3'><h5>Nenhum equipamento encontrado.</h5></div>";
    }
    ?>
        </div>
</body>
<?php
if (!empty($_POST)) {
    if ($_POST['action'] == "Criar") {
        $id_categoria = !empty($_POST['categoria']) ? intval($_POST['categoria']) : null;
        CriarEquipamento(
            strtoupper($_POST['nome']), 
            $_POST['desc'], 
            $id_categoria,
            $_SESSION['id'], 
            $_SESSION['conexao'], 
            "index.php");
    } elseif ($_POST['action'] == "Editar") {
        EditarEquipamento(
            $_POST['cd'], 
            $_POST['nome'], 
            $_POST['desc'], 
            $_POST['status'], 
            $_POST['sala'], 
            $_POST['categoria'], 
            $_SESSION['id'], 
            $_SESSION['conexao'], 
            "index.php");
    } elseif ($_POST['action'] == "Deletar") {
        ExcluirEquipamento(
            $_POST['cd'], 
            "index.php");
    }
}
?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dropdownButton = document.getElementById('filterDropdownButton');
    const filterDropdown = document.getElementById('filterDropdown');

    filterDropdown.addEventListener('click', function(event) {
        event.stopPropagation();
    });

    document.getElementById('filterForm').addEventListener('submit', function(event) {
        $(filterDropdown).removeClass('show');
        $('.dropdown-menu').removeClass('show');
    });
});

document.getElementById('clearFilters').addEventListener('click', function() {
    document.getElementById('filterForm').reset();
    window.location.href = window.location.pathname;
});
</script>