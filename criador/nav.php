<style>
    button{
        background: none;
    }

    @media(max-width: 1000px){
     #sidebar{
        width: 7rem;
    }
    #main-content{
      margin-left: 8rem;
    }

    .texto, .reso-texto{
      display: none;
    }

    .bi{
      font-size: 2rem;
    }

    .reso{
      width: 2rem;
      height: 2rem;
      margin-left: 1rem;
    }

    .final{
      display: flex;
      flex-direction: row;
    }
   }
</style>
<div id="sidebar" class="row">
    <div class="container-fluid">
      <div class="d-flex flex-row align-self-baseline titulo">
        <img src="../assets/img/logoresoluton.png" class="img-fluid reso" alt="Logo-Resolution">
        <h4 class="text-white reso-texto">Resolut.on</h4>
      </div>

      <div class="divisor"></div>

      <ul class="nav flex-column" style="margin-top:0.5rem">
        <li class="nav-item ">
          <a class="nav-link d-flex flex-row align-self-baseline" href="unidades.php">
          <i class="navicon bi bi-house-fill"></i>
            <p class="texto">Conexões</p>
          </a>
        </li>
      </ul>

    </div>
   
  <div class="container-fluid">
    <div class="divisor"></div>

    <ul class="nav flex-column final" style="margin-top:0.5rem">
      <li class="nav-item">
        <a class="nav-link d-flex flex-row align-self-baseline" href="#">
        <i class="navicon bi bi-gear"></i>
        <p class="texto">Configurações</p>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link d-flex flex-row align-self-baseline"  href="#">
          <i class="navicon bi bi-person-circle"></i>
          <p class="texto"><?php echo $_SESSION['usuario']?></p>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link sair d-flex flex-row align-self-baseline" href="../logout.php">
          <i class="navicon bi bi-box-arrow-left"></i>
          <p class="texto text-white">Sair</p>
        </a>
      </li>
    </ul>
  </div>
</div>

 