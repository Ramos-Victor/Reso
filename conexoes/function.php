<?php
   require_once 'header.php';

   function CriarConexao($nome,$criador, $pagina) {
    $codi = time() . $nome;

    $sql = 'INSERT INTO tb_conexao (nm_conexao, codigo_conexao, id_criador) VALUES (?, SHA2(?, 256), ?)';
    $stmt = $GLOBALS['con']->prepare($sql);
    $stmt->bind_param('sss', $nome, $codi, $criador);

    $res = $stmt->execute();

    $last_id = $GLOBALS['con']->insert_id;

    if ($res) {

        $cargo = 'criador';
        $sqlUsuario = 'INSERT INTO tb_usuario_conexao (id_usuario, id_conexao, cargo_usuario) VALUES (?, ?, ?)';
        $stmtUsuario = $GLOBALS['con']->prepare($sqlUsuario);
        $stmtUsuario->bind_param('sss', $criador, $last_id, $cargo);
        $stmtUsuario->execute();

        Confirma("Conexão criada com sucesso", $pagina);
    } else {
        Erro("Não foi possível criar a conexão");
    }
}

    function ListarConexao(){
       $sql = 'select nm_conexao, codigo_conexao, dt_entrada, cd_conexao, cargo_usuario, id_criador from tb_conexao
        inner join tb_usuario_conexao on id_usuario = "'.$_SESSION['id'].'" where id_conexao = cd_conexao';

        $res = $GLOBALS['con']->query($sql);

        if($res->num_rows>0){
            return $res;
        }else{
            echo'<div class="ml-3"> Você não tem conexões. </div>';
        }
    }

    function DeletarConexao($cd,$pagina){
        $sql='delete from tb_usuario_conexao where id_conexao='.$cd;

        $sql2= 'delete from tb_conexao where cd_conexao='.$cd;

        $res = $GLOBALS['con']->query($sql);

        $res2 = $GLOBALS['con']->query($sql2);

        if($res && $res2){
            Confirma("Excluido com sucesso!!", $pagina);
        }else{
            Erro("Não foi possivel excluir a conexão");
        }
    }

    function SairConexao($usuario,$conexao,$pagina){
        $sql='delete from tb_usuario_conexao where id_usuario="'.$usuario.'" and id_conexao="'.$conexao.'"';

        $res = $GLOBALS['con']->query($sql);

        if($res){
            Confirma("Você saiu desta conexão", $pagina);
        }else{
            Erro("Não foi possivel sair da conexão");
        }
    }

    function EntrarConexao($usuario, $code, $pagina) {
        
        $conn = $GLOBALS['con'];

        $sql = 'SELECT cd_conexao FROM tb_conexao WHERE codigo_conexao = ?';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $code); 
        $stmt->execute();
        $res = $stmt->get_result()->fetch_assoc();
    
        if ($res) {
            $cd_conexao = $res['cd_conexao'];
    
            $sqlCheck = 'SELECT * FROM tb_usuario_conexao WHERE id_usuario = ? AND id_conexao = ?';
            $stmtCheck = $conn->prepare($sqlCheck);
            $stmtCheck->bind_param('ss', $usuario, $cd_conexao);
            $stmtCheck->execute();
            $resCheck = $stmtCheck->get_result();
    
            if ($resCheck->num_rows == 0) { 

                $sqlInsert = 'INSERT INTO tb_usuario_conexao (id_usuario, id_conexao, cargo_usuario) VALUES (?, ?, ?)';
                $stmtInsert = $conn->prepare($sqlInsert);
                $cargo_usuario = 'comum';
                $stmtInsert->bind_param('sss', $usuario, $cd_conexao, $cargo_usuario);
    
                if ($stmtInsert->execute()) {
                    Confirma("Conexão adicionada", $pagina);
                } else {
                    Erro("Não foi possível adicionar conexão :(");
                }
            } else {
                Erro("Conexão já existe.");
            }
        } else {
            Erro("Código de conexão inválido.");
        }
    }
    
    function EditarConexao($cd,$nome,$pagina){
        $sql = 'update tb_conexao set nm_conexao = ? where cd_conexao = ? ';

        $stmt = $GLOBALS['con']->prepare($sql);
        $stmt->bind_param('ss', $nome, $cd);

        $res = $stmt->execute();

        if($res){
            Confirma("Editado com sucesso!", $pagina);
        }else{
            Erro("Não foi possivel editar");
        }
    }
?>