<?php
require_once 'conect.php';
global $con;
header('Content-Type: application/json');
$sql = 'SELECT 
                id_usuario_fechamento, 
                nm_usuario,
                COUNT(*) AS qtd_chamados
            FROM 
                tb_chamado c
            JOIN 
                tb_usuario u ON c.id_usuario_fechamento = u.cd_usuario
            WHERE 
                c.dt_fechamento IS NOT NULL AND c.id_unidade = "'.$_SESSION['unidade'].'"  AND c.st_ativo = 1 
            GROUP BY 
                id_usuario_fechamento, 
                nm_usuario
            ORDER BY 
                qtd_chamados DESC';

    $result = $con->query($sql);
    $dados = [
        'usuarios' => [],
        'qtdChamados' => []
    ];

    while ($row = $result->fetch_assoc()) {
        $dados['usuarios'][] = $row['nm_usuario'];
        $dados['qtdChamados'][] = $row['qtd_chamados'];
    }

    
echo json_encode($dados);