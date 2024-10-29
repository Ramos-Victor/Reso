<?php
    require_once 'header.php';
	include 'validar.php';
?>
<style>
	.card{
		margin-top: 40%;
	}
	.login{
		background-color: #F8CF40;
		color:black;
	}
	.card{
		border-radius: 20px;
	}
	.container-fluid{
		height: 100vh;
    background: linear-gradient(
            111deg,
            #0000ffb4 0%, 
            #0000b14f 50%, 
            #000000 100% 
        ),
        url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='400' height='400' viewBox='0 0 800 800'%3E%3Cg fill='none' stroke='%23444444' stroke-width='1'%3E%3Cpath d='M769 229L1037 260.9M927 880L731 737 520 660 309 538 40 599 295 764 126.5 879.5 40 599-197 493 102 382-31 229 126.5 79.5-69-63'/%3E%3Cpath d='M-31 229L237 261 390 382 603 493 308.5 537.5 101.5 381.5M370 905L295 764'/%3E%3Cpath d='M520 660L578 842 731 737 840 599 603 493 520 660 295 764 309 538 390 382 539 269 769 229 577.5 41.5 370 105 295 -36 126.5 79.5 237 261 102 382 40 599 -69 737 127 880'/%3E%3Cpath d='M520-140L578.5 42.5 731-63M603 493L539 269 237 261 370 105M902 382L539 269M390 382L102 382'/%3E%3Cpath d='M-222 42L126.5 79.5 370 105 539 269 577.5 41.5 927 80 769 229 902 382 603 493 731 737M295-36L577.5 41.5M578 842L295 764M40-201L127 80M102 382L-261 269'/%3E%3C/g%3E%3Cg fill='%23525055'%3E%3Ccircle cx='769' cy='229' r='5'/%3E%3Ccircle cx='539' cy='269' r='5'/%3E%3Ccircle cx='603' cy='493' r='5'/%3E%3Ccircle cx='731' cy='737' r='5'/%3E%3Ccircle cx='520' cy='660' r='5'/%3E%3Ccircle cx='309' cy='538' r='5'/%3E%3Ccircle cx='295' cy='764' r='5'/%3E%3Ccircle cx='40' cy='599' r='5'/%3E%3Ccircle cx='102' cy='382' r='5'/%3E%3Ccircle cx='127' cy='80' r='5'/%3E%3Ccircle cx='370' cy='105' r='5'/%3E%3Ccircle cx='578' cy='42' r='5'/%3E%3Ccircle cx='237' cy='261' r='5'/%3E%3Ccircle cx='390' cy='382' r='5'/%3E%3C/g%3E%3C/svg%3E"),
        #0e161e; 
	}

	
	input[type="submit"]:hover{
		background-color: #b4a030;
		color:black;
	}

</style>
	<div class="container-fluid">
		<div class="row d-flex justify-content-center h-100">
			<div class="col-sm-4 ">
				<div class="card shadow-lg p-3 mb-5 bg-white rounded">
					<div class="card-body">
						<img src="./assets/img/logoresoluton.png" alt="logoresoluton" style="width:200px; height:200px;margin-left:10.5rem;">
						<br>
						<br>
						<form method="post" class="form-group">
						<div  class="form-outline mb-3">
							<input type="email" name="email" id="email" class="form-control" placeholder="Digite seu email" required/>
						</div>
						<div  class="form-outline mb-3">
							<input type="text" name="usuario" id="usuario" class="form-control" placeholder="Digite seu usuario" maxlength="10" required/>
						</div>
						<div class="form-outline mb-3">
							<input type="password" name="senha" id="senha" class="form-control" placeholder="Digite sua senha" required/>
						</div>
						<input type="submit" class="btn form-control login" name="action" value="Cadastrar"/>
						<div>
						<br>
							<a href="login.php">Ja tem uma conta?</a>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

<?php
	if(!empty($_POST)){
		if($_POST['action']=="Cadastrar"){
			ValidarCadastro(
				$_POST['usuario'],
				$_POST['email'],
				$_POST['senha'],
				"./login.php"
			);
		}
	}
?>