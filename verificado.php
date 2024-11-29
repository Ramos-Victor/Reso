<?php
require 'vendor/autoload.php';

use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(dirname(__FILE__, 1));
$dotenv->load();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

    try {
        

        $mail->CharSet = 'UTF-8';
        $mail->isSMTP();
        $mail->Host = 'smtp.titan.email';
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['emailaddress'];
        $mail->Password = $_ENV['emailpassword'];
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom($_ENV['emailaddress'], 'Suporte');
        $mail->addAddress('vm02oliveiraramos@gmail.com', 'Cliente');
        $mail->isHTML(true);
        $mail->Subject = 'Verificar Email';
        $mail->Body = "Verifique seu email no Resolut.on acessando o link:
        <br> <b> https://www.resolutiontcc.com.br/Reso/?route=/verificado&id=2 </b> <br>
        Você tem até uma semana para verificar sua conta.<br>
        Se não foi você, apenas ignore essa mensagem.";

        if ($mail->send()) {
            echo "Email enviado!";
            return true;
        } else {
            throw new Exception('Email não pode ser enviado');
        }
    } catch (Exception $e) {
        error_log('Mailer Error: ' . $mail->ErrorInfo);
        return false;
    }
