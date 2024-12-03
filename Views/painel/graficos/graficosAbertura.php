<?php
require_once 'conect.php';
global $con;
header('Content-Type: application/json');

$sql = 'SELECT 
    YEAR(c.dt_abertura) AS ano,
    MONTH(c.dt_abertura) AS mes,
    id_usuario_abertura,
    nm_usuario,
    COUNT(*) AS qtd_chamados
FROM 
    tb_chamado c
JOIN 
    tb_usuario u ON c.id_usuario_abertura = u.cd_usuario
WHERE 
    c.dt_abertura IS NOT NULL 
    AND c.st_ativo = 1 
    AND c.id_unidade = "'.$_SESSION['unidade'].'"
GROUP BY 
    ano, 
    mes, 
    id_usuario_abertura, 
    nm_usuario
ORDER BY 
    ano ASC, 
    mes ASC, 
    qtd_chamados ASC
LIMIT 18';

$result = $con->query($sql);

$dados = [];

while ($row = $result->fetch_assoc()) {
    $key = $row['ano'] . '-' . str_pad($row['mes'], 2, '0', STR_PAD_LEFT);

    if (!isset($dados[$key])) {
        $dados[$key] = [
            'Ano' => $row['ano'],
            'Mes' => $row['mes'],
            'Usuarios' => [],
            'QtdChamados' => []
        ];
    }

    $dados[$key]['Usuarios'][] = $row['nm_usuario'];
    $dados[$key]['QtdChamados'][] = $row['qtd_chamados'];
}

$dadosArray = array_values($dados);

echo json_encode($dadosArray ?: []);
