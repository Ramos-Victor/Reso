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

      <ul class="nav flex-column" style="row-gap:1rem">
        <li class="nav-item">
          <a class="d-flex flex-row texto" href="unidades.php">
          <i class="navicon bi bi-house-fill"></i>
            Conexões
          </a>
        </li>
      </ul>

    </div>
   
  <div class="container-fluid">
    <div class="divisor"></div>

    <ul class="nav flex-column final" style="row-gap:1rem">
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

 