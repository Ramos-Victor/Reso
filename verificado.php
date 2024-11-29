<?php

require_once './vendor/autoload.php';

use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(dirname(__FILE__, 1));
$dotenv->load();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

    $mail = new PHPMailer(True);

        try{

        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['emailaddress'];
        $mail->Password = $_ENV['emailpassword'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port=465;

        $mail->setFrom($_ENV['emailaddress'], 'Suporte');
        $mail->addAddress('vm02oliveiraramos@gmail.com', 'Usuario');

        $mail->isHTML(true);
        $mail->Subject = 'Verificar Email';
        $mail->Body = "Verefique seu email no Resolut.on acessando o link:
        <br> <b> https://www.resolutiontcc.com.br/Reso/?route=/verificado&1 </b> <br>
        Você tem até uma semana para verificar sua conta.<br>
        Se não foi você apenas ignore essa mensagem.";

        $mail->send();
        echo 'Mensagem enviada!';
    }catch(Exception $e){
        echo 'Mensagem não pode ser enviada!';
    }
