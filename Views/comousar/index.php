<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resolut.On - Guia do Usuário</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f4f6f9;
        color: #333;
        line-height: 1.6;
    }

    .back-button {
        position: fixed;
        top: 20px;
        left: 20px;
        background-color: #03305c;
        color: #fff;
        border: none;
        padding: 10px 15px;
        border-radius: 25px;
        text-decoration: none;
        font-size: 14px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        z-index: 1000;
    }

    .back-button:hover {
        background-color: #022a50;
        transform: translateY(-2px);
    }

    .guide-section {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .guide-section:hover {
        transform: scale(1.02);
    }

    .imagens {
        width: 100%;
        height: 390px;
        object-fit: cover;
        border-bottom: 4px solid #03305c;
    }

    .guide-section p {
        padding: 15px;
        background-color: #f8f9fa;
    }

    h2 {
        color: #03305c;
        text-align: center;
        margin-bottom: 30px;
        font-weight: 700;
    }

    @media (max-width: 768px) {
        .imagens {
            height: 250px;
            object-fit: contain;
            background-color: #f4f6f9;
            padding: 10px;
            border: 1px solid #e0e4e8;
        }

        .guide-section {
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .guide-section p {
            font-size: 14px;
            line-height: 1.5;
            padding: 12px;
        }

        .container-fluid {
            padding-left: 15px !important;
            padding-right: 15px !important;
        }
    }


    @media (max-width: 576px) {
        .imagens {
            height: 200px;
            object-fit: contain;
        }

        h2 {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }
    }
    </style>
</head>

<body>
    <a href="javascript:history.back()" class="back-button">Voltar</a>
    <div class="container-fluid px-5 py-4">
        <h2>Guia do Usuário - Resolut.On</h2>

        <div class="row">
            <div class="col-12 col-md-6 mb-4">
                <div class="guide-section">
                    <img src="./assets/img/comousar/inicial/telainicial.png" class="imagens img-fluid"
                        alt="Tela inicial">
                    <p>Para começar, clique no botão "Testar"</p>
                </div>
            </div>
            <div class="col-12 col-md-6 mb-4">
                <div class="guide-section">
                    <img src="./assets/img/comousar/inicial/registro.png" class="imagens img-fluid"
                        alt="Tela de registro">
                    <p>Faça o seu registro no site. Será enviado um e-mail de verificação para o seu endereço de e-mail</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-6 mb-4">
                <div class="guide-section">
                    <img src="./assets/img/comousar/inicial/login.png" class="imagens img-fluid" alt="Tela de login">
                    <p>Realize o seu login para acessar o painel</p>
                </div>
            </div>
            <div class="col-12 col-md-6 mb-4">
                <div class="guide-section">
                    <img src="./assets/img/comousar/unidade/telaunidades.png" class="imagens img-fluid"
                        alt="Tela de unidades">
                    <p>Tela inicial do painel onde serão listadas suas unidades</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-6 mb-4">
                <div class="guide-section">
                    <img src="./assets/img/comousar/unidade/botaocriar.png" class="imagens img-fluid"
                        alt="Botão criar unidade">
                    <p>Ao clicar no botão "Criar", um modal será exibido onde você pode escolher o nome da sua unidade e
                        criá-la</p>
                </div>
            </div>
            <div class="col-12 col-md-6 mb-4">
                <div class="guide-section">
                    <img src="./assets/img/comousar/unidade/botaoverunidades.png" class="imagens img-fluid"
                        alt="Botão ver unidades">
                    <p>Ao clicar no botão "Ver unidades", um modal será exibido mostrando as informações da sua unidade.
                        O código de acesso à unidade é crucial, pois será utilizado para que outros usuários possam
                        entrar na sua unidade.</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-6 mb-4">
                <div class="guide-section">
                    <img src="./assets/img/comousar/unidade/botaoconectar.png" class="imagens img-fluid"
                        alt="Botão conectar">
                    <p>Ao clicar no botão "Conectar", um modal será exibido onde você pode digitar um código de unidade e
                        acessar uma unidade pertencente a outro usuário</p>
                </div>
            </div>
            <div class="col-12 col-md-6 mb-4">
                <div class="guide-section">
                    <img src="./assets/img/comousar/unidade/navbarunidades.png" class="imagens img-fluid"
                        alt="Navbar unidades">
                    <p>No navbar, você pode navegar para a tela de configuração de perfil ou encerrar sua sessão</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-6 mb-4">
                <div class="guide-section">
                    <img src="./assets/img/comousar/perfil/perfil.png" class="imagens img-fluid" alt="Tela de perfil">
                    <p>Aqui você pode editar suas informações, como foto de perfil e número de telefone</p>
                </div>
            </div>
            <div class="col-12 col-md-6 mb-4">
                <div class="guide-section">
                    <img src="./assets/img/comousar/painel/dashboard.png" class="imagens img-fluid" alt="Dashboard">
                    <p>Bem-vindo ao Dashboard, acessível apenas para Criadores, Suporte ou Administradores. Aqui você poderá visualizar um relatório geral da sua unidade, incluindo estatísticas de chamados, gráficos de desempenho e análises detalhadas</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 mb-4">
                <div class="guide-section">
                    <img src="./assets/img/comousar/painel/usuario/usuarios.png" class="imagens img-fluid" alt="Tela de usuários">
                    <p>Aqui serão listados todos os usuários conectados à sua unidade. Caso você seja Criador ou Administrador, poderá remover o usuário da sua unidade.<br> Você também pode ver mais informações do usuário clicando no botão "Ver mais".<br> E, por fim, você também pode alterar o cargo do usuário.</p>
                </div>
            </div>
            <div class="col-12 col-md-6 mb-4">
                <div class="guide-section">
                    <img src="./assets/img/comousar/painel/categoria/categoria.png" class="imagens img-fluid" alt="Tela de categorias">
                    <p>Aqui serão listadas todas as categorias que você criar. Elas serão usadas para atribuir aos equipamentos.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 mb-4">
                <div class="guide-section">
                    <img src="./assets/img/comousar/painel/categoria/adicionarcategoria.png" class="imagens img-fluid" alt="Tela de adicionar categoria">
                    <p>Ao clicar no botão "Categoria", será exibido um modal pedindo o nome da categoria a ser criada. Aqui você pode criar as categorias que serão atribuídas aos equipamentos que você adicionar à sua unidade.</p>
                </div>
            </div>
            <div class="col-12 col-md-6 mb-4">
                <div class="guide-section">
                    <img src="./assets/img/comousar/painel/salas/salas.png" class="imagens img-fluid" alt="Tela de salas">
                    <p>Aqui serão listadas todas as salas que você criar para sua unidade. Você poderá atribuir o equipamento a uma sala específica.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 mb-4">
                <div class="guide-section">
                    <img src="./assets/img/comousar/painel/equipamentos/equipamento.png" class="imagens img-fluid" alt="Tela de equipamentos">
                    <p>Aqui serão exibidos todos os equipamentos da sua unidade. Você poderá atribuir um chamado a um equipamento específico. Você pode editar os atributos dos equipamentos, ver com mais detalhes as informações ou deletá-los.</p>
                </div>
            </div>
            <div class="col-12 col-md-6 mb-4">
                <div class="guide-section">
                    <img src="./assets/img/comousar/painel/chamado/chamado.png" class="imagens img-fluid" alt="Tela de chamados">
                    <p>Aqui serão listados todos os chamados da unidade. Você pode abrir os chamados, filtrar a listagem, excluí-los e editá-los.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 mb-4">
                <div class="guide-section">
                    <img src="./assets/img/comousar/painel/chamado/atribuirandamento.png" class="imagens img-fluid" alt="Tela de atribuir andamento">
                    <p>Você pode atribuir andamento ao chamado.</p>
                </div>
            </div>
            <div class="col-12 col-md-6 mb-4">
                <div class="guide-section">
                    <img src="./assets/img/comousar/painel/chamado/chatdochamado.png" class="imagens img-fluid" alt="Chat do chamado">
                    <p>Você pode acessar o chat do chamado.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 mb-4">
                <div class="guide-section">
                    <img src="./assets/img/comousar/painel/chamado/concluirchamado.png" class="imagens img-fluid" alt="Tela de concluir chamado">
                    <p>Você pode concluir o chamado e deixar um feedback.</p>
                </div>
            </div>
            <div class="col-12 col-md-6 mb-4">
                <div class="guide-section">
                    <img src="./assets/img/comousar/painel/chamado/avaliarchamado.png" class="imagens img-fluid" alt="Avaliar chamado">
                    <p>O usuário que abriu o chamado poderá avaliar o atendimento, dando uma nota de 1 a 5.</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>