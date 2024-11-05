<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $base = "db_resoluton2";

    try {
        $con = new mysqli($host, $user, $pass, $base);
        
        if ($con->connect_error) {
            throw new Exception("Erro na conexão: " . $con->connect_error);
        }
        
        $con->set_charset("utf8");
        
    } catch (Exception $e) {
        echo "Erro: " . $e->getMessage();
        exit();
    }
?>