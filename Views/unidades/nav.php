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

<nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #03305c">
    <a class="navbar-brand text-white ml-3" href="index.php">
        <img src="/Reso/assets/img/logoresoluton.png" class="img-fluid reso" alt="Responsive image">
        Resolut.on
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarNavDropdown">
        <div>
        </div>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="?route=/config">Configurações</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <?php echo strtoupper($_SESSION['usuario']) ?>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?route=/logout">Encerrar Sessão</a>
          </li>
        </ul>
    </div>
</nav>