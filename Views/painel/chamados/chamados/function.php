<?php

require_once 'conect.php';

function AbrirChamado($nm_chamado, $ds_chamado, $id_equipamento, $id_usuario_abertura, $id_unidade, $pagina) {
    $sql = 'INSERT INTO tb_chamado (nm_chamado, ds_chamado, st_chamado, id_equipamento, id_usuario_abertura, id_unidade)
            VALUES (?, ?, 1, ?, ?, ?)';

    $stmt = $GLOBALS['con']->prepare($sql);
    $stmt->bind_param('ssisi', $nm_chamado, $ds_chamado, $id_equipamento, $id_usuario_abertura, $id_unidade);

    $res = $stmt->execute();

    if ($res) {
        Confirma("Chamado aberto com sucesso!", $pagina);
    } else {
        Erro("Erro ao abrir o chamado!");
    }
}

function ListarChamados($status = null) {
    $sql = 'SELECT 
    c.cd_chamado, 
    c.nm_chamado, 
    c.ds_chamado, 
    c.dt_abertura as dt_abertura, 
    DATE_FORMAT(c.dt_fechamento, "%d/%m/%Y") as dt_fechamento, 
    s.nm_status as st_chamado, 
    c.ds_recado,
    c.nr_avaliacao,
    c.id_usuario_abertura AS id_abertura,
    c.id_usuario_fechamento AS id_fechamento,
    c.id_equipamento AS id_equipamento,
    e.nm_equipamento, 
    e.st_ativo as EquiAtivo,
    uu.st_ativo as UsuAtivo,
    u.nm_usuario AS usuario_abertura,
    uf.nm_usuario AS usuario_fechamento
FROM 
    tb_chamado c
INNER JOIN tb_st_chamado s ON c.st_chamado = s.cd_st_chamado
INNER JOIN tb_usuario_unidade uu ON c.id_unidade = uu.id_unidade AND c.id_usuario_abertura = uu.id_usuario
LEFT JOIN 
    tb_equipamento e ON c.id_equipamento = e.cd_equipamento
LEFT JOIN 
    tb_usuario u ON c.id_usuario_abertura = u.cd_usuario
LEFT JOIN 
    tb_usuario uf ON c.id_usuario_fechamento = uf.cd_usuario
WHERE
c.st_ativo = 1
AND c.id_unidade ="'.$_SESSION['unidade'].'" ';

    if ($status) {
        $sql .= 'AND c.st_chamado = ?';
    }

    $sql .= ' ORDER BY dt_abertura DESC';

    $stmt = $GLOBALS['con']->prepare($sql);

    if ($status) {
        $stmt->bind_param('s', $status);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $chamados = [];
    while ($row = $result->fetch_assoc()) {
        $chamados[] = $row;
    }
    
    return $chamados;
}



function ColocarEmAndamento($cd_chamado, $id_fechamento, $unidade, $pagina) {
    $sql = "UPDATE tb_chamado SET st_chamado = '2', dt_fechamento = current_timestamp(), id_usuario_fechamento = ? WHERE cd_chamado = ? AND id_unidade = ?";
    $stmt = $GLOBALS['con']->prepare($sql);
    $stmt->bind_param('sii', $id_fechamento, $cd_chamado, $unidade);
    $res = $stmt->execute();

    if ($res) {
        Confirma("Chamado em andamento!", $pagina);
    } else {
        Erro("Erro ao atualizar o status do chamado.");
    }
}

function ConcluirChamado($cd_chamado, $recado, $id_fechamento, $unidade, $pagina) {
    $sql = "UPDATE tb_chamado SET st_chamado = '3', ds_recado = ?, dt_fechamento = current_timestamp(), id_usuario_fechamento = ? WHERE cd_chamado = ? AND id_unidade = ?";
    $stmt = $GLOBALS['con']->prepare($sql);
    $stmt->bind_param('ssii', $recado, $id_fechamento, $cd_chamado, $unidade);
    $res = $stmt->execute();

    if ($res) {
        Confirma("Chamado concluído com sucesso!", $pagina);
    } else {
        Erro("Erro ao concluir o chamado.");
    }
}

function DeletarChamado($cd_chamado, $unidade, $pagina) {
    $sql = "UPDATE tb_chamado SET st_ativo=0 ,dt_exclusao = current_timestamp() WHERE cd_chamado = ? AND id_unidade = ?";
    $stmt = $GLOBALS['con']->prepare($sql);
    
    $stmt->bind_param('ii', $cd_chamado, $unidade);
    $res = $stmt->execute();

    if ($res) {
        Confirma("Chamado deletado com sucesso!", $pagina);
    } else {
        Erro("Erro ao deletar o chamado.");
    }
}

function Avaliar($cd_chamado,$nrAvaliacao,$pagina){
    global $con;
    $sql = 'UPDATE tb_chamado SET nr_avaliacao = ? where cd_chamado = ? AND id_unidade = ?';

    $stmt = $con->prepare($sql);
    $stmt->bind_param('sii',$nrAvaliacao,$cd_chamado, $_SESSION['unidade']);
    $res = $stmt->execute();

    if($res){
        Confirma("Chamado avaliado!",$pagina);
    }else{
        Erro("Não foi possivel avaliar o chamado!");
    }
}

function EditarChamado($cd_chamado,$titulo, $descricao,$equipamento, $unidade,$pagina){
    $sql = "UPDATE tb_chamado SET nm_chamado = ?, ds_chamado = ?, id_equipamento = ? WHERE cd_chamado = ? AND id_unidade = ?";
    $stmt = $GLOBALS['con']->prepare($sql);
    $stmt->bind_param('ssiii', $titulo, $descricao, $equipamento, $cd_chamado, $unidade);
    $res = $stmt->execute();

    if ($res) {
        Confirma("Chamado editado com sucesso!", $pagina);
    } else {
        Erro("Erro ao editar o chamado.");
    }
}