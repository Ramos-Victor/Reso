<?php
   require_once 'header.php';

    function CriarConexao($nome, $code, $criador, $pagina){
        $codi = $code.time().$nome;

        $sql = 'insert into tb_conexao
         (nm_conexao,codigo_conexao,id_criador) values
        ("'.$nome.'",sha2("'.$codi.'",256),"'.$criador.'")';

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
       $sql = 'select nm_conexao, codigo_conexao, dt_entrada, cd_conexao, cargo_usuario, id_criador from tb_conexao
        inner join tb_usuario_conexao on id_usuario = "'.$_SESSION['id'].'" where id_conexao = cd_conexao';

        $res = $GLOBALS['con']->query($sql);

        if($res->num_rows>0){
            return $res;
        }else{
            echo'<div class="ml-3"> Sem conexões nesse momento. </div>';
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

    function EntrarConexao($usuario,$code){
        $sql = 'select cd_conexao from tb_conexao where codigo_conexao="'.$code.'"';

        $res = $GLOBALS['con']->query($sql);
        $res=$res->fetch_assoc();
        
        $sql1 = 'insert into tb_usuario_conexao (id_usuario,id_conexao,cargo_usuario) values
                ("'.$usuario.'","'.$res['cd_conexao'].'","comum")';

        $res2 = $GLOBALS['con']->query($sql1);

        if($res2){
            Confirma("Conexão adicionada", $pagina);
        }else{
            Erro("Não foi possivel adicionar conexão :(");
        }
        
    }

    
?>