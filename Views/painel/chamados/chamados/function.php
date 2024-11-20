<?php

require_once $_SERVER['DOCUMENT_ROOT']. '/Reso/conect.php';

function AbrirChamado($nm_chamado, $ds_chamado, $id_equipamento, $id_usuario_abertura, $id_conexao, $pagina) {
    $sql = 'INSERT INTO tb_chamado (nm_chamado, ds_chamado, st_chamado, id_equipamento, id_usuario_abertura, id_conexao)
            VALUES (?, ?, "Aberto", ?, ?, ?)';

    $stmt = $GLOBALS['con']->prepare($sql);
    $stmt->bind_param('ssiii', $nm_chamado, $ds_chamado, $id_equipamento, $id_usuario_abertura, $id_conexao);

    $res = $stmt->execute();

    if ($res) {
        Confirma("Chamado aberto com sucesso!", $pagina);
    } else {
        Erro("Erro ao abrir o chamado");
    }
}

function ListarChamados($status = null) {
    $sql = 'SELECT 
    c.cd_chamado, 
    c.nm_chamado, 
    c.ds_chamado, 
    DATE_FORMAT(c.dt_abertura, "%d/%m/%Y") as dt_abertura, 
    DATE_FORMAT(c.dt_fechamento, "%d/%m/%Y") as dt_fechamento, 
    c.st_chamado, 
    c.ds_recado,
    c.id_usuario_abertura AS id_abertura,
    c.id_usuario_fechamento AS id_fechamento,
    c.id_equipamento AS id_equipamento,
    e.nm_equipamento, 
    u.nm_usuario AS usuario_abertura,
    uf.nm_usuario AS usuario_fechamento
FROM 
    tb_chamado c
LEFT JOIN 
    tb_equipamento e ON c.id_equipamento = e.cd_equipamento
LEFT JOIN 
    tb_usuario u ON c.id_usuario_abertura = u.cd_usuario
LEFT JOIN 
    tb_usuario uf ON c.id_usuario_fechamento = uf.cd_usuario
WHERE 
    c.id_conexao ="'.$_SESSION['conexao'].'"';

    if ($status) {
        $sql .= 'AND c.st_chamado = ?';
    }

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



function ColocarEmAndamento($cd_chamado, $id_fechamento, $conexao, $pagina) {
    $sql = "UPDATE tb_chamado SET st_chamado = 'Andamento', dt_fechamento = current_timestamp(), id_usuario_fechamento = ? WHERE cd_chamado = ? AND id_conexao = ?";
    $stmt = $GLOBALS['con']->prepare($sql);
    $stmt->bind_param('iii', $id_fechamento, $cd_chamado, $conexao);
    $res = $stmt->execute();

    if ($res) {
        Confirma("Chamado colocado em andamento com sucesso!", $pagina);
    } else {
        Erro("Erro ao atualizar o status do chamado.");
    }
}

function ConcluirChamado($cd_chamado, $recado, $id_fechamento, $conexao, $pagina) {
    $sql = "UPDATE tb_chamado SET st_chamado = 'Concluido', ds_recado = ?, dt_fechamento = current_timestamp(), id_usuario_fechamento = ? WHERE cd_chamado = ? AND id_conexao = ?";
    $stmt = $GLOBALS['con']->prepare($sql);
    $stmt->bind_param('siii', $recado, $id_fechamento, $cd_chamado, $conexao);
    $res = $stmt->execute();

    if ($res) {
        Confirma("Chamado concluído com sucesso!", $pagina);
    } else {
        Erro("Erro ao concluir o chamado.");
    }
}

function DeletarChamado($cd_chamado, $conexao, $pagina) {
    $sql = "DELETE FROM tb_chamado WHERE cd_chamado = ? AND id_conexao = ?";
    $stmt = $GLOBALS['con']->prepare($sql);
    
    $stmt->bind_param('ii', $cd_chamado, $conexao);
    $res = $stmt->execute();

    if ($res) {
        Confirma("Chamado deletado com sucesso!", $pagina);
    } else {
        Erro("Erro ao deletar o chamado.");
    }
}

function EditarChamado($cd_chamado,$titulo, $descricao,$equipamento, $conexao,$pagina){
    $sql = "UPDATE tb_chamado SET nm_chamado = ?, ds_chamado = ?, id_equipamento = ? WHERE cd_chamado = ? AND id_conexao = ?";
    $stmt = $GLOBALS['con']->prepare($sql);
    $stmt->bind_param('ssiii', $titulo, $descricao, $equipamento, $cd_chamado, $conexao);
    $res = $stmt->execute();

    if ($res) {
        Confirma("Chamado editado com sucesso!", $pagina);
    } else {
        Erro("Erro ao editar o chamado.");
    }
}