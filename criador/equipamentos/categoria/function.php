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

    function ListarCategorias() {
        $sql = 'SELECT cd_usuario, nm_usuario, cd_categoria, categoria_nm, dt_categoria, id_usuario, id_conexao 
                FROM tb_equipamento_categoria 
                INNER JOIN tb_usuario 
                ON id_conexao = "' . $_SESSION['conexao'] . '" and cd_usuario = id_usuario';
    
        $res = $GLOBALS['con']->query($sql);
    
        if ($res->num_rows > 0) {
            return $res;
        } else {
            echo "<h3 class='mx-auto text-white'>Cadastre categorias, elas serão exibidas aqui!</h3>";
        }
    }
    