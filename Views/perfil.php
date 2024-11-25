<?php
session_start();

if(!empty($_SESSION['id'])){
    $_SESSION['id'];
    $_SESSION['usuario'];
    include_once $_SERVER['DOCUMENT_ROOT'] . '/Reso/conect.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/Reso/dialog.php';
}
else{
    header("Location: /Reso/logout.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resolut.On</title>
    <link rel="shortcut icon" type="imagex/png" href="../assets/img/logoresoluton.png">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Reso/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<style>
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
</style>

<body>
    <div class="container-fluid py-3">
        <div class="row">
            <div class="col-sm-4">
                <a href="javascript:history.back()" class="back-button">Voltar</a>
            </div>
            <div class="col-8 text-center">
                <h2 class="ml-5 mb-4">Configurações do Usuario</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 text-center">
                <div class="card">
                    <div class="card-body">
                        <img id="previewImage" src="/Reso/assets/img/PerfilImgs/iconpadraoperfil.png"
                            alt="Foto do Perfil" class="rounded-circle mb-3"
                            style="max-width: 10rem; height: 10rem; object-fit: cover;">
                        <div class="mb-3">
                            <input type="file" id="fileInput" accept="image/*" style="display: none;"
                                onchange="previewFile()">
                            <button class="btn btn-primary btn-sm"
                                onclick="document.getElementById('fileInput').click()">
                                Alterar Foto
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Coluna das Informações -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <form>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nome Completo</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Seu nome completo">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">E-mail</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" placeholder="seu@email.com">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Telefone</label>
                                <div class="col-sm-9">
                                    <input type="tel" class="form-control" placeholder="(00) 00000-0000">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Data de Nascimento</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Biografia</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" rows="3"
                                        placeholder="Fale um pouco sobre você"></textarea>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-sm-9 offset-sm-3">
                                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                                    <button type="reset" class="btn btn-secondary ml-2">Cancelar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


</body>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/Reso/footer.php';?>
<script>
function previewFile() {
    const preview = document.getElementById('previewImage');
    const file = document.getElementById('fileInput').files[0];

    if (file) {
        // Verifica se é uma imagem
        if (!file.type.startsWith('image/')) {
            alert('Por favor, selecione apenas arquivos de imagem.');
            return;
        }

        // Verifica o tamanho do arquivo (5MB máximo)
        if (file.size > 5 * 1024 * 1024) {
            alert('A imagem deve ter no máximo 5MB.');
            return;
        }

        const reader = new FileReader();

        reader.onloadend = function() {
            preview.src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "/Reso/assets/img/PerfilImgs/iconpadraoperfil.png";
        }
    }
}
</script>