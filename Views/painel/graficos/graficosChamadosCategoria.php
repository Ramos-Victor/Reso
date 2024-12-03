<?php
require_once 'conect.php';
global $con;
header('Content-Type: application/json');

$sql =
'SELECT
    ec.categoria_nm AS Categoria,
    YEAR(c.dt_abertura) AS Ano,
    MONTH(c.dt_abertura) AS Mes,
    COUNT(c.cd_chamado) AS qtdChamados
FROM
    tb_equipamento_categoria ec
LEFT JOIN
    tb_equipamento e ON e.id_categoria = ec.cd_categoria
INNER JOIN
    tb_chamado c ON c.id_equipamento = e.cd_equipamento
WHERE
    c.dt_abertura IS NOT NULL
    AND c.st_ativo = 1 
    AND c.id_unidade = "'.$_SESSION['unidade'].'"
GROUP BY
    ec.cd_categoria,
    ec.categoria_nm,
    YEAR(c.dt_abertura),
    MONTH(c.dt_abertura)
ORDER BY
    Ano, 
    Mes, 
    qtdChamados DESC';

$result = $con->query($sql);
$dados = [];

while ($row = $result->fetch_assoc()) {
    $key = $row['Ano'] . '-' . str_pad($row['Mes'], 2, '0', STR_PAD_LEFT);
    
    if (!isset($dados[$key])) {
        $dados[$key] = [
            'Ano' => $row['Ano'],
            'Mes' => $row['Mes'],
            'Categorias' => [],
            'QtdChamados' => []
        ];
    }
    
    $dados[$key]['Categorias'][] = $row['Categoria'];
    $dados[$key]['QtdChamados'][] = $row['qtdChamados'];
}

$outputDados = [];
foreach ($dados as $periodo => $info) {
    $outputDados[] = [
        'Periodo' => $periodo,
        'Ano' => $info['Ano'],
        'Mes' => $info['Mes'],
        'Categorias' => $info['Categorias'],
        'QtdChamados' => $info['QtdChamados']
    ];
}

echo json_encode($outputDados ?: []);
