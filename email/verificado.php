<?php
session_destroy();
require_once 'conect.php';
require_once 'dialog.php';
require_once 'header.php';
global $con;

if(!empty($_GET['id'])){
    $id = $_GET['id'];
    $sql = 'SELECT verificado, DATEDIFF(NOW(),dt_cadastro) as dt_diferenca FROM tb_usuario WHERE cd_usuario = ?';
    $stmt = $con->prepare($sql);
    $stmt->bind_param('s',$id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result && $result->num_rows>0){
        $row = $result->fetch_assoc();
        $verificado = $row['verificado'];
        $diff = $row['dt_diferenca'];
        $stmt->close();

        if($verificado == '1'){
            Confirma("Email ja verificado!","?route=/login");
        }
        
        if($diff >= 7){
            $sql = 'DELETE FROM tb_usuario WHERE cd_usuario = ?';
            $stmt = $con->prepare($sql);
            $stmt->bind_param('s', $id);
            $stmt->execute();
            $stmt->close();
            Confirma("Link expirado, realize o cadastro novamente!","?route=/registro");
        }
        
        if($verificado == '0' && $diff < 7){
            $sql = 'UPDATE tb_usuario SET verificado = 1 WHERE cd_usuario = ?';
            $stmt = $con->prepare($sql);
            $stmt->bind_param('s', $id);
            $stmt->execute();
            $stmt->close();
            Confirma("Verificado com sucesso!","?route=/login");
        }
    }else{
        Confirma("Id inválido!","?route=/login");
    }
}else{
    Confirma("Link inválido!","?route=/registro");
}
?>