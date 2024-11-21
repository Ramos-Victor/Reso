<?php
include_once  $_SERVER['DOCUMENT_ROOT'] . '/Reso/Views/painel/header.php';
?>

<style>
.chat-container {
    max-width: 500px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: 12px;
    overflow: hidden;
}

.chat-header {
    background: linear-gradient(135deg, #007bff, #0056b3);
    color: white;
    padding: 15px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.chat-status {
    width: 12px;
    height: 12px;
    background-color: #28a745;
    border-radius: 50%;
    margin-right: 10px;
    box-shadow: 0 0 5px #28a745;
}

.chat-body {
    background-color: #f8f9fa;
    height: 500px;
    overflow-y: auto;
    padding: 15px;
}

.chat-footer {
    background-color: #e9ecef;
    padding: 15px;
    border-top: 1px solid #dee2e6;
}

.mensagem {
    margin-bottom: 15px;
    max-width: 80%;
}

.mensagem-enviada {
    align-self: flex-end;
    background-color: #007bff;
    color: white;
    border-radius: 15px 15px 0 15px;
    padding: 10px;
    margin-left: auto;
}

.mensagem-recebida {
    align-self: flex-start;
    background-color: #e9ecef;
    border-radius: 15px 15px 15px 0;
    padding: 10px;
}

#form-mensagem{
    display: flex;
    flex-direction: row;
    column-gap:10px
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

/* Responsividade */
@media (max-width: 576px) {
    .chat-container {
        width: 95%;
        margin: 0 auto;
    }
}
</style>

<body class="bg-light">
<a href="?route=/painelChamados" class="back-button">Voltar</a>
    <div class="container-fluid d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="chat-container card" style="width:400px;">
            <div class="chat-header">
                <div class="d-flex align-items-center">
                    <span class="chat-status"></span>
                    <h5 class="mb-0 text-white">Chat do Chamado</h5>
                </div>
            </div>

            <div class="chat-body d-flex flex-column" id="mensagens">
            </div>

            <div class="chat-footer">
                <div class="input-group">
                    <form id="form-mensagem">
                        <input type="hidden" name="id_chamado" value="<?= $_GET['idChamado'] ?>">
                        <input type="text" class="form-control" style="width:300px" name="mensagem" placeholder="Digite sua mensagem">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-paper-plane" style="font-size:25px"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/Reso/footer.php'; ?>
</body>

<script>
let ultimoIdMensagem = 0;
const idUsuarioLogado =<?= $_SESSION['id'] ?>;

document.getElementById('form-mensagem').addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    fetch('?route=/painelChatEnviar', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                this.querySelector('input[name="mensagem"]').value = '';
                buscarMensagens(); 
            } else {
                alert('Erro ao enviar mensagem: ' + data.mensagem);
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            alert('Erro ao enviar mensagem');
        });
});

function buscarMensagens() {
    const idChamado = document.querySelector('input[name="id_chamado"]').value;

    fetch(`?route=/painelChatBuscar&idChamado=${idChamado}&ultimo_id=${ultimoIdMensagem}`)
        .then(response => response.json())
        .then(data => {
            if (data.status && data.mensagens.length > 0) {
                const containerMensagens = document.getElementById('mensagens');
                data.mensagens.forEach(msg => {
                    const divMensagem = document.createElement('div');
                    divMensagem.classList.add('mensagem');
                    divMensagem.classList.add(
                        msg.id_usuario_remetente != idUsuarioLogado
                            ? 'mensagem-recebida'       
                            : 'mensagem-enviada'
                    );

                    divMensagem.innerHTML = `
                        ${msg.remetente}<br>
                        ${msg.mensagem}<br>
                        ${msg.data_envio}<br>
                    `;
                    containerMensagens.appendChild(divMensagem);

                    ultimoIdMensagem = Math.max(ultimoIdMensagem, msg.id_mensagem);
                });

                containerMensagens.scrollTop = containerMensagens.scrollHeight;
            }
        })
        .catch(error => {
            console.error('Erro ao buscar mensagens:', error);
        });
}

setInterval(buscarMensagens, 3000);

buscarMensagens();
</script>