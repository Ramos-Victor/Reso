<?php
    function CriarConexao($nome, $code, $criador){
        $sql = 'insert into tb_conexao
         (nm_conexao,codigo_conexao,id_criador) values
        ("'.$nome.'",sha2("'.$code.'",256),"'.$criador.'")';

        $res = $GLOBALS['con']->query($sql);

        if($GLOBALS['con']->query($sql)==true){
        $last_id =$GLOBALS['con']->insert_id;
        Conexao('dono',$criador,$last_id);
        }

        if($res){
            Confirma("Conexão criada com sucesso", $pagina);
        }else{
            Erro("Não foi possivel criar a conexão");
        }
    }

    function Conexao($cargo, $usuario, $conexao){
        $sql= 'insert into tb_usuario_conexao 
        (id_usuario,id_unidade,cargo_usuario) values
        ("'.$usuario.'","'.$conexao.'","'.$cargo.'")';
        
        $res = $GLOBALS['con']->query($sql);

    }
?>