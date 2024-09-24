<?php
    require_once 'header.php';
?>
<style>
	.card{
		margin-top: 40%;
	}
	.btn{
		background-color: #ffd700;
		color:white;
	}
	.card{
		border-radius: 10px;
	}
	.container-fluid{
		background: rgb(3,48,92);
		background: linear-gradient(90deg, rgba(3,48,92,1) 49%, rgba(0,0,0,1) 100%);
		height: 100vh;
	}
</style>
	<div class="container-fluid">
		<div class="row d-flex justify-content-center h-100">
			<div class="col-sm-4 ">
				<div class="card ">
					<div class="card-body">
						<h1 class="font-cutes text-center">
							Resoluton
						</h1>
						<br>
						<form method="post" action="validar.php" class="form-group">
						<div  class="form-outline mb-4">
							<label class="form-label"><h4>Endereço de Email: </h4></label>
							<input type="email" name="email" id="email" class="form-control" required/>
						</div>

						<div class="form-outline mb-4">
							<label class="form-label"><h4>Sua senha: </h4></label>
							<input type="password" name="senha" id="senha" class="form-control" required/>
						</div>
						<input type="submit" class="btn form-control" value="Entrar"/>	
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>