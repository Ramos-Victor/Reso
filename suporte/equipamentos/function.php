<?php

function ListarEquipamentos() {
    $sql = 'SELECT 
                e.cd_equipamento, 
                e.nm_equipamento, 
                e.ds_equipamento, 
                DATE_FORMAT(e.dt_equipamento, "%d/%m/%Y") as dt_equipamento, 
                e.st_equipamento, 
                e.id_sala, 
                e.id_categoria, 
                u.nm_usuario, 
                c.categoria_nm, 
                s.nm_sala
            FROM tb_equipamento e
            LEFT JOIN tb_usuario u ON e.id_usuario = u.cd_usuario
            LEFT JOIN tb_equipamento_categoria c ON e.id_categoria = c.cd_categoria
            LEFT JOIN tb_sala s ON e.id_sala = s.cd_sala
            WHERE e.id_conexao = ?';

    $stmt = $GLOBALS['con']->prepare($sql);
    $stmt->bind_param('i', $_SESSION['conexao']);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res && $res->num_rows > 0) {
        return $res->fetch_all(MYSQLI_ASSOC);
    } else {
        echo "<h3 class='mx-auto text-white'>Cadastre seus Equipamentos, eles serão exibidos aqui!</h3>";
        return []; 
    }
}

function CriarEquipamento($nome, $desc, $categoria, $usuario, $conexao, $pagina) {
    // Primeiro, obter o ID da sala "ESTOQUE"
    $sqlSala = 'SELECT cd_sala FROM tb_sala WHERE nm_sala = "ESTOQUE" LIMIT 1';
    $stmtSala = $GLOBALS['con']->prepare($sqlSala);
    $stmtSala->execute();
    $resultado = $stmtSala->get_result();

    if ($resultado->num_rows === 0) {
        // Se a sala "ESTOQUE" não existir, retorne um erro
        Erro("A sala 'ESTOQUE' não existe. Crie a sala antes de adicionar equipamentos.");
        return;
    }

    // Recupera o ID da sala "ESTOQUE"
    $salaEstoque = $resultado->fetch_assoc();
    $idSalaEstoque = $salaEstoque['cd_sala'];

    // Agora, insira o equipamento na sala "ESTOQUE"
    $sql = 'INSERT INTO tb_equipamento (nm_equipamento, ds_equipamento, id_sala, id_categoria, id_usuario, id_conexao)
            VALUES (?, ?, ?, ?, ?, ?)';
    
    $stmt = $GLOBALS['con']->prepare($sql);
    $stmt->bind_param('ssiiii', $nome, $desc, $idSalaEstoque, $categoria, $usuario, $conexao);

    $res = $stmt->execute();

    if ($res) {
        Confirma("Equipamento criado com sucesso na sala 'ESTOQUE'!", $pagina);
    } else {
        Erro("Não foi possível criar o Equipamento");
    }
}


function EditarEquipamento($cd_equipamento, $nome, $desc, $status, $sala, $categoria, $usuario, $conexao, $pagina) {
    $sql = 'UPDATE tb_equipamento SET nm_equipamento = ?, ds_equipamento = ?, st_equipamento = ?, id_sala = ?, id_categoria = ?, id_usuario = ?
            WHERE id_conexao = ? AND cd_equipamento = ?';

    $stmt = $GLOBALS['con']->prepare($sql);
    $stmt->bind_param('sssiiiii', $nome, $desc, $status, $sala, $categoria, $usuario, $conexao, $cd_equipamento);

    $res = $stmt->execute();

    if ($res) {
        Confirma("Equipamento editado com sucesso!", $pagina);
    } else {
        Erro("Não foi possível editar o Equipamento");
    }
}

function ExcluirEquipamento($cd_equipamento, $conexao, $pagina) {
    $sql = 'DELETE FROM tb_equipamento WHERE cd_equipamento = ? AND id_conexao = ?';

    $stmt = $GLOBALS['con']->prepare($sql);
    $stmt->bind_param('ii', $cd_equipamento, $conexao);

    $res = $stmt->execute();

    if ($res) {
        Confirma("Equipamento deletado com sucesso!", $pagina);
    } else {
        Erro("Não foi possível deletar o Equipamento");
    }
}
?>