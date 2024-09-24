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
                <i class="navicon bi bi-plus-circle "></i> Conexão
                </button>
            </div>
            <div class="col-sm-2">
                <button class="btn btn-block text-white" style="background-color:#03305c" data-toggle="modal" data-target="#entrarconexao">
                <i class="navicon bi bi-plus-circle "></i> Entrar Con
                </button>
            </div>
        </div>
        <div class="row">

        </div>
    </div>
</div>
<?php
    require_once '../footer.php';
?>
</body>