<?php
    $host = $_ENV['dbhost'];
    $user = $_ENV['dbuser'];
    $pass = $_ENV['dbpassword'];
    $base = $_ENV['dbname'];

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