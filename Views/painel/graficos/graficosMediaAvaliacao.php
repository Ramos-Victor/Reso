<?php 
require_once 'conect.php';
global $con;
header('Content-Type: application/json');

$sql = 'SELECT 
            YEAR(c.dt_fechamento) AS ano,
            MONTH(c.dt_fechamento) AS mes,
            u.nm_usuario AS usuario,
            AVG(CAST(c.nr_avaliacao AS DECIMAL(5,2))) AS mediaAVA
        FROM 
            tb_chamado c
        JOIN 
            tb_usuario u ON c.id_usuario_fechamento = u.cd_usuario
        WHERE 
            c.nr_avaliacao IS NOT NULL 
            AND c.st_chamado = 3 
            AND c.st_ativo = 1 
            AND c.id_unidade = "'.$_SESSION['unidade'].'"
        GROUP BY 
            ano, 
            mes, 
            u.nm_usuario
        ORDER BY 
            ano ASC, 
            mes ASC';

$result = $con->query($sql);
$dados = [];

while ($row = $result->fetch_assoc()) {
    $key = $row['ano'] . '-' . str_pad($row['mes'], 2, '0', STR_PAD_LEFT);

    if (!isset($dados[$key])) {
        $dados[$key] = [
            'Ano' => $row['ano'],
            'Mes' => $row['mes'],
            'Usuarios' => [],
            'MediaAVA' => []
        ];
    }

    $dados[$key]['Usuarios'][] = $row['usuario'];
    $dados[$key]['MediaAVA'][] = $row['mediaAVA'];
}

$dadosArray = array_values($dados);
echo json_encode($dadosArray);