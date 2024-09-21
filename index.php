<?php
    require_once 'header.php';
?>

<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-body">
						<h1 class="font-cutes text-center">
							Resoluton
						</h1>
						<br>
						<form method="post" action="validar.php" class="form-group">
							<input 
								type="email" 
								name="email" 
								class="form-control" 
								placeholder="Seu e-mail" 
								required>
							<br>
							<input 
								type="password" 
								name="senha" 
								class="form-control" 
								placeholder="Sua senha" 
								required>
							<br>
							<input 
								type="submit" 
								name="action" 
								class="btn btn-outline-success btn-block" 
								value="Entrar">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>