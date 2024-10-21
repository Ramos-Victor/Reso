<?php

    function CriarCategoria($nomecat,$id,$conexao,$pagina){
        $sql = 'INSERT INTO tb_equipamento_categoria (categoria_nm, id_usuario, id_conexao) VALUES 
                (?,?,?)';

        $stmt = $GLOBALS['con']->prepare($sql);
        $stmt->bind_param('sss',$nomecat,$id,$conexao);

        $res = $stmt->execute();

        if($res){
            Confirma("Categoria criada com sucesso!",$pagina);
        }else{
            Erro("Não foi possivel criar a categoria");
        }
    }

    function ListarCategorias(){
        $sql = 'select * from tb_equipamento_categoria where id_conexao ='.$_SESSION['conexao'];

        $res=$GLOBALS['con']->query($sql);

        if($res->num_rows >0){
            return $res;
        }else{
            echo "Sem categorias";
        }
    }