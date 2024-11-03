<?php
session_start(); 
error_reporting(E_ALL ^ E_WARNING);
ini_set('display_errors', 1) ;
if(!empty($_SESSION['conexao'])){
    $_SESSION['id'];
    $_SESSION['usuario'];
    $_SESSION['conexao'];
    $_SESSION['nm_conexao'];
    $_SESSION['cargo'];
    include_once 'C:\xampp\htdocs\Reso\conect.php';
    include_once 'C:\xampp\htdocs\Reso\dialog.php';
}
else{
    header("Location: ../conexoes/conexao.php");
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
    <link rel="stylesheet" href="../../../../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
