<?php

require_once $_SERVER['DOCUMENT_ROOT']. '/Reso/conect.php';


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

    function ExcluirSala($cd_sala, $conexao, $pagina) {
        $sqlVerificaVinculo = 'SELECT * FROM tb_equipamento WHERE id_sala = ?';
        $stmtVerifica = $GLOBALS['con']->prepare($sqlVerificaVinculo);
        $stmtVerifica->bind_param('i', $cd_sala);
        $stmtVerifica->execute();
        $result = $stmtVerifica->get_result();
    
        if ($result->num_rows > 0) {
            $mensagem = "Deseja realmente deletar essa sala? Os seguintes equipamentos estão vinculados a ela:<br>";
            while ($row = $result->fetch_assoc()) {
                $mensagem .= " Nome: " . $row['nm_equipamento'] . "<br>";
            }
            ConfirmaExclusaoSala($mensagem, $pagina, $cd_sala, $conexao);
            return;
        }
    
        $sql = 'DELETE FROM tb_sala WHERE cd_sala = ? AND id_conexao = ?';
        $stmt = $GLOBALS['con']->prepare($sql);
        $stmt->bind_param('ii', $cd_sala, $conexao);
    
        $res = $stmt->execute();
    
        if ($res) {
            header("Location: $pagina?msg=sala_excluida");
            exit();
        } else {
            Erro("Não foi possível deletar a Sala");
        }
    }
    
    if (isset($_GET['confirmacao']) && $_GET['confirmacao'] === 'true' && isset($_GET['cd_sala'])) {
        $cd_sala = intval($_GET['cd_sala']);
        $conexao = intval($_GET['conexao']);
    
        $sqlEstoque = 'SELECT cd_sala FROM tb_sala WHERE nm_sala = "ESTOQUE" LIMIT 1';
        $stmtEstoque = $GLOBALS['con']->prepare($sqlEstoque);
        $stmtEstoque->execute();
        $resultadoEstoque = $stmtEstoque->get_result();
        $salaEstoque = $resultadoEstoque->fetch_assoc();
    
        if ($salaEstoque) {
            $idEstoque = $salaEstoque['cd_sala'];
    
            $sqlMoverEquipamentos = 'UPDATE tb_equipamento SET id_sala = ? WHERE id_sala = ?';
            $stmtMover = $GLOBALS['con']->prepare($sqlMoverEquipamentos);
            $stmtMover->bind_param('ii', $idEstoque, $cd_sala);
            $stmtMover->execute();

            ExcluirSala($cd_sala, $conexao, $pagina);
        } else {
            Erro("Sala 'ESTOQUE' não encontrada.");
        }
    }

    if (isset($_GET['msg']) && $_GET['msg'] === 'sala_excluida') {
        Confirma("Sala removida com sucesso!", $pagina."?");
    }
    
    function ConfirmaExclusaoSala($msg, $pagina, $cd_sala, $conexao)
{
    print '
        <div class="modal fade" id="myModal" data-backdrop="static">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-body text-center font-weight-bolder text-danger">
                        <h3>' . $msg . '</h3>
                        <p>Há itens vinculados a esta sala. Deseja mesmo deletar?</p>
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
                location.href = "' . $pagina . '?cd_sala=' . $cd_sala . '&conexao=' . $conexao . '&confirmacao=true";
            }
        </script>
    ';
}
    