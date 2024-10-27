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
        $sql = 'SELECT cd_usuario, nm_usuario, cd_categoria, categoria_nm, DATE_FORMAT(dt_categoria, "%d/%m/%Y") as dt_categoria, id_usuario, id_conexao 
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

    function EditarCategoria($id, $nome,$conexao, $pagina){
        $sql = 'UPDATE tb_equipamento_categoria set categoria_nm = ? where cd_categoria = ? and id_conexao = ?';

        $stmt = $GLOBALS['con']->prepare($sql);
        $stmt->bind_param('sii', $nome, $id, $conexao);

        $res = $stmt->execute();

        
        if($res){
            Confirma("Categoria editada com sucesso!",$pagina);
        }else{
            Erro("Não foi possivel editar a categoria");
        }
    }

    function DeletarCategoria($cd_catego,$pagina){
        $sql = 'DELETE FROM tb_equipamento_categoria WHERE cd_categoria = ? AND id_conexao = ?';

        $stmt = $GLOBALS['con']->prepare($sql);
        $stmt->bind_param('ii',$cd_catego,$_SESSION['conexao']);

        $res = $stmt->execute();

        if($res){
            Confirma("Categoria excluida com sucesso!",$pagina);
        }else{
            Erro("Não foi possivel excluir a categoria");
        }
       
    }


    