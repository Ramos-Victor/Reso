<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resolut.on</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="styles.css">
</head>
<style>
	/* Gradiente e fundo escuro */
html,
body {
    overflow-y: scroll;
    overflow-x: hidden;
    scrollbar-width: none;
    scroll-behavior: smooth;
}

.gradient-background {
    height: 100vh; /* Altura total da tela */
    background: linear-gradient(
            111deg,
            #0000ffb4 0%, 
            #0000b14f 50%, 
            #000000 100% 
        ),
        url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='400' height='400' viewBox='0 0 800 800'%3E%3Cg fill='none' stroke='%23444444' stroke-width='1'%3E%3Cpath d='M769 229L1037 260.9M927 880L731 737 520 660 309 538 40 599 295 764 126.5 879.5 40 599-197 493 102 382-31 229 126.5 79.5-69-63'/%3E%3Cpath d='M-31 229L237 261 390 382 603 493 308.5 537.5 101.5 381.5M370 905L295 764'/%3E%3Cpath d='M520 660L578 842 731 737 840 599 603 493 520 660 295 764 309 538 390 382 539 269 769 229 577.5 41.5 370 105 295 -36 126.5 79.5 237 261 102 382 40 599 -69 737 127 880'/%3E%3Cpath d='M520-140L578.5 42.5 731-63M603 493L539 269 237 261 370 105M902 382L539 269M390 382L102 382'/%3E%3Cpath d='M-222 42L126.5 79.5 370 105 539 269 577.5 41.5 927 80 769 229 902 382 603 493 731 737M295-36L577.5 41.5M578 842L295 764M40-201L127 80M102 382L-261 269'/%3E%3C/g%3E%3Cg fill='%23525055'%3E%3Ccircle cx='769' cy='229' r='5'/%3E%3Ccircle cx='539' cy='269' r='5'/%3E%3Ccircle cx='603' cy='493' r='5'/%3E%3Ccircle cx='731' cy='737' r='5'/%3E%3Ccircle cx='520' cy='660' r='5'/%3E%3Ccircle cx='309' cy='538' r='5'/%3E%3Ccircle cx='295' cy='764' r='5'/%3E%3Ccircle cx='40' cy='599' r='5'/%3E%3Ccircle cx='102' cy='382' r='5'/%3E%3Ccircle cx='127' cy='80' r='5'/%3E%3Ccircle cx='370' cy='105' r='5'/%3E%3Ccircle cx='578' cy='42' r='5'/%3E%3Ccircle cx='237' cy='261' r='5'/%3E%3Ccircle cx='390' cy='382' r='5'/%3E%3C/g%3E%3C/svg%3E"),
        #0e161e; /* Fundo escuro */
    background-size: cover;
    background-position: center;
    align-items: center;
    font-size: 3rem;
}

/* Container do cabeçalho */
.header-container {
    display: flex;
    flex-direction: column; /* Para melhor disposição em telas menores */
    height: auto; /* Altura automática */
    width: 100%;
    justify-content: center; /* Centraliza o conteúdo verticalmente */
    padding: 20px; /* Adiciona um pouco de preenchimento */
}

/* Adicionando uma nova classe para permitir a disposição lado a lado */
.header-content {
    display: flex;
    flex-direction: row; /* Lado a lado em telas maiores */
    align-items: center; /* Centraliza verticalmente */
    justify-content: center; /* Espaçamento entre logo e informações */
}

@media (max-width: 1180px) {
    .header-content {
        flex-direction: column; /* Empilha em telas menores */
        align-items: center; /* Centraliza os itens */
    }
    .abubu{
        visibility: hidden;
    }
}

/* Logo */
.logo {
    width: 100%; /* Ajusta a largura da imagem */
    max-width: 300px; /* Limita a largura máxima da logo */
    height: auto; /* Mantém a proporção */
    margin: 20px auto; /* Centraliza a logo */
}

/* Estilo das informações do projeto */
.project-info {
    display: flex;
    flex-direction: column;
    align-items: center; /* Centraliza o texto */
    margin-top: 60px;
}

.project-name {
    font-size: clamp(2.5rem, 9vw, 5rem); /* Tamanho responsivo */
    color: #ffffff;
    font-weight: bold;
    margin-top: 20px;
}

.project-description {
    color: #ffffff;
    margin-bottom: 20px;
    text-align: center; /* Centraliza a descrição */
    font-size: 1.25rem; /* Tamanho ajustável */
}

