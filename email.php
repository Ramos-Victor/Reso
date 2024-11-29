<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function AutenticarEmail($email,$id){

    $mail = new PHPMailer(True);

        $mail->isSMTP();
        $mail->Host = 'smtp.titan.email';
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['emailaddress'];
        $mail->Password = $_ENV['emailpassword'];
        $mail->SMTPSecure = 'tls';
        $mail->Port=465;

        $mail->setFrom($_ENV['emailaddress']);
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Verificar Email';
        $mail->Body = "Verefique seu email no Resolut.on acessando o link:
        <br> <b> https://www.resolutiontcc.com.br/Reso/?route=/verificado&$id </b> <br>
        Você tem até uma semana para verificar sua conta.<br>
        Se não foi você apenas ignore essa mensagem.";

        if($mail->send()){
            return true;
        }else{
            return false;
        }
}