<?php
function ListarUsuarios()
{
    $sql = 'SELECT cd_usuario, nm_usuario, nm_email, DATE_FORMAT(dt_entrada, "%d/%m/%Y") as dt_entrada, cargo_usuario, id_usuario 
            FROM tb_usuario 
            INNER JOIN tb_usuario_conexao 
            ON id_usuario = cd_usuario
            WHERE id_conexao =' . $_SESSION['conexao'];

    $res = $GLOBALS['con']->query($sql);

    if ($res->num_rows > 0) {
        return $res;
    } else {
        echo "<h3 class='mx-auto text-white mt-3'>Sem usuarios na sua conexão!</h3>";
    }
}


function EditarUsuario($id, $cargo, $conexao, $pagina)
{
    $sql = 'update tb_usuario_conexao set cargo_usuario = ? where id_usuario = ? and id_conexao = ?';

    $stmt = $GLOBALS['con']->prepare($sql);
    $stmt->bind_param('sii', $cargo, $id, $conexao); 

    $res = $stmt->execute();

    if ($res) {
        Confirma("Editado com sucesso!", $pagina);
    } else {
        Erro("Não foi possível editar");
    }
}

function ExcluirUsuario($id, $conexao, $pagina){
    $sql = 'delete from tb_usuario_conexao where id_usuario = ? and id_conexao = ?';

    $stmt = $GLOBALS['con']->prepare($sql);
    $stmt->bind_param('ii',$id,$conexao);

    $res = $stmt->execute();

    if ($res) {
        Confirma("Deletado com sucesso!", $pagina);
    } else {
        Erro("Não foi possível excluir");
    }
}