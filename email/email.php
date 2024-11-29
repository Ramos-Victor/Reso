<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

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
        Você tem até uma semana para verificar sua conta.<br>
        Se não foi você apenas ignore essa mensagem.";

        $mail->send();
        return true;
    }catch(Exception $e){
        return false;
    }
}