/* Estilos de Botões */
.button-container {
    display: flex;
    gap: 10px;
    justify-content: center; /* Centraliza os botões */
    padding: 10px;
}

.custom-btn,
.custom-btn2 {
    background-color: #F8CF40;
    color: rgb(0, 0, 0);
    border: 2px solid transparent;
    border-radius: 10px;
    padding: 15px 30px;
    font-size: 1.5rem;
    transition: all 0.3s ease;
}

.custom-btn:hover,
.custom-btn2:hover {
    background-color: transparent;
    color: #F8CF40;
    border-color: #F8CF40;
}

/* Seção com fundo escuro */
.dark-section {
    background-color: #1c1c1e;
    color: #fff;
    min-height: 80vh;
    padding: 60px 20px;
    text-align: center;
}

/* Estilos dos Cards */
.card-container {
    display: flex; 
    justify-content: center; 
    flex-wrap: wrap; 
    gap: 40px; 
    padding: 30px 0; 
}

.card {
    background-color: rgba(24, 24, 26, 0.95); 
    padding: 40px;
    text-align: left;
    max-width: 400px; 
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out, border-color 0.3s ease-in-out;
    border: 2px solid transparent; 
    border-radius: 13px;
}

.card h3 {
    font-size: 1.5rem;
    margin-bottom: 10px;
    color: #F8CF40; 
}

.card p {
    color: #e0e0e0;
    font-size: 1rem;
    line-height: 1.5;
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4); 
    border-color: #F8CF40; 
}

@media (max-width: 1180px) {
    .card-container, .header-container {
        flex-direction: column; 
        align-items: center; 
    }

    .card {
        max-width: 90%; 
    }
}

.logo {
    width: 100%; /* Ajusta a largura da imagem */
    max-width: 660px; /* Limita a largura máxima */
    height: auto; /* Mantém a proporção */
    margin: 20px auto; /* Centraliza a logo */
}

/* Estilos da Nova Seção */
.white-section {
    background-color: #f8f9fc;
    padding: 60px 20px;
    color: #333;
    text-align: center;
}

.content-container {
    max-width: 1200px; 
    margin: 0 auto; 
}

.section-subtitle {
    color: #F8CF40;
    font-weight: bold;
    font-size: 1rem;
}

.card-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-top: 40px;
}

.custom-card {
    background-color: #f8f9fc;
    padding: 20px;
    text-align: left;
    border-left: 2px solid #F8CF40; 
}

.card-number {
    color: #F8CF40;
    font-weight: bold;
    font-size: 1.2rem;
}

.custom-card h3 {
    font-size: 1.3rem;
    margin: 10px; 
}

</style>
<body>    
    <header class="header-container gradient-background d-flex align-items-center">
        <div class="container text-center">
            <div class="header-content"> <!-- Adicionando essa div -->
                <img src="assets/img/logoresoluton.png" class="logo img-fluid mb-4" alt="Logo Resolut.on"> 
                <div class="project-info">
                    <h1 class="project-name display-4">Resolut.on</h1>
                    <p class="project-description text-wrap lead">Descubra como nosso help desk pode revolucionar o gerenciamento 
                       <br> de suas solicitações e transformar sua eficiência.</p>
                    <div class="button-container">
                        <a href="#dark-section"type="button" class="btn custom-btn btn-lg">Saiba mais</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    

    <div class="dark-section" id="dark-section">
        <h2 class="abubu">Implemente um help desk de nível empresarial</h2>
        <div class="text-center abubu">
            <a href="login.php" type="button" class="btn custom-btn2">Testar</a>
        </div>    
        <div class="card-container">
            <div class="card">
                <i class="bi bi-columns-gap"></i>
                <h3>Como funciona?</h3>
                <p>Nosso sistema permite que você crie tickets e acompanhe o status de suas solicitações em tempo real.</p>
            </div>
            <div class="card">
                <i class="bi bi-columns-gap"></i>
                <h3>Benefícios</h3>
                <p>Melhore a comunicação, agilize a resolução de problemas e ofereça um melhor suporte aos seus usuários.</p>
            </div>
            <div class="card">
                <i class="bi bi-columns-gap"></i>
                <h3>Público-alvo</h3>
                <p>Nosso serviço é projetado para atender uma ampla gama de usuários, incluindo organizações, instituições educacionais, setor público e usuários finais.</p>
            </div>
        </div>
</div>
    
</body>
</html>