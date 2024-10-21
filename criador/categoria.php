<?php
require_once 'header.php';
require_once './equipamentos/categoria/function.php';
require_once './equipamentos/categoria/modal.php';
require_once './equipamentos/categoria/script.php';

?>

<style>
    .btnequi{
        background-color: #03305c;
        color:white;
    }
    .btnequi:hover{
        background-color: #0a539c;
        color:white;
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
                    <h2>Categorias</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-10 col-xs-10"></div>
                <div class="col-sm-2 col-xs-2">
                    <button class="btn btn-block d-flex flex-row" style="background-color:#03305c;" data-toggle="modal"
                        data-target="#addcategoria">
                        <a class="mx-auto text-white">
                            <i class="navicon bi bi-plus-circle"></i>
                            Criar Categoria
                        </a>
                    </button>
                </div>
            </div>
            <div class="row">
                
            </div>
        </div>
    </div>
</body>