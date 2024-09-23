<?php
    require_once 'header.php';
?>

	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-6">
				<div class="card">
					<div class="card-body">
						<h1 class="font-cutes text-center">
							Resoluton
						</h1>
						<br>
						<form method="post" action="validar.php" class="form-group">
						<div data-mdb-input-init class="form-outline mb-4">
							<label class="form-label" for="form2Example1">Endereço de Email</label>
							<input type="email" name="email" id="email" class="form-control" required/>
						</div>

						<div data-mdb-input-init class="form-outline mb-4">
							<label class="form-label" for="form2Example2">Sua Senha</label>
							<input type="password" name="senha" id="senha" class="form-control" required/>
						</div>
						<input  type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4" placeholder="Entrar"></input>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>