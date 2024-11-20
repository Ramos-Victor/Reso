<?php  

require_once $_SERVER['DOCUMENT_ROOT']. '/Reso/conect.php';

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

    function ListarCategorias($msg) {
        $sql = 'SELECT cd_usuario, nm_usuario, cd_categoria, categoria_nm, DATE_FORMAT(dt_categoria, "%d/%m/%Y") as dt_categoria, id_usuario, id_conexao 
                FROM tb_equipamento_categoria 
                INNER JOIN tb_usuario 
                ON id_conexao = "' . $_SESSION['conexao'] . '" and cd_usuario = id_usuario';

        $res = $GLOBALS['con']->query($sql);

        if ($res->num_rows > 0) {
            return $res;
        } else {
            echo $msg;
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

    function DeletarCategoria($cd_catego, $pagina) {
        $sqlVerificaVinculo = 'SELECT * FROM tb_equipamento WHERE id_categoria = ?';
        $stmtVerifica = $GLOBALS['con']->prepare($sqlVerificaVinculo);
    
        if (!$stmtVerifica) {
            Erro("Erro ao preparar a consulta de verificação de vínculo: " . $GLOBALS['con']->error);
            return;
        }
    
        $stmtVerifica->bind_param('i', $cd_catego);
        $stmtVerifica->execute();
        $result = $stmtVerifica->get_result();
    
        if ($result->num_rows > 0) {
            $mensagem = "Deseja realmente deletar esta categoria? Os seguintes equipamentos estão vinculados a ela:<br>";
            while ($row = $result->fetch_assoc()) {
                $mensagem .= " Nome: " . $row['nm_equipamento'] . "<br>";
            }
            ConfirmaExclusaoCategoria($mensagem, $pagina, $cd_catego);
            return;
        }
    
        $sql = 'DELETE FROM tb_equipamento_categoria WHERE cd_categoria = ?';
        $stmt = $GLOBALS['con']->prepare($sql);
    
        if (!$stmt) {
            Erro("Erro ao preparar a consulta de exclusão: " . $GLOBALS['con']->error);
            return;
        }
    
        $stmt->bind_param('i', $cd_catego);
        $res = $stmt->execute();
    
        if ($res) {
            Confirma("Categoria Excluida",$pagina."?");
        } else {
            Erro("Não foi possível deletar a categoria: " . $GLOBALS['con']->error);
        }
    }
    
    if (isset($_GET['confirmacao']) && $_GET['confirmacao'] === 'true' && isset($_GET['cd_categoria'])) {
        $cd_categoria = intval($_GET['cd_categoria']);
        
        $sqlMoverEquipamentos = 'UPDATE tb_equipamento SET id_categoria = NULL WHERE id_categoria = ?';
        $stmtMover = $GLOBALS['con']->prepare($sqlMoverEquipamentos);
    
        if (!$stmtMover) {
            Erro("Erro ao preparar a consulta de atualização dos equipamentos: " . $GLOBALS['con']->error);
            return;
        }
    
        $stmtMover->bind_param('i', $cd_categoria);
        $stmtMover->execute();
    
        DeletarCategoria($cd_categoria, $pagina);
    }
    
    if (isset($_GET['msg']) && $_GET['msg'] === 'categoria_excluida') {
        Confirma("Categoria removida com sucesso!", $pagina);
    }
    
    function ConfirmaExclusaoCategoria($msg, $pagina, $cd_categoria) {
        print '
            <div class="modal fade" id="myModal" data-backdrop="static">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-body text-center font-weight-bolder text-danger">
                            <h3>' . $msg . '</h3>
                            <p>Deseja mesmo deletar?</p>
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
                    location.href = "' . $pagina . '?cd_categoria=' . $cd_categoria . '&confirmacao=true";
                }
            </script>
        ';
    }
    
    
    

    