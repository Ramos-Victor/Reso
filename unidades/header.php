<?php
session_start(); 
error_reporting(E_ALL ^ E_WARNING);
ini_set('display_errors', 1) ;
if(!empty($_SESSION['id'])){
    $_SESSION['id'];
    $_SESSION['usuario'];
    require_once '../conect.php';
    require_once 'dialog.php';
}
else{
    header("Location: ../logout.php");
}
?>