<style>
    button{
        background: none;
    }

</style>
<div id="sidebar" class="row">
<div class="container-fluid">
      <div class="d-flex flex-row titulo mx-auto ">
        <img src="../assets/img/logoresoluton.png" class="img-fluid reso" alt="Logo-Resolution">
        <h5 class="text-white mt-2">Resolut.on</h5>
      </div>

      <div class="divisor"></div>

      <ul class="nav flex-column" style="margin-top:0.5rem">
        <li class="nav-item">
          <a class="nav-link d-flex flex-row align-self-baseline texto" href="unidades.php">
          <i class="navicon bi bi-house-fill"></i>
            Conexões
          </a>
        </li>
      </ul>

    </div>
   
  <div class="container-fluid">
    <div class="divisor"></div>

    <ul class="nav flex-column final" style="margin-top:0.5rem">
      <li class="nav-item">
        <a class="nav-link d-flex flex-row align-self-baseline texto" href="#">
        <i class="navicon bi bi-gear"></i>
        Configurações
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link d-flex flex-row align-self-baseline texto"  href="#">
          <i class="navicon bi bi-person-circle"></i>
          <?php echo $_SESSION['usuario']?>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link sair d-flex flex-row align-self-baseline texto" href="../logout.php">
          <i class="navicon bi bi-box-arrow-left"></i>
          Sair
        </a>
      </li>
    </ul>
  </div>
</div>

 