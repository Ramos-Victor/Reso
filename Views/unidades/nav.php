<style>
button {
    background: none;
}

.navbar-light .navbar-nav .nav-link:hover {
    color: #ffd700;
    text-decoration: none;
}

.navbar-light .navbar-nav .nav-link {
    color: #fff;
}

.show>.nav-link {
    color: #fff;
}

.reso {
    width: 4rem;
    height: 4rem;
    border-radius: 50%;
}

nav {
    background-color: #03305c;
}

.dropdown-menu {
    left: auto !important;
    right: 0;
    max-width: 400px;
    overflow-x: hidden;
}

.a{
font-family: "bene";
}
</style>

<nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #03305c">
    <a class="navbar-brand a text-white ml-3" href="?route=/unidades">
        <img src="/Reso/assets/img/logoresoluton.png" class="img-fluid reso" alt="Responsive image">
        Resolut.on
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <?php
               if($_SESSION['cargoReso']==2){
            ?>
            <li class="nav-item">
                <a class="nav-link" href="?route=/faq">FAQ</a>
            </li>
            <?php
            }
            ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false"
                    data-placement="bottom">
                    <img src="<?php if($_SESSION['imgPerfil']){ echo "assets/img/PerfilImgs/".$_SESSION['imgPerfil'];}else{ echo "assets/img/PerfilImgs/iconpadraoperfil.png";} ?>" alt="Profile" class="rounded-circle mr-2"
                        style="width: 30px; height: 30px; object-fit: cover;">
                    <?= $_SESSION['usuario'] ?>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="?route=/config">Perfil</a>
                    <a class="dropdown-item" href="?route=/logout">Encerrar Sessão</a>
                </div>
            </li>
        </ul>
    </div>
</nav>