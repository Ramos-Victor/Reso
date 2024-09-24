<?php  
	require_once 'header.php';
	require_once 'conect.php';
	if($_POST){
		ValidarLogin($_POST['email'], $_POST['senha']);
	}

	function ValidarLogin($email, $senha){
		$sql = 'select 
				cd_usuario, nm_usuario
				from tb_usuario 
				where
				nm_email = "'.$email.'" and
				cd_senha = sha2("'.$senha.'", 256)';
		$stmt = $GLOBALS['con']->query($sql);
		if($stmt->num_rows > 0){
			session_start();
			$r = $stmt->fetch_array();
			$_SESSION['id'] = $r['cd_usuario'];
			$_SESSION['usuario'] = $r['nm_usuario'];
			Confirma("Bem vindo ao Resolut.on", "unidades/unidades.php");
		}
		else{
			Erro("Acesso NEGADO!!");
		}
	}

	function Confirma($msg, $pagina){
		print'
			<div class="modal fade" id="myModal" data-backdrop="static">
				<div class="modal-dialog modal-md">
					<div class="modal-content">
						<div class="modal-body text-center font-weight-bolder text-primary">
							<i class="bi bi-check2-circle text-primary"></i>
							<br>
							<h3 class="titulo"><b>'.$msg.'</b></h3>
						</div>
						<div class="modal-footer">
							<button class="btn btn-primary btn-block mx-auto" onclick="redirecionar()">OK</button>
						</div>
					</div>
				</div>
			</div>
			<script>
				function redirecionar(){
					location.href = "'.$pagina.'";
				}
			</script>
		';
	}

	function Erro($msg){
		print'
			<div class="modal fade" id="myModal" data-backdrop="static">
				<div class="modal-dialog modal-md">
					<div class="modal-content">
						<div class="modal-body text-center font-weight-bolder text-danger">
							<i class="bi bi-x-circle text-danger"></i>
							<br>
							<h3><b>'.$msg.'</b></h3>
						</div>
						<div class="modal-footer">
							<button class="btn btn-danger btn-block mx-auto" onclick="redirecionar()">OK</button>
						</div>
					</div>
				</div>
			</div>
			<script>
				function redirecionar(){
					history.go(-1);
				}
			</script>
		';
	}

	require_once 'footer.php';
?>
<style>
	.myModal .modal-body{height: 370px;}
	i, .bi{font-size: 44pt;}
</style>
<script>
    $(document).ready(function(){
       $('#myModal').modal('show');
    });

    $('#myModal').on('shown.bs.modal', function(){
      $('#myInput').trigger('focus');
    });
</script>