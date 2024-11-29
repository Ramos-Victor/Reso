<?php
	require_once 'conect.php';
	require_once './email/email.php';

	function ValidarLogin($email, $senha){
		global $con;

		$sql = 'SELECT 
				cd_usuario, nm_usuario, nm_email, verificado
				FROM tb_usuario 
				WHERE
				nm_email = ? AND
				cd_senha = sha2(?, 256)';
		
		$stmt = $con->prepare($sql);
		$stmt->bind_param('ss', $email, $senha);  
		$stmt->execute();
		$result = $stmt->get_result();
		
		if($result->num_rows > 0){
			
			$r = $result->fetch_assoc();
			$_SESSION['id'] = $r['cd_usuario'];
			$_SESSION['usuario'] = $r['nm_usuario'];
			$_SESSION['verificado'] = $r['verificado'];
			$_SESSION['email'] = $r['nm_email'];
			Confirma("Bem vindo ao Resolut.on!", "?route=/unidades");
		} else {
			Erro("Acesso recusado!");
			session_destroy();
		}
	}

	function ValidarCadastro($usuario, $email, $senha) {
		global $con;
		
		if (empty($usuario) || empty($email) || empty($senha)) {
			Erro("Todos os campos são obrigatórios!");
			return false;
		}
		
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			Erro("Email inválido!");
			return false;
		}
		
		$sql = 'SELECT COUNT(*) as total FROM tb_usuario WHERE nm_usuario = ?';
		$sql2 = 'SELECT COUNT(*) as total FROM tb_usuario WHERE nm_email = ?';
		
		$stmt = $con->prepare($sql);
		if (!$stmt) {
			Erro("Erro na preparação da query: " . $con->error);
			return false;
		}
		
		$stmt->bind_param('s', $usuario);
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();

		$stmt->close();
		
		$stmt2 = $con->prepare($sql2);
		if (!$stmt2) {
			Erro("Erro na preparação da query: " . $con->error);
			return false;
		}
		
		$stmt2->bind_param('s', $email);
		$stmt2->execute();
		$result2 = $stmt2->get_result();
		$row2 = $result2->fetch_assoc();
		
		if ($row['total'] >= 1) {
			Erro("Usuário já cadastrado!");
			return false;
		}
		
		if ($row2['total'] >= 1) {
			Erro("Email já cadastrado!");
			return false;
		}
		
		
		return InserirUsuario($usuario, $email, $senha);
	}
	
	function InserirUsuario($usuario, $email, $senha) {
		$idAleatorio = gerarIdAleatorio(10); 

		global $con;
		
		$sql3 = 'INSERT INTO tb_usuario (cd_usuario, nm_usuario, nm_email, cd_senha) VALUES (?, ?, ?, sha2(?,256))';
		$stmt3 = $con->prepare($sql3);
		
		if (!$stmt3) {
			Erro("Erro na preparação da query de inserção: " . $con->error);
			return false;
		}
		
		$stmt3->bind_param('ssss', $idAleatorio, $usuario, $email, $senha);
		$res = $stmt3->execute();
		
		if ($res) {
			$sql4 = 'SELECT cd_usuario as ID FROM tb_usuario WHERE nm_email = ?';
			$stmt = $con->prepare($sql4);
			$stmt->bind_param('s', $email);
			$stmt->execute();
			$result = $stmt->get_result();
			
			if ($result->num_rows > 0) {
				$row3 = $result->fetch_assoc();
				$id = $row3['ID'];
				
				if (empty($id)) {
					Erro("ID do usuário não encontrado!");
					return false;
				}
				
				AutenticarEmail($email, $id);
				Confirma("Cadastrado com sucesso!<br> Um link de verificação foi enviado para o seu email.", "?route=/login");
				return true;
			} else {
				Erro("Não foi possivel encontrar o usuário cadastrado!");
				return false;
			}
		} else {
			Erro("Não foi possível cadastrar o usuário!");
			return false;
		}
	}

	function gerarIdAleatorio($tamanho = 8) {
		$caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		$id = '';
		for ($i = 0; $i < $tamanho; $i++) {
			$id .= $caracteres[rand(0, strlen($caracteres) - 1)];
		}
		return $id;
	}
	
	
		
	function Confirma($msg, $pagina){
		print'
			<div class="modal fade" id="myModal" data-backdrop="static">
				<div class="modal-dialog modal-md">
					<div class="modal-content">
						<div class="modal-body text-center font-weight-bolder text-primary">
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
.myModal .modal-body {
    height: 370px;
}

i,
.bi {
    font-size: 55px;
}
</style>
<script>
$(document).ready(function() {
    $('#myModal').modal('show');
});

$('#myModal').on('shown.bs.modal', function() {
    $('#myInput').trigger('focus');
});
</script>