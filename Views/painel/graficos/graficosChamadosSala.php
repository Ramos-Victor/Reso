<?php
require_once 'conect.php';
global $con;
header('Content-Type: application/json');

$sql = 'SELECT 
    s.nm_sala as sala,
    COUNT(c.cd_chamado) AS quantidade_chamados
FROM 
    tb_sala s
JOIN 
    tb_equipamento e ON e.id_sala = s.cd_sala
JOIN 
    tb_chamado c ON c.id_equipamento = e.cd_equipamento
WHERE 
    c.st_ativo = 1 AND c.dt_abertura IS NOT NULL AND c.id_unidade = 2
GROUP BY 
    sala';

    $result = $con->query($sql);
    $dados = [
        'sala' => [],
        'quantidade_chamados' => []
    ];
    
    while ($row = $result->fetch_assoc()) {
        $dados['sala'][] = $row['sala'];
        $dados['quantidade_chamados'][] = $row['quantidade_chamados'];
    }
    
    
    echo json_encode($dados);