<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resolut.on</title>
    
    <!-- Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- AOS Animation -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <!-- Fonte -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<style>
    /* Gradiente e fundo escuro */
html,
body {
    overflow-y: scroll;
    overflow-x: hidden;
    scrollbar-width: none;
    scroll-behavior: smooth;
    font-family: 'Poppins', sans-serif;
}

/*-----Header codigo-----*/
.background {
    height: 100%; /* Altura total da tela */
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
}

/* Ajusta os itens do header em telas menores*/
@media (max-width: 1180px) {
    .header-responsive {
        flex-direction: column;
        align-items: center; 
    }
}

/* Logo */
.logo {
    width: 100%; 
    max-width: 660px; 
    height: auto; 
    margin: 20px auto;
}

.project-name {
    font-size: clamp(2.5rem, 6vw, 9rem); 
    color: #ffffff;
    font-weight: bold;
    margin-top: 20px;

}


.slogan {
    margin-top: 30px;
    color: #ffffff;
    margin-bottom: 20px;
    margin-left: 12px;
    font-size: 1.25rem;
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

/*-----Seção preta código-----*/
.dark-section {
    background-color: #1c1c1e;
    color: #fff;
    min-height: 70vh;
    padding: 60px 20px;
    text-align: center;
}

.card {
    background-color: rgba(24, 24, 26, 0.95);
    padding: 40px;
    text-align: left;
    max-width: 400px;
    width: 100%;
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out, border-color 0.3s ease-in-out;
    border: 2px solid transparent;
    border-radius: 13px;
    color: #ffffff;
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

/*-----Seção branca código-----*/
.white-section {
    background-color: #f8f9fc;
    min-height: 75vh;
    padding: 60px 40px;
    color: #333;
    text-align: center;
}

.content-container {
    max-width: 1200px;
    margin: 0 auto;
}

.section-subtitle {
    color: #0000ff;
    font-weight: bold;
    font-size: 1.8rem;
    background-color: #0000ff42;
    border-radius: 30px;
    padding: 8px;
    text-align: center;
    margin: auto;
    width: 30%;
}

/* Ajustes para telas pequenas */
@media (max-width: 768px) {
    .section-subtitle {
        font-size: 1.5rem; 
        padding: 6px; 
        width: 90%;

    }
}

.custom-card {
    background-color: #f8f9fc;
    padding: 20px;
    text-align: left;
    border-left: 2px solid #0000ff6b;
}

.color {
    color: #0000ff6b;
}

.custom-card h3 {
    font-size: 1.3rem;
    margin: 10px;
}

/*-----Criadores Código-----*/

.gradient-background {
    height: 100vh; 
    background: linear-gradient(
            111deg,
            #0000ffb4 0%, 
            #0000b14f 50%, 
            #000000 100% 
        ),
        url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='400' height='400' viewBox='0 0 800 800'%3E%3Cg fill='none' stroke='%23444444' stroke-width='1'%3E%3Cpath d='M769 229L1037 260.9M927 880L731 737 520 660 309 538 40 599 295 764 126.5 879.5 40 599-197 493 102 382-31 229 126.5 79.5-69-63'/%3E%3Cpath d='M-31 229L237 261 390 382 603 493 308.5 537.5 101.5 381.5M370 905L295 764'/%3E%3Cpath d='M520 660L578 842 731 737 840 599 603 493 520 660 295 764 309 538 390 382 539 269 769 229 577.5 41.5 370 105 295 -36 126.5 79.5 237 261 102 382 40 599 -69 737 127 880'/%3E%3Cpath d='M520-140L578.5 42.5 731-63M603 493L539 269 237 261 370 105M902 382L539 269M390 382L102 382'/%3E%3Cpath d='M-222 42L126.5 79.5 370 105 539 269 577.5 41.5 927 80 769 229 902 382 603 493 731 737M295-36L577.5 41.5M578 842L295 764M40-201L127 80M102 382L-261 269'/%3E%3C/g%3E%3Cg fill='%23525055'%3E%3Ccircle cx='769' cy='229' r='5'/%3E%3Ccircle cx='539' cy='269' r='5'/%3E%3Ccircle cx='603' cy='493' r='5'/%3E%3Ccircle cx='731' cy='737' r='5'/%3E%3Ccircle cx='520' cy='660' r='5'/%3E%3Ccircle cx='309' cy='538' r='5'/%3E%3Ccircle cx='295' cy='764' r='5'/%3E%3Ccircle cx='40' cy='599' r='5'/%3E%3Ccircle cx='102' cy='382' r='5'/%3E%3Ccircle cx='127' cy='80' r='5'/%3E%3Ccircle cx='370' cy='105' r='5'/%3E%3Ccircle cx='578' cy='42' r='5'/%3E%3Ccircle cx='237' cy='261' r='5'/%3E%3Ccircle cx='390' cy='382' r='5'/%3E%3C/g%3E%3C/svg%3E"),
        #0e161e; 
    background-size: cover;
    background-position: center;
    align-items: center;
    font-size: 3rem;
}

.modal-content{
    background-color: transparent;
    border-radius: 2%;
}

.card-modal {
    max-width: 900px; 
    margin: auto;
}

/*-----Footer código-----*/
.footer {
    background-color: rgb(24, 24, 26);
    color: #fff;
}

.logo2 {
    width: 100%; 
    max-width: 95px; 
    height: auto; 
    margin-top: 30px;
}

.bene{
    font-family: "bene";
}

@font-face {
  font-family: "bene";
  src: url('./assets/fontes/wedges/Wedges.ttf');
}

</style>
<body>    
    <!-- Header -->
    <header class="h-auto align-items gradient-background">
        <div class="container text-center">
            <div class="d-flex align-items-center header-responsive">
                <img src="./assets/img/logolandingpage.png" class="logo img-fluid" alt="Logo Resolut.on"> 
                <div class="project-info">
                    <h1 class="project-name bene display-5">Resolut.on</h1>
                    <p class="slogan text-start">Descubra como nosso help desk pode revolucionar o gerenciamento 
                    <br> de suas solicitações e transformar sua eficiência.</p>
                    <a href="#dark-section" class="btn custom-btn btn-lg">Saiba mais</a>
                </div>
            </div>
        </div>
    </header>
    
    <!-- Seção preta -->
    <section class="dark-section" id="dark-section">
        <h2 class="display-6 border-bottom border-warning border-2 mb-4">Implemente um help desk de simples e prático.</h2>
        <div class="text-center">
            <a href="?route=/login" class="btn custom-btn2 mt-4">Testar</a>
        </div>    
        <div class="d-flex justify-content-center flex-wrap gap-5 mt-4" data-aos="zoom-in-up">
            <div class="card">
                <i class="bi bi-columns-gap"></i>
                <h3 class="mb-3 text-warning fs-2">Como funciona?</h3>
                <p>Nosso sistema permite que você crie tickets e acompanhe o status de suas solicitações em tempo real.</p>
            </div>
            <div class="card">
                <i class="bi bi-columns-gap"></i>
                <h3 class="mb-3 text-warning fs-2">Benefícios</h3>
                <p>Melhore a comunicação, agilize a resolução de problemas e ofereça um melhor suporte aos seus usuários.</p>
            </div>
            <div class="card">
                <i class="bi bi-columns-gap"></i>
                <h3 class="mb-3 text-warning fs-2">Público-alvo</h3>
                <p>Nosso serviço é projetado para atender uma ampla gama de usuários, incluindo organizações, instituições educacionais, setor público e usuários finais.</p>
            </div>
        </div>
    </section>
    
    <section class="white-section" id="white-section">
        <div class="content-container" data-aos="fade-up">
            <h2 class="section-subtitle text-uppercase">Funcionalidades</h2>
            <h3 class="text-center display-6 fw-bold mt-4 text-title2">Transforme desafios em soluções</h3>
            <p class="text-center">Revolucione seu atendimento com Resolut.on</p>
            <div class="row row-cols-1 row-cols-md-2 g-4 mt-4">
                <!--Card 1-->
                <div class="col" data-aos="fade-up" data-aos-delay="50">
                    <div class="custom-card h-100">
                        <span class="color fw-bold fs-5">01</span>
                        <h4 class="card-title">Descrição da Funcionalidade</h4>
                        <p class="card-text">Implemente um serviço que torna possível a adoção de estratégias para organizar o fluxo de trabalho, priorizar tarefas urgentes e maior eficiência na resolução de problemas.</p>
                    </div>
                </div>
                <!--Card 2-->
                <div class="col" data-aos="fade-up" data-aos-delay="50">
                    <div class="custom-card h-100">
                        <span class="color fw-bold fs-5">02</span>
                        <h4 class="card-title">Status do chamado</h4>
                        <p class="card-text">Cada chamado pode ter três status distintos: Aberto, onde a solicitação é registrada; Em Andamento, onde a equipe de suporte trabalha na resolução; e Concluído, quando o problema é solucionado.</p>
                    </div>
                </div>
                <!--Card 3-->
                <div class="col" data-aos="fade-up" data-aos-delay="50">
                    <div class="custom-card h-100">
                        <span class="color fw-bold fs-5">03</span>
                        <h4 class="card-title">Sala de equipamentos</h4>
                        <p class="card-text">Esta funcionalidade permite que os usuários atribuam chamados relacionados a equipamentos específicos.</p>
                    </div>
                </div>
                <!--Card 4-->
                <div class="col" data-aos="fade-up" data-aos-delay="50">
                    <div class="custom-card h-100">
                        <span class="color fw-bold fs-5">04</span>
                        <h4 class="card-title">Comunicação por chat</h4>
                        <p class="card-text">Permite que os usuários e membros da equipe de suporte se comuniquem diretamente por meio de um chat em tempo real.</p>
                    </div>
                </div>
            </div> 
        </div>
    </section>

<!-- Seção Criadores -->
    <div class="background">
        <div class="container py-5">
            <h2 class="text-center display-6 text-white fw-bold mt-3 mb-10 border-bottom border-primary">Criadores</h2>
            <div class="row justify-content-center g-4 mt-3 card-creator">
                <!-- Card 1 -->
                <div class="col-12 col-md-4 d-flex justify-content-center">
                    <div class="card h-100">
                        <img src="./assets/img/Lais.jpg" class="card-img-top rounded-circle mx-auto d-block mt-3" alt="Foto do Criador 1">
                        <div class="card-body d-flex flex-column">
                            <h5 class="text-white text-center">Laís Liborio</h5>
                            <div class="d-flex justify-content-center">
                                <a class="btn btn-primary mt-3" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Ver mais</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="col-12 col-md-4 d-flex justify-content-center">
                    <div class="card card h-100">
                        <img src="./assets/img/Marcio.jpg" class="card-img-top rounded-circle mx-auto d-block mt-3" alt="Foto do Criador 2">
                        <div class="card-body d-flex flex-column">
                            <h5 class="text-white text-center">Marcio Gustavo</h5>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-primary mt-3" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Ver mais</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="col-12 col-md-4 d-flex justify-content-center">
                    <div class="card h-100">
                        <img src="./assets/img/Victor.jpg" class="card-img-top rounded-circle mx-auto d-block mt-3" alt="Foto do Criador 3">
                        <div class="card-body d-flex flex-column">
                            <h5 class="text-white text-center">Victor Ramos</h5>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-primary mt-3" data-bs-target="#exampleModalToggle3" data-bs-toggle="modal">Ver mais</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <!--Footer-->
    <footer class="footer text-white py-4">
        <div class="container ">
            <div class="row">
                <div class="col-md-4">
                    <img src="./assets/img/logolandingpage.png" class="logo2 img-fluid w-1" alt="Logo Resolut.on"> 
                    </div>
                <div class="col-md-4">
                    <h5>Links Úteis</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Home</a></li>
                        <li><a href="#white-section" class="text-white">Funcionalidades</a></li>
                        <li><a href="#" class="text-white">Faq</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contato</h5>
                        <a href="mailto:resolut.on.contact@gmail.com" class="text-white">resolut.on.contact@gmail.com</a>
                </div>            
            </div>
            <div class="row mt-3">
                <div class="col text-center">
                    <p class="mb-0 border-top">&copy; 2024 Resolut.on. Todos os direitos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

 <!--Modal-->
    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col">
                    <div class="card h-70 card-modal">
                        <img src="./assets/img/Lais.jpg" class="card-img-top" alt="Foto do Criador 1">
                        <div class="card-body">
                            <h5 class="text-white text-center fs-4">Laís Liborio</h5>
                            <p class="card-text text-white fs-5">Olá, meu nome é Lais, e fui responsável pela elaboração e documentação do projeto Resolut.on, garantindo que todos os detalhes fossem meticulosamente registrados.</p>
                            <div class="d-flex justify-content-between">
                                <a href="" class="btn btn-primary">Linkedin</a>
                                <a href="#" class="btn btn-dark">GitHub</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal" aria-label="Close">Fechar</button>
                <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Proximo</button>
            </div>
        </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col">
                    <div class="card h-70 card-modal">
                        <img src="./assets/img/Marcio.jpg" class="card-img-top" alt="Foto do Criador 2">
                        <div class="card-body">
                            <h5 class="text-white text-center fs-4">Marcio Gustavo</h5>
                            <p class="card-text text-white fs-5">Olá, meu nome é Marcio, e fui responsável pela criação e desenvolvimento da parte visual do projeto Resolut.on, assegurando que a estética refletisse a identidade da marca.</p>
                            <div class="d-flex justify-content-between">
                                <a href="https://www.linkedin.com/in/marcio-gustavo-i-2b9496286?lipi=urn%3Ali%3Apage%3Ad_flagship3_profile_view_base_contact_details%3BMvWf0rL8SQeTTg7dZ%2F%2FllA%3D%3Ds" class="btn btn-primary">Linkedin</a>
                                <a href="https://github.com/Marcio-gustavoI" class="btn btn-dark">GitHub</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal" aria-label="Close">Fechar</button>
                    <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Voltar</button>
                    <button class="btn btn-primary" data-bs-target="#exampleModalToggle3" data-bs-toggle="modal">Proximo</button>
                </div>
            </div>
        </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalToggle3" aria-hidden="true" aria-labelledby="exampleModalToggleLabel3" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">  
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col">
                    <div class="card h-70 card-modal">
                        <img src="./assets/img/Victor.jpg" class="card-img-top" alt="Foto do Criador 3">
                        <div class="card-body">
                            <h5 class="text-white text-center fs-4">Victor</h5>
                            <p class="card-text text-white fs-5">Olá, meu nome é Victor, e fui responsável pelo desenvolvimento da parte funcional e do backend do projeto Resolut.on, implementando soluções robustas para garantir o desempenho ideal.
                            </p>
                            <div class="d-flex justify-content-between">
                                <a href="https://www.linkedin.com/in/victor-ramos-2a9ab1291?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app" class="btn btn-primary">Linkedin</a>
                                <a href="http://Github.com/Ramos-Victor" class="btn btn-dark">GitHub</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class=" btn btn-warning" data-bs-dismiss="modal" aria-label="Close">Fechar</button>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Voltar</button>
                    <div>    
                </div>
            </div>
        </div>
        </div>
    </div>

  <!--Bootstrap JS--> 
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AOS Script -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    
</body>
</html>
