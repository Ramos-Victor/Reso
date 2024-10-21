<style>
    button{
        background: none;
    }
    a:hover{
        color: #ffd700;
        text-decoration: none;
    }
    
    a{
      color:#fff;
    }

</style>
<div id="sidebar">
    <div class="container-fluid">
      <div class="d-flex flex-row titulo">
        <img src="../assets/img/logoresoluton.png" class="img-fluid reso" alt="Logo-Resolution">
        <h5 class="text-white mt-2">Resolut.on</h5>
      </div>

      <div class="divisor"></div>

      <ul class="nav flex-column mx-auto" style="row-gap:1rem">
        <li class="nav-item">
          <a class="d-flex flex-row texto" href="index.php">
            <i class="navicon bi bi-bar-chart-fill"></i>
            dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="d-flex flex-row texto" href="unidades.php">
          <i class="navicon bi bi-telephone-fill"></i>
            chamados
          </a>
        </li>
        <li class="nav-item ">
          <a class="d-flex flex-row texto" href="equipamento.php">
          <i class="navicon bi bi-tools"></i>
            manuntenção
          </a>
        </li>
        <li class="nav-item ">
          <a class="d-flex flex-row texto" href="usuarios.php">
          <i class="navicon bi bi-people-fill"></i>
            Usuarios
          </a>
        </li>
        <li class="nav-item">
          <a class="d-flex flex-row texto" href="../conexoes/conexao.php">
            <i class="navicon bi bi-arrow-90deg-left"></i>
            Voltar
          </a>
        </li>
      </ul>
  </div>
  <div class="container-fluid items">
    <div class="divisor"></div>

    <ul class="nav flex-column final mx-auto" style="row-gap:1rem">
      <li class="nav-item">
        <a class="d-flex flex-row texto" href="#">
        <i class="navicon bi bi-gear"></i>
        Configurações
        </a>
      </li>
      <li class="nav-item">
        <a class="d-flex flex-row texto"  href="#">
          <i class="navicon bi bi-person-circle"></i>
          <?php echo $_SESSION['usuario']?>
        </a>
      </li>
      <li class="nav-item">
        <a class="sair d-flex flex-row texto" href="../logout.php">
          <i class="navicon bi bi-box-arrow-left"></i>
          Sair
        </a>
      </li>
    </ul>
  </div>
</div>

 