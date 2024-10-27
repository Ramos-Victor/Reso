<?php

    function ListarSalas(){
        $sql = 'SELECT  cd_usuario, nm_usuario, cd_sala, nm_sala, ds_sala, DATE_FORMAT(dt_sala, "%d/%m/%Y") as dt_sala, id_usuario, id_conexao FROM tb_sala INNER JOIN tb_usuario on id_usuario = cd_usuario and id_conexao ='.$_SESSION['conexao'];

        $res = $GLOBALS['con']->query($sql);
        
        if ($res->num_rows > 0) {
            return $res;
        } else {
            echo "<h3 class='mx-auto text-white'>Cadastre suas Salas, elas serão exibidas aqui!</h3>";
        }
    }

    function CriarSala($nome,$desc,$usuario,$conexao, $pagina){

        $sql = 'INSERT INTO tb_sala (nm_sala, ds_sala, id_usuario, id_conexao) VALUES
                (?,?,?,?)';

        $stmt = $GLOBALS['con']->prepare($sql);
        $stmt->bind_param('ssii',$nome,$desc,$usuario,$conexao);

        $res = $stmt->execute();
        
        if($res){
            Confirma("Sala criada com sucesso!",$pagina);
        }else{
            Erro("Não foi possivel criar a Sala");
        }
    }

    function EditarSala($cd_sala,$nome,$desc,$usuario,$conexao,$pagina){

        $sql = 'UPDATE tb_sala set nm_sala = ?, ds_sala = ?, id_usuario = ? where id_conexao = ? and cd_sala = ?';

        $stmt = $GLOBALS['con']->prepare($sql);
        $stmt->bind_param('ssiii',$nome,$desc,$usuario,$conexao,$cd_sala);

        $res = $stmt->execute();

        if($res){
            Confirma("Sala editada com sucesso!",$pagina);
        }else{
            Erro("Não foi possivel editar a Sala");
        }
    }

    function ExcluirSala($cd_sala,$conexao,$pagina){

        $sql = 'DELETE FROM tb_sala where cd_sala = ? and id_conexao = ?';

        $stmt = $GLOBALS['con']->prepare($sql);
        $stmt->bind_param('ii',$cd_sala,$conexao);

        $res = $stmt->execute();

        if($res){
            Confirma("Sala deletada com sucesso!",$pagina);
        }else{
            Erro("Não foi possivel deletar a Sala");
        }
    }