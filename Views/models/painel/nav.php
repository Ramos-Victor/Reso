<style>
button {
    background: none;
}

.navbar-light .navbar-nav .nav-link:hover {
    color: #ffd700;
    text-decoration: none;
}

.navbar-light .navbar-nav .nav-link {
  color:#fff;
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
</style>

<nav class="navbar navbar-expand-lg fixed-top navbar-light">
    <a class="navbar-brand text-white ml-3" href="index.php" style="background-color:none;">
        <img src="/Reso/assets/img/logoresoluton.png" class="img-fluid reso" alt="Responsive image">
        Resolut.on
    </a>

    <button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/Reso/Views/models/unidades/">Voltar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/Reso/Views/models/painel/index.php">Dashboard </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/Reso/Views/models/painel/usuarios/index.php">Usuarios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/Reso/Views/models/painel/chamados/index.php">Chamados</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                    Equipamentos
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item a" href="/Reso/Views/models/painel/equipamentos/index.php">Equipamentos</a>
                    <a class="dropdown-item a" href="/Reso/Views/models/painel/salas/index.php">Salas</a>
                    <a class="dropdown-item a" href="/Reso/Views/models/painel/categorias/index.php">Categorias</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false"
                    data-placement="bottom">
                    <?= $_SESSION['usuario'] ?>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item a" href="#">Configurações</a>
                    <a class="dropdown-item a" href="/Reso/logout.php">Encerrar Sessão</a>
                </div>
            </li>
        </ul>
    </div>
</nav>