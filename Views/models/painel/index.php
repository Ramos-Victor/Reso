<?php
require_once 'header.php';

?>

<body>
    <?php
require_once 'nav.php';
?>
    <br><br><br><br>
    <div class="container-fluid" style='position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);'>
        <div class="row justify-content-center" id="card-container">
            <!--Listagem pelo ajax -->
        </div>
    </div>
    <?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/Reso/footer.php';
?>
</body>

<script>
function carregarCards() {
    $.ajax({
        url: 'listar_ajax.php',
        method: 'GET',
        success: function(data) {
            $('#card-container').html(data);
        },
        error: function() {
            console.error('Erro ao carregar os cards');
        }
    });
}

// Atualiza as salas a cada 10 segundos
setInterval(carregarCards, 5000);

// Carrega as sala na inicialização
$(document).ready(function() {
    carregarCards();
});
</script>