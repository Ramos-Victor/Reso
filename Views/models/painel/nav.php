<style>
button {
    background: none;
}

a:hover {
    color: #ffd700;
    text-decoration: none;
}

.navbar-toggler{
    color: #ffd700;
}

a {
    color: #fff;
}

.reso {
  width: 2.5rem;
  height: 2.5rem;
  border-radius: 50%;
}

nav{
    background-color: #03305c;
}

.custom-toggler {
    background-color: #ffd700;
    border: none; 
}

.custom-toggler .navbar-toggler-icon {
    background-image: none; 
}

.custom-toggler:after {
    content: ''; 
    width: 1.5rem; 
    height: 1.5rem; 
    background-color: black; 
    display: inline-block;
}

</style>

<nav class="navbar navbar-expand-lg fixed-top">
  <a class="navbar-brand" href="index.php">
    <img src="/Reso/assets/img/logoresoluton.png" class="img-fluid reso" alt="Responsive image">
  </a>
  
  <button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="/Reso/Views/models/painel/index.php">Dashboard <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/Reso/Views/models/painel/chamados/index.php">Chamados</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
          Equipamentos
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="/Reso/Views/models/painel/equipamentos/index.php">Equipamentos</a>
          <a class="dropdown-item" href="/Reso/Views/models/painel/salas/index.php">Salas</a>
          <a class="dropdown-item" href="/Reso/Views/models/painel/categorias/index.php">Categorias</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
          <?php echo $_SESSION['usuario'] ?>
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="#">Configurações</a>
          <a class="dropdown-item" href="/Reso/logout.php">Encerrar Sessão</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
