<?php
require_once 'header.php';
require_once './equipamentos/function.php';
require_once './equipamentos/modal.php';
require_once './equipamentos/script.php';

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
                    <h2>Equipamentos & Categorias</h2>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-sm-6 shadow p-3 mb-5 bg-white rounded">
                    <div class="row">
                        <div class="col-sm-8">
                            <h5>Categorias</h5>
                        </div>
                        <div class="col-sm-4">
                            <button class="btnequi btn btn-block" data-toggle="modal" data-target="#upload">
                            + Categoria
                            </button>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-6">
                            aaaaaaaaaaaaaa
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 shadow p-3 mb-5 bg-white rounded">
                    <div class="row">
                    <div class="col-sm-8">
                            <h5>Equipamentos</h5>
                        </div>
                        <div class="col-sm-4">
                            <button class="btnequi btn btn-block" data-toggle="modal" data-target="#upload">
                            + Equipamento
                            </button>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-6">
                            aaaaaaaaaaaaaa
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>