<?php 
require_once 'conect.php';
global $con;
header('Content-Type: application/json');
$sql = 
'SELECT 
    ec.categoria_nm AS Categoria,
    COUNT(c.cd_chamado) AS qtdChamados
FROM 
    tb_equipamento_categoria ec
LEFT JOIN 
    tb_equipamento e ON e.id_categoria = ec.cd_categoria
INNER JOIN 
    tb_chamado c ON c.id_equipamento = e.cd_equipamento 
    AND c.dt_abertura IS NOT NULL  
    AND c.st_ativo = 1  AND c.id_unidade = "'.$_SESSION['unidade'].'"
GROUP BY 
    ec.cd_categoria, 
    ec.categoria_nm
ORDER BY 
    qtdChamados DESC';

$result = $con->query($sql);
$dados = [
    'Categoria' => [],
    'qtdChamados' => []
];

while ($row = $result->fetch_assoc()) {
    $dados['Categoria'][] = $row['Categoria'];
    $dados['qtdChamados'][] = $row['qtdChamados'];
}


echo json_encode($dados);