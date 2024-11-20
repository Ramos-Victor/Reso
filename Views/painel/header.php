<?php
if (!defined('ROUTING_ACCESS')) {
    http_response_code(403);
    die('<h1 style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">Acesso direto não permitido</h1>');
}
session_start(); 
error_reporting(E_ALL ^ E_WARNING);
ini_set('display_errors', 1) ;
if(!empty($_SESSION['conexao']) & $_SESSION['cargo']!="comum"){
    $_SESSION['id'];
    $_SESSION['usuario'];
    $_SESSION['conexao'];
    $_SESSION['nm_conexao'];
    $_SESSION['cargo'];
    include_once $_SERVER['DOCUMENT_ROOT'] . '/Reso/conect.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/Reso/dialog.php';
}
else{
    header("Location:/Reso/Views/unidades/");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resolut.On</title>
    <link rel="shortcut icon" type="imagex/png" href="../assets/img/logoresoluton.jpg">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Reso/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>