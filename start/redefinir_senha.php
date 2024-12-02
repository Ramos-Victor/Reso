<?php
    require_once 'header.php';
    require_once 'conect.php';
    require_once './email/email.php';
    require_once 'dialog.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Verificação de E-mail</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    height: 100vh;
    background: linear-gradient(111deg,
            #0000ffb4 0%,
            #0000b14f 50%,
            #000000 100%),
        url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='400' height='400' viewBox='0 0 800 800'%3E%3Cg fill='none' stroke='%23444444' stroke-width='1'%3E%3Cpath d='M769 229L1037 260.9M927 880L731 737 520 660 309 538 40 599 295 764 126.5 879.5 40 599-197 493 102 382-31 229 126.5 79.5-69-63'/%3E%3Cpath d='M-31 229L237 261 390 382 603 493 308.5 537.5 101.5 381.5M370 905L295 764'/%3E%3Cpath d='M520 660L578 842 731 737 840 599 603 493 520 660 295 764 309 538 390 382 539 269 769 229 577.5 41.5 370 105 295 -36 126.5 79.5 237 261 102 382 40 599 -69 737 127 880'/%3E%3Cpath d='M520-140L578.5 42.5 731-63M603 493L539 269 237 261 370 105M902 382L539 269M390 382L102 382'/%3E%3Cpath d='M-222 42L126.5 79.5 370 105 539 269 577.5 41.5 927 80 769 229 902 382 603 493 731 737M295-36L577.5 41.5M578 842L295 764M40-201L127 80M102 382L-261 269'/%3E%3C/g%3E%3Cg fill='%23525055'%3E%3Ccircle cx='769' cy='229' r='5'/%3E%3Ccircle cx='539' cy='269' r='5'/%3E%3Ccircle cx='603' cy='493' r='5'/%3E%3Ccircle cx='731' cy='737' r='5'/%3E%3Ccircle cx='520' cy='660' r='5'/%3E%3Ccircle cx='309' cy='538' r='5'/%3E%3Ccircle cx='295' cy='764' r='5'/%3E%3Ccircle cx='40' cy='599' r='5'/%3E%3Ccircle cx='102' cy='382' r='5'/%3E%3Ccircle cx='127' cy='80' r='5'/%3E%3Ccircle cx='370' cy='105' r='5'/%3E%3Ccircle cx='578' cy='42' r='5'/%3E%3Ccircle cx='237' cy='261' r='5'/%3E%3Ccircle cx='390' cy='382' r='5'/%3E%3C/g%3E%3C/svg%3E"),
        #0e161e;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: Arial, sans-serif;
}

.container {
    text-align: center;
    background-color: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 500px;
}

.message-box h1 {
    color: #333;
    font-size: 24px;
    margin-bottom: 20px;
}

.message-box p {
    color: #777;
    font-size: 16px;
    margin-bottom: 30px;
}

.btn {
    padding: 12px 25px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color: #45a049;
}

.back-button {
    position: absolute;
    top: 10px;
    left: 10px;
    background-color: #03305c;
    color: #fff;
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    text-decoration: none;
    font-size: 14px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
    transition: background-color 0.3s ease;
}

.back-button:hover {
    background-color: #022a50;
}

@media (max-width: 600px) {
    .message-box h1 {
        font-size: 20px;
    }

    .message-box p {
        font-size: 14px;
    }

    .btn {
        font-size: 14px;
        padding: 10px 20px;
    }
}

.logoetitulo {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
}

.logo {
    height: 6rem;
    width: 6rem;
}
</style>

<body>
    <a href="?route=/login" class="back-button">Voltar</a>
    <div class="container">
        <div class="logoetitulo">
            <img src="./assets/img/logoresoluton.png" alt="Logo Resolut.On" class="logo">
            <h2>Resolut.On</h2>
        </div>
        <div class="message-box">
            <form method="POST">
                <h1>Digite sua nova senha</h1>
                <input type="password" class="form-control mb-3" name="senha" id="senha" placeholder="Digite sua nova senha">
                <input type="password" class="form-control mb-3" name="confirmarSenha" id="confirmarSenha" placeholder="Confirme a senha">
                <input type="submit" name="action" value="Continuar" class="btn">
            </form>
        </div>
    </div>
</body>

</html>

<?php

    if(!empty($_POST)){
        if($_POST['action']){
            $token = $_GET['token'];
            $novaSenha = $_POST['senha'];
            $confirmarSenha = $_POST['confirmarSenha'];

            if($token && $novaSenha == $confirmarSenha){
                $dadosToken = ValidarToken($token);

                if($dadosToken){
                    if(redefinirSenha($dadosToken['email'],$novaSenha)){
                        Confirma("Senha redefinida com sucesso!","?route=/login");
                    }else{
                        Confirma("Erro ao redefinir a senha!","?route=/redefinirsenha&token=$token");
                    }
                }else{
                    Confirma("Token inválido ou expirado!","?route=/esquecisenha");
                }
            }else{
                Confirma("Dados inválidos!","?route=/redefinirsenha&token=$token");
            }
        }
    }

    function ValidarToken($token){
        global $con;
       
        $sql = 'SELECT email FROM tb_recuperacao_senha WHERE token = ?';
        $stmt = $con->prepare($sql);
        $stmt->bind_param('s', $token);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            
            $row = $result->fetch_assoc();
            return $row; 
        } else {
            return false;
        }
    }

    function redefinirSenha($email,$novaSenha){
        global $con;

        $sql = 'UPDATE tb_usuario SET cd_senha = sha2(?,256) WHERE nm_email = ?';

        $stmt = $con->prepare($sql);
        $stmt->bind_param('ss',$novaSenha,$email);

        $stmt->execute();

        $stmt->close();

        $stmt = $con->prepare('DELETE FROM tb_recuperacao_senha WHERE email = ?');

        $stmt->bind_param ('s',$email);

        $res = $stmt->execute();

        if($res){
            return true;
        }else{
            return false;
        }
    }
?>