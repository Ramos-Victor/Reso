<?php 
require_once 'conect.php';
global $con;
header('Content-Type: application/json');
$sql = 'SELECT u.nm_usuario AS usuario, AVG(CAST(c.nr_avaliacao AS DECIMAL(5,2))) AS mediaAVA
FROM 
    tb_chamado c
JOIN 
    tb_usuario u ON c.id_usuario_fechamento = u.cd_usuario
WHERE 
    c.nr_avaliacao IS NOT NULL AND c.st_chamado = 3 AND c.id_unidade = "'.$_SESSION['unidade'].'"
GROUP BY 
    u.nm_usuario;';

    $result = $con->query($sql);
    $dados = [
        'usuario' => [],
        'mediaAVA' => []
    ];
    
    while ($row = $result->fetch_assoc()) {
        $dados['usuario'][] = $row['usuario'];
        $dados['mediaAVA'][] = $row['mediaAVA'];
    }
    
echo json_encode($dados);