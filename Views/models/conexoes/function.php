<?php

function CriarConexao($nome, $criador, $pagina) {
    // Gera o código único para a conexão
    $codi = time() . $nome;
    $GLOBALS['con']->begin_transaction(); // Inicia a transação

    try {
        // Insere a nova conexão
        $sql = 'INSERT INTO tb_conexao (nm_conexao, codigo_conexao, id_criador) VALUES (?, SHA2(?, 256), ?)';
        $stmt = $GLOBALS['con']->prepare($sql);
        $stmt->bind_param('sss', $nome, $codi, $criador);
        
        if (!$stmt->execute()) {
            throw new Exception("Erro ao criar a conexão.");
        }

        $last_id = $GLOBALS['con']->insert_id; // ID da nova conexão

        // Insere o usuário como criador da conexão
        $cargo = 'criador';
        $sqlUsuario = 'INSERT INTO tb_usuario_conexao (id_usuario, id_conexao, cargo_usuario) VALUES (?, ?, ?)';
        $stmtUsuario = $GLOBALS['con']->prepare($sqlUsuario);
        $stmtUsuario->bind_param('sss', $criador, $last_id, $cargo);
        
        if (!$stmtUsuario->execute()) {
            throw new Exception("Erro ao associar o criador à conexão.");
        }

        // Criação da sala "estoque" na nova conexão
        $nomeSala = "ESTOQUE";
        $descSala = "Sala para guardar os equipamentos.";
        $sqlSala = 'INSERT INTO tb_sala (nm_sala, ds_sala, id_usuario, id_conexao) VALUES (?, ?, ?, ?)';
        $stmtSala = $GLOBALS['con']->prepare($sqlSala);
        $stmtSala->bind_param('ssii', $nomeSala, $descSala, $criador, $last_id);
        
        if (!$stmtSala->execute()) {
            throw new Exception("Erro ao criar a sala 'estoque'.");
        }

        // Confirma a transação se todas as operações foram bem-sucedidas
        $GLOBALS['con']->commit();
        Confirma("Conexão criada com sucesso!", $pagina);

    } catch (Exception $e) {
        // Em caso de erro, desfaz todas as operações da transação
        $GLOBALS['con']->rollback();
        Erro($e->getMessage());
    }
}


    function ListarConexao(){
       $sql = 'select nm_conexao, codigo_conexao, DATE_FORMAT(dt_entrada, "%d/%m/%Y") as dt_entrada, cd_conexao, cargo_usuario, id_criador from tb_conexao
        inner join tb_usuario_conexao on id_usuario = "'.$_SESSION['id'].'" where id_conexao = cd_conexao';

        $res = $GLOBALS['con']->query($sql);

        if($res->num_rows>0){
            return $res;
        }else{
            echo'<h2 class="text-white mx-auto mt-3"> Você não tem conexões. </h2>';
        }
    }

    function DeletarConexao($cd, $pagina) {
        $GLOBALS['con']->begin_transaction(); // Inicia a transação
    
        try {
            // Exclui os registros de tb_equipamento vinculados à conexão (caso exista essa relação)
            $sqlEquipamento = 'DELETE FROM tb_equipamento WHERE id_conexao = ?';
            $stmtEquipamento = $GLOBALS['con']->prepare($sqlEquipamento);
            $stmtEquipamento->bind_param('i', $cd);
    
            if (!$stmtEquipamento->execute()) {
                throw new Exception("Erro ao excluir os equipamentos vinculados à conexão.");
            }
    
            // Exclui os registros de tb_sala que fazem referência à conexão
            $sqlSala = 'DELETE FROM tb_sala WHERE id_conexao = ?';
            $stmtSala = $GLOBALS['con']->prepare($sqlSala);
            $stmtSala->bind_param('i', $cd);
    
            if (!$stmtSala->execute()) {
                throw new Exception("Erro ao excluir as salas vinculadas à conexão.");
            }
    
            // Exclui os registros de tb_usuario_conexao vinculados à conexão
            $sqlUsuarioConexao = 'DELETE FROM tb_usuario_conexao WHERE id_conexao = ?';
            $stmtUsuarioConexao = $GLOBALS['con']->prepare($sqlUsuarioConexao);
            $stmtUsuarioConexao->bind_param('i', $cd);
    
            if (!$stmtUsuarioConexao->execute()) {
                throw new Exception("Erro ao excluir os usuários vinculados à conexão.");
            }
    
            // Exclui a própria conexão de tb_conexao
            $sqlConexao = 'DELETE FROM tb_conexao WHERE cd_conexao = ?';
            $stmtConexao = $GLOBALS['con']->prepare($sqlConexao);
            $stmtConexao->bind_param('i', $cd);
    
            if (!$stmtConexao->execute()) {
                throw new Exception("Erro ao excluir a conexão.");
            }
    
            // Confirma a transação se todas as exclusões foram bem-sucedidas
            $GLOBALS['con']->commit();
            Confirma("Conexão e todos os registros relacionados foram excluídos com sucesso!", $pagina);
    
        } catch (Exception $e) {
            // Em caso de erro, desfaz todas as operações da transação
            $GLOBALS['con']->rollback();
            Erro($e->getMessage());
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