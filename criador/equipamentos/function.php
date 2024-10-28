<?php

function ListarEquipamentos() {
    $sql = 'SELECT 
            cd_equipamento, 
            nm_equipamento, 
            ds_equipamento, 
            DATE_FORMAT(dt_equipamento, "%d/%m/%Y") as dt_equipamento, 
            st_equipamento, 
            id_sala, 
            id_categoria, 
            nm_usuario, 
            categoria_nm, 
            nm_sala
            FROM tb_equipamento e
            INNER JOIN tb_usuario ON id_usuario = cd_usuario
            INNER JOIN tb_equipamento_categoria ON id_categoria = cd_categoria
            INNER JOIN tb_sala ON id_sala = cd_sala
            WHERE e.id_conexao = '.$_SESSION['conexao'];

    $res = $GLOBALS['con']->query($sql);

    if ($res->num_rows > 0) {
        return $res;
    } else {
        echo "<h3 class='mx-auto text-white'>Cadastre seus Equipamentos, eles serão exibidos aqui!</h3>";
    }
}

function CriarEquipamento($nome, $desc, $sala, $categoria, $usuario, $conexao, $pagina) {
    $sql = 'INSERT INTO tb_equipamento (nm_equipamento, ds_equipamento, id_sala, id_categoria, id_usuario, id_conexao)
            VALUES (?, ?, ?, ?, ?, ?)';

    $stmt = $GLOBALS['con']->prepare($sql);
    $stmt->bind_param('ssiiii', $nome, $desc, $sala, $categoria, $usuario, $conexao);

    $res = $stmt->execute();

    if ($res) {
        Confirma("Equipamento criado com sucesso!", $pagina);
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