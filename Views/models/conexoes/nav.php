<style>
button {
    background: none;
}

.reso {
    width: 2.5rem;
    height: 2.5rem;
    border-radius: 50%;
}
</style>

<nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #03305c">
    <a class="navbar-brand text-white ml-3" href="index.php">
        <img src="../../../assets/img/logoresoluton.png" class="img-fluid reso" alt="Responsive image">
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
            <a class="nav-link text-white" href="#">Configurações</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="#">
              <?php echo strtoupper($_SESSION['usuario']) ?>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="../logout.php">Encerrar Sessão</a>
          </li>
        </ul>
    </div>
</nav>