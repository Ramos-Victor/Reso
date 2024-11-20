<?php
require_once $_SERVER['DOCUMENT_ROOT']. '/Reso/conect.php';

function ListarEquipamentos($categoria = null, $sala = null) {
    $sql = 'SELECT 
                e.cd_equipamento, 
                e.nm_equipamento, 
                e.ds_equipamento, 
                DATE_FORMAT(e.dt_equipamento, "%d/%m/%Y") as dt_equipamento, 
                e.st_equipamento, 
                e.id_sala, 
                e.id_usuario,
                e.id_categoria, 
                u.nm_usuario, 
                c.categoria_nm, 
                s.nm_sala
            FROM tb_equipamento e
            LEFT JOIN tb_usuario u ON e.id_usuario = u.cd_usuario
            LEFT JOIN tb_equipamento_categoria c ON e.id_categoria = c.cd_categoria
            LEFT JOIN tb_sala s ON e.id_sala = s.cd_sala
            WHERE e.id_conexao = ?';

    $params = [$_SESSION['conexao']];
    $types = 'i';

    if ($categoria) {
        $sql .= ' AND e.id_categoria = ?';
        $params[] = $categoria;
        $types .= 'i';
    }
    if ($sala) {
        $sql .= ' AND e.id_sala = ?';
        $params[] = $sala;
        $types .= 'i';
    }

    $stmt = $GLOBALS['con']->prepare($sql);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res && $res->num_rows > 0) {
        return $res->fetch_all(MYSQLI_ASSOC);
    } else {
        return []; 
    }
}

function CriarEquipamento($nome, $desc, $categoria, $usuario, $conexao, $pagina) {
    $sqlSala = 'SELECT cd_sala FROM tb_sala WHERE nm_sala = "ESTOQUE" LIMIT 1';
    $stmtSala = $GLOBALS['con']->prepare($sqlSala);
    $stmtSala->execute();
    $resultado = $stmtSala->get_result();

    if ($resultado->num_rows === 0) {
        Erro("A sala 'ESTOQUE' não existe. Crie a sala estoque antes de adicionar equipamentos.");
        return;
    }

    $salaEstoque = $resultado->fetch_assoc();
    $idSalaEstoque = $salaEstoque['cd_sala'];

    $sql = 'INSERT INTO tb_equipamento (nm_equipamento, ds_equipamento, id_sala, id_categoria, id_usuario, id_conexao)
            VALUES (?, ?, ?, ?, ?, ?)';
    
    $stmt = $GLOBALS['con']->prepare($sql);
    $stmt->bind_param('ssiiii', $nome, $desc, $idSalaEstoque, $categoria, $usuario, $conexao);

    $res = $stmt->execute();

    if ($res) {
        Confirma("Equipamento criado com sucesso na sala 'ESTOQUE'!", $pagina);
    } else {
        Erro("Não foi possível criar o Equipamento");
    }
}


function EditarEquipamento($cd_equipamento, $nome, $desc, $status, $sala, $categoria, $usuario, $conexao, $pagina) {
    $sql = 'UPDATE tb_equipamento SET nm_equipamento = ?, ds_equipamento = ?, st_equipamento = ?, id_sala = ?, id_categoria = ?, id_usuario = ?
            WHERE id_conexao = ? AND cd_equipamento = ?';

    $stmt = $GLOBALS['con']->prepare($sql);
    $stmt->bind_param('sssiiiii', $nome, $desc, $status, $sala, $categoria, $usuario, $conexao, $cd_equipamento);

    $res = $stmt->execute();

    if ($res) {
        Confirma("Equipamento editado com sucesso!", $pagina);
    } else {
        Erro("Não foi possível editar o Equipamento");
    }
}

function ExcluirEquipamento($cd_equipamento, $pagina) {
    $sqlVerifica = 'SELECT * FROM tb_chamado where id_equipamento = ?';
    $stmtVerifica = $GLOBALS['con']->prepare($sqlVerifica);

    if(!$stmtVerifica){
        Erro("Erro ao preparar consulta de vinculo".$GLOBALS['con']->error);
        return;
    }

    $stmtVerifica->bind_param('i',$cd_equipamento);
    $stmtVerifica->execute();

    $result = $stmtVerifica->get_result();

    if($result->num_rows > 0){
        $mensagem = "";
        while($row = $result->fetch_assoc()){
            $mensagem .= "<p class='text-warning'>Chamado: ".$row['nm_chamado']."</p>";
        }

        ConfirmaExclusaoEquipamento($mensagem,$pagina,$cd_equipamento);
        return;
    }
    $sql = 'DELETE FROM tb_equipamento WHERE cd_equipamento = ?';

    $stmt = $GLOBALS['con']->prepare($sql);
    
    if(!$stmt){
        Erro("Erro ao preparar a consulta de exclusão: " . $GLOBALS['con']->error);
            return;
    }

    $stmt->bind_param('i',$cd_equipamento);
    $res = $stmt->execute();

    if ($res) {
        Confirma("Equipamento deletado com sucesso!", $pagina."?");
    } else {
        Erro("Não foi possível deletar o Equipamento:" .$GLOBALS['con']->error);
    }
}

    if(isset($_GET['confirmacao']) && $_GET['confirmacao']==='true' && isset($_GET['cd_equipamento'])){
        $cd_equipamento = intval($_GET['cd_equipamento']);

        $sqlMoverChamados = 'UPDATE tb_chamado SET id_equipamento = NULL WHERE id_equipamento = ?';

        $stmtMover = $GLOBALS['con']->prepare($sqlMoverChamados);

        if(!$stmtMover){
            Erro("Erro ao preparar a consulta de atualização dos equipamentos: " . $GLOBALS['con']->error);
            return;
        }

        $stmtMover->bind_param('i',$cd_equipamento);
        $stmtMover->execute();

        ExcluirEquipamento($cd_equipamento,$pagina);
    }

    if(isset($_GET['msg'])&& $_GET['msg']==='equipamento_excluido'){
        Confirma("Equipamento removida com sucesso!", $pagina);
    }

    function ConfirmaExclusaoEquipamento($msg,$pagina,$cd_equipamento){
        print '
            <div class="modal fade" id="myModal" data-backdrop="static">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-body text-center font-weight-bolder text-danger">
                            <h3>Deseja realmente deletar este equipamento? Os seguintes chamados estão vinculados a ele: </h3>
                            <div class="overflow-auto">
                            <p>'. $msg.' </p>
                            </div>
                            <h5>Deseja mesmo deletar?</h5>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger" onclick="redirecionar()">Sim, deletar</button>
                            <button class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                function redirecionar(){
                    location.href = "' . $pagina . '?cd_equipamento=' . $cd_equipamento . '&confirmacao=true";
                }
            </script>
        ';
    }
?>