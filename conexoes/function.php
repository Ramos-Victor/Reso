<?php
   require_once 'header.php';

    function CriarConexao($nome, $code, $criador, $pagina){
        $sql = 'insert into tb_conexao
         (nm_conexao,codigo_conexao,id_criador) values
        ("'.$nome.'",sha2("'.$code.'",256),"'.$criador.'")';

        $res = $GLOBALS['con']->query($sql);

        $last_id =$GLOBALS['con']->insert_id;
        Conexao('criador',$criador,$last_id);

        if($res){
            Confirma("Conexão criada com sucesso", $pagina);
        }else{
            Erro("Não foi possivel criar a conexão");
        }
    }

    function Conexao($cargo, $usuario, $conexao){
        $sql= 'insert into tb_usuario_conexao 
        (id_usuario,id_conexao,cargo_usuario) values
        ("'.$usuario.'","'.$conexao.'","'.$cargo.'")';
        
        $res = $GLOBALS['con']->query($sql);

    }

    function ListarConexao(){
       $sql = 'select con.nm_conexao, con.codigo_conexao, usucon.cargo_usuario from tb_conexao as con
        inner join tb_usuario_conexao as usucon on usucon.id_usuario = "'.$_SESSION['id'].'" where usocon.id_conexao = con.cd_conexao';
    }
?>