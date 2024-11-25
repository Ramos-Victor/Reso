<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Reso/Views/painel/header.php';

?>

<body>
    <?php
require_once 'nav.php';
?>
    <br><br><br><br>
    <div class="container-fluid" style='position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);'>
        <h2 class="text-center text-muted mb-5" style="font-size: 2rem; font-weight: bold;">Resumo Geral Chamados</h2>
        <div class="row justify-content-center" id="card-container">
           
        </div>
    </div>
    <?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/Reso/footer.php';
?>
</body>

<script>
function carregarCards() {
    $.ajax({
        url: '?route=/painelAjax',
        method: 'GET',
        success: function(data) {
            $('#card-container').html(data);
        },
        error: function() {
            console.error('Erro ao carregar os cards');
        }
    });
}


setInterval(carregarCards, 5000);


$(document).ready(function() {
    carregarCards();
});
</script>