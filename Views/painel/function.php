<?php 
    require_once $_SERVER['DOCUMENT_ROOT']. '/Reso/conect.php';

    function contarChamadosPorStatus() {
        global $con;
    
        $sql = 'SELECT st_chamado, COUNT(*) AS total 
                FROM tb_chamado 
                WHERE id_unidade = "' . $_SESSION['unidade'] . '" 
                GROUP BY st_chamado';
    
        $res = $con->query($sql);
    
        if ($res) {
            $dados = [];
            while ($row = $res->fetch_assoc()) {
                $dados[$row['st_chamado']] = $row['total'];
            }
            return $dados;
        } else {
            return "Erro na consulta: " . $con->error;
        }
    }
    
?>