<?php 
session_start();
require_once 'function.php';

?>

<?php 
                $chamadosPorStatus = contarChamadosPorStatus();
                if (is_array($chamadosPorStatus)): 
                    $cores = [
                        'Aberto' => '#17a2b8',  // Azul para "info"
                        'Andamento' => '#ffc107',  // Amarelo para "warning"
                        'Concluido' => '#28a745',  // Verde para "success"
                    ];
                    foreach (['Aberto', 'Andamento', 'Concluido'] as $status):
                        $quantidade = $chamadosPorStatus[$status] ?? 0;
                        $cor = $cores[$status];
                    ?>
<div class="col-md-4 d-flex justify-content-center">
    <div class="card mb-3"
        style="width: 400px; height: 400px; border: 5px solid <?= $cor ?>; background-color: transparent; border-radius: 15px;">
        <div class="card-header text-center"
            style="font-size: 1.2rem; color: <?= $cor ?>; background-color: transparent; border-bottom: none;">
            <?= $status ?>
        </div>
        <div class="card-body d-flex flex-column justify-content-center align-items-center">
            <h5 class="card-title" style="font-size: 5rem; color: <?= $cor ?>;"><?= $quantidade ?></h5>
        </div>
    </div>
</div>
<?php endforeach; ?>
<?php else: ?>
<div class="alert alert-danger">
    <?= $chamadosPorStatus ?>
</div>
<?php endif; ?>