<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
require_once 'conect.php';

function AutenticarEmail($email,$id){

    $mail = new PHPMailer(True);

        try{

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['emailaddress'];
        $mail->Password = 'wzxd hukw bzac ksjd';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port=465;

        $mail->setFrom($_ENV['emailaddress'], 'Suporte');
        $mail->addAddress($email, 'Usuario');

        $mail->isHTML(true);
        $mail->Subject = 'Verificar Email';
        $mail->Body = "Verifique seu email no Resolut.on acessando o link:
        <br> <b> https://www.resolutiontcc.com.br/Reso/?route=/verificado&id=$id </b> <br>
        Você tem até 3 dias para verificar sua conta.<br>
        Se não foi você apenas ignore essa mensagem.";

        $mail->send();
        return true;
    }catch(Exception $e){
        return false;
    }
}

function gerarToken($email){
    global $con;
    $token = bin2hex(random_bytes(32));
    $expiracao = date('Y-m-d H:i:s', strtotime('+1 hour'));
    
    $stmt1 = $con->prepare('SELECT token FROM tb_recuperacao_senha WHERE email = ?');
    $stmt1->bind_param('s', $email);
    $stmt1->execute();
    $res = $stmt1->get_result();
    $row = $res->fetch_assoc();
    $stmt1->close();

    if($row && isset($row['token'])){
        $stmt2 = $con->prepare('DELETE FROM tb_recuperacao_senha WHERE token = ?');
        $stmt2->bind_param('s', $row['token']);
        $stmt2->execute();
        $stmt2->close();
    }

    $stmt3 = $con->prepare('SELECT cd_usuario FROM tb_usuario WHERE nm_email = ?');
    $stmt3->bind_param('s', $email);
    $stmt3->execute();
    $stmt3->store_result();
    
    if($stmt3->num_rows == 0){
        $stmt3->close();
        return false;
    }
    $stmt3->close();

    $stmt4 = $con->prepare('INSERT INTO tb_recuperacao_senha (email, token, dt_expiracao) VALUES (?,?,?)');
    $stmt4->bind_param('sss', $email, $token, $expiracao);
    $res = $stmt4->execute();
    
    if($res){
        $stmt4->close();
        return $token;
    } else {
        $stmt4->close();
        return false;
    }
}

function EnviarEmailRec($email,$token){

    $mail = new PHPMailer(True);

        try{

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['emailaddress'];
        $mail->Password = 'wzxd hukw bzac ksjd';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port=465;

        $mail->setFrom($_ENV['emailaddress'], 'Suporte');
        $mail->addAddress($email, 'Usuario');

        $mail->isHTML(true);
        $mail->Subject = 'Recuperar senha';
        $mail->Body = "Redefina sua senha no Resolut.on clicando no link abaixo:
        <br> <b> https://www.resolutiontcc.com.br/Reso/?route=/redefinirsenha&token=$token </b> <br>
        Se não foi você apenas ignore essa mensagem.";

        $mail->send();
        return true;
    }catch(Exception $e){
        return false;
    }
}