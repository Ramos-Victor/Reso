<style>
    button{
        background: none;
    }
</style>
<div id="sidebar">
    <div class="container-fluid">
      <div class="d-flex flex-row align-self-baseline titulo">
        <img src="../assets/img/logoresoluton.jpg" class="img-fluid reso" alt="Logo-Resolution">
        <h4 class="text-white">Resolut.on</h4>
      </div>

      <div class="divisor"></div>

      <ul class="nav flex-column" style="margin-top:0.5rem">
        <li class="nav-item d-flex flex-row align-self-baseline">
          <i class="navicon bi bi-house-fill"></i>
          <a class="nav-link" href="unidades.php">Conexões</a>
        </li>
      </ul>

    </div>
   
  <div class="container-fluid">
    <div class="divisor"></div>

    <ul class="nav flex-column" style="margin-top:0.5rem">
      <li class="nav-item d-flex flex-row align-self-baseline">
        <i class="navicon bi bi-gear"></i>
        <a class="nav-link" href="#">Configurações</a>
      </li>
      <li class="nav-item d-flex flex-row align-self-baseline">
        <i class=" navicon bi bi-person-circle"></i>
        <a class="nav-link" href="#"><?php echo $_SESSION['usuario']?></a>
        <a class="navicon btn btn-sm sair" href="../logout.php" style="margin-top:0.5rem">
          <i class="bi bi-box-arrow-left"></i>
        </a>
      </li>
    </ul>
  </div>
</div>

 