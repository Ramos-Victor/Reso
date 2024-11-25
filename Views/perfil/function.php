<?php
    function BuscarporId(){
        global $con;
        $sql = 'SELECT cd_usuario, nm_usuario, nm_email, nr_telefone, dt_nascimento,nm_real FROM tb_usuario WHERE cd_usuario = ?';
        
        $stmt = $con->prepare($sql);
        $stmt->bind_param('i',$_SESSION['id']);
        $stmt->execute();

        $result = $stmt->get_result();

        $resultado = [];
        while ($row = $result->fetch_assoc()) {
            $resultado[] = $row;
        }
    
        return $resultado;
    }

    function Editar($nome,$id,$pagina){
        global $con;
        $sql = 'SELECT * FROM tb_usuario where nm_usuario = ?';
        $stmt = $con->prepare($sql);
        $stmt->bind_param('s',$nome);
        $res1 = $stmt->execute();

        if($res1){
            Erro("Nome de Usuario ja em uso!!");
        }else{
            $stmt->close();

            $sql = 'UPDATE tb_usuario SET nm_usuario = ?, nr_telefone = ?, dt_nascimento = current_timestamp(), nm_real = ? WHERE cd_usuario = ?';

            $stmt = $con->prepare($sql);
            $stmt->bind_param('i',$id);
            $res2 = $stmt->execute();

            if($res2){
                Confirma("Usuario editado com sucesso!!",$pagina);
            }else{
                Erro("Não foi possivel editar suas informações!");
            }

        }

    }
?>