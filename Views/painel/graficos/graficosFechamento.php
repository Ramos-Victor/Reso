<?php
require_once 'conect.php';
global $con;
header('Content-Type: application/json');

$sql = 'SELECT 
    YEAR(c.dt_fechamento) AS ano,
    MONTH(c.dt_fechamento) AS mes,
    id_usuario_fechamento,
    nm_usuario,
    COUNT(*) AS qtd_chamados
FROM 
    tb_chamado c
JOIN 
    tb_usuario u ON c.id_usuario_fechamento = u.cd_usuario
WHERE 
    c.dt_fechamento IS NOT NULL 
    AND c.st_chamado = 3
    AND c.st_ativo = 1 
    AND c.id_unidade = "'.$_SESSION['unidade'].'"
GROUP BY 
    ano, 
    mes, 
    id_usuario_fechamento, 
    nm_usuario
ORDER BY 
    ano ASC, 
    mes ASC, 
    qtd_chamados ASC
LIMIT 18';

$result = $con->query($sql);

$dados = [];
$usuarios = [];

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

    if (!in_array($row['nm_usuario'], $usuarios)) {
        $usuarios[] = $row['nm_usuario'];
    }

    $dados[$key]['Usuarios'][] = $row['nm_usuario'];
    $dados[$key]['QtdChamados'][] = $row['qtd_chamados'];
}

$dadosArray = array_values($dados);

echo json_encode($dadosArray ?: []);