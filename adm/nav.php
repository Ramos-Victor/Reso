
 <div id="sidebar">
    <div class="container-fluid">
      <div class="d-flex flex-row align-self-baseline titulo">
        <img src="../assets/img/logoresoluton.jpg" class="img-fluid reso" alt="Logo-Resolution">
        <h4 class="text-white">Resolut.on</h4>
      </div>

      <div class="divisor"></div>

      <ul class="nav flex-column" style="margin-top:0.5rem">
        <li class="nav-item d-flex flex-row align-self-baseline">
          <i class="bi bi-bar-chart-fill"></i>
          <a class="nav-link" href="index.php">Dashboard</a>
        </li>
        <li class="nav-item d-flex flex-row align-self-baseline">
          <i class="bi bi-telephone-fill"></i>
          <a class="nav-link" href="#">Chamados</a>
        </li>
        <li class="nav-item d-flex flex-row align-self-baseline">
          <i class="bi bi-house-gear-fill"></i>
          <a class="nav-link" href="#">Salas</a>
        </li>
        <li class="nav-item d-flex flex-row align-self-baseline">
          <i class="bi bi-pc-display"></i>
          <a class="nav-link" href="equipamento.php">Equipamentos</a>
        </li>
      </ul>

      <div class="divisor"></div>
      
      <ul class="nav flex-column" style="margin-top:0.5rem">
        <li class="nav-item d-flex flex-row align-self-baseline">
          <i class="bi bi-question-circle-fill"></i>
          <a class="nav-link" href="#">FAQ</a>
        </li>
      </ul>

      <div class="divisor"></div>

      <ul class="nav flex-column" style="margin-top:0.5rem">
        <li class="nav-item d-flex flex-row align-self-baseline">
          <i class="bi bi-people-fill"></i>
          <a class="nav-link" href="#">Usuarios</a>
        </li>
      </ul>

    </div>
   
  <div class="container-fluid">
    <div class="divisor"></div>

    <ul class="nav flex-column" style="margin-top:0.5rem">
      <li class="nav-item d-flex flex-row align-self-baseline">
        <i class="bi bi-gear"></i>
        <a class="nav-link" href="#">Configurações</a>
      </li>
      <li class="nav-item d-flex flex-row align-self-baseline">
        <i class="bi bi-person-circle"></i>
        <a class="nav-link" href="#"><?php echo $_SESSION['usuario']?></a>
        <a class="btn btn-sm sair" href="../logout.php">
          <i class="bi bi-box-arrow-left"></i>
        </a>
      </li>
    </ul>
  </div>
</div>

 