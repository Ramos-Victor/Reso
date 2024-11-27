<?php

require_once 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function AutenticarEmail($email,$id, $name){

    $mail = new PHPMailer(true);

    try{
        $mail->isSMTP();
        $mail->Host = 'smtp.titan.email';
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['emailaddress'];
        $mail->Password = $_ENV['emailpassword'];
        $mail->SMTPSecure = 'ssl';
        $mail->Port=465;

        $mail->setForm($_ENV['emailaddress'], );
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Verificar Email';
        $mail->Body = "Verefique seu email no Resoluton acessando o link:<br>
        "
    }
}