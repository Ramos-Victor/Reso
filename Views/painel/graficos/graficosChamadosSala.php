<?php
require_once 'conect.php';
global $con;
header('Content-Type: application/json');

$sql = 'SELECT 
            YEAR(c.dt_abertura) AS ano,
            MONTH(c.dt_abertura) AS mes,
            s.nm_sala AS sala,
            COUNT(c.cd_chamado) AS quantidade_chamados
        FROM 
            tb_sala s
        JOIN 
            tb_equipamento e ON e.id_sala = s.cd_sala
        INNER JOIN 
            tb_chamado c ON c.id_equipamento = e.cd_equipamento
        WHERE 
            c.st_ativo = 1 
            AND c.dt_abertura IS NOT NULL 
            AND c.id_unidade = "'.$_SESSION['unidade'].'"
        GROUP BY 
            ano, 
            mes, 
            sala
        ORDER BY 
            ano ASC, 
            mes ASC';

$result = $con->query($sql);
$dados = [];
$salas = [];

while ($row = $result->fetch_assoc()) {
    $key = $row['ano'] . '-' . str_pad($row['mes'], 2, '0', STR_PAD_LEFT);

    if (!isset($dados[$key])) {
        $dados[$key] = [
            'Ano' => $row['ano'],
            'Mes' => $row['mes'],
            'Salas' => [],
            'QtdChamados' => []
        ];
    }

    $dados[$key]['Salas'][] = $row['sala'];
    $dados[$key]['QtdChamados'][] = $row['quantidade_chamados'];
}

$dadosArray = array_values($dados);

echo json_encode($dadosArray);