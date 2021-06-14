<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Cadastro</title>
  </head>
  <body>
<!-- Uma mini biblioteca de funções & um conector automático ao banco de dados para cada página.-->

	<?php
		$pesquisa= $_POST['empresa'] ?? '';
		
		include "conexao.php";
		//O intuito aqui, como dá pra ver abaixo, era aglomerar todos os diferentes tipos de cadastro de cliente em uma única página. Então, seja CPF, seja CNPJ, seja no PR ou não, tudo está nesta página. Ele lê pelo GET da URL qual forma deve vestir.
		$sql = "SELECT * FROM empresas WHERE razaoSocial LIKE '%$pesquisa%'";
		
		$dados = mysqli_query($conn, $sql);
		
		$linha = mysqli_fetch_assoc($dados);
		
	?>
	
	<?php if ($pesquisa=='') {
		echo'
<!--"echo" todas as instruções pode atrapalhar a leitura, mas, permite aglomerar todas as versões diferentes na mesma página. Imagino que existam soluções mais fáceis para isso, e também que frameworks ajudem com este problema, mas, isso é uma solução básica para o problema. -->
	<div class="container">
		<div class="row">
			<div  class="column">
				<h1>Cadastro</h1>
				<div id="emailHelp" class="form-text">Entradas incluindo um <span style="color:red">*</span> são necessárias.</div>
				<form action="cadastro_cliente.php" method="POST">
				  <div class="mb-3">
					<label for="Empresa" class="form-label">Empresa à qual pertence este cliente <span style="color:red">*</span></label>
					<select class="form-select" name="empresa" required>
						';
						while ($row = mysqli_fetch_array($listaEmpresas)){ 
						echo "<option>". $row['razaoSocial']."</option>";
						};
						echo '
					</select>
				  </div>
				  
				  <div class="mb-3">
					<input type="submit" class="btn btn-success">					
				  </div>
				</form>
				<a href="index.php" class="btn btn-primary"> Voltar para o início</a>
			</div>
		</div> 
	</div>';}
	else {
		echo'
	
	<div class="container">
		<div class="row">
			<div  class="column">
				<h1>Cadastro</h1>
				<div id="emailHelp" class="form-text">Entradas incluindo um <span style="color:red">*</span> são necessárias.</div>
				<form action="cadastro_cliente_script.php" method="POST">
				<div class="mb-3">
					<label for="Empresa" class="form-label">Empresa para a qual trabalha <span style="color:red">*</span></label>
					<input class="form-control" name="empresa" type="text" placeholder="'.$pesquisa.'" value ="'.$pesquisa.'" disabled> 
				</div>'; 
	
		if ($linha['UF'] == 'PR') {
			echo '
					<div class="mb-3">
						<label for="nome" class="form-label">Nome Completo <span style="color:red">*</span></label>
						<input type="text" class="form-control" name="nome" placeholder="João da Silva Silveira" required>
					</div>
					<div class="mb-3">
						<label for="CPF" class="form-label">CPF ou CNPJ <span style="color:red">*</span></label>
						<input type="number" oninput="maxLengthCheck(this) minxLengthCheck(this)" minlength=11 maxlength=14 class="form-control" name="CPF" placeholder="99999999999" required>
					</div>
					<div class="mb-3">
						<label for="email" class="form-label">Email</label>
						<input type="email" class="form-control" name="email" placeholder="email@dominio.com.br" required>
					</div>
					<div class="mb-3">
						<label for="idade" class="form-label">Sua idade <span style="color:red">*</span></label>
						<input type="number" class="form-control" min="18" name="idade" placeholder="18" required>
						<div id="emailHelp" class="form-text">Empresas no PR não podem registrar clientes menores de idade.</div>
					</div>
					<div class="mb-3">
						<label for="telefone" class="form-label">Digite um telefone para contato <span style="color:red">*</span></label>
						<input type="number" class="form-control" name="telefone" placeholder="5541988884444" required>
					</div>
					<div class="mb-3">
						<label for="RG" class="form-label">RG (Apenas no caso de pessoa física)</label>
						<input type="number" class="form-control" name="RG" placeholder="999999999">
						
					</div>
					<div class="mb-3">
						<label for="dt_nascimento" class="form-label">Data de nascimento (Apenas no caso de pessoa física)</label>
						<input type="date" class="form-control" name="dt_nascimento">
					</div>						
					<div class="mb-3">
						<input type="hidden" name="empresa" value="'.$pesquisa.'">
						<input type="submit" class="btn btn-success">					
					</div>
					</form>
					<a href="index.php" class="btn btn-primary"> Voltar para o início</a>
				</div>
			</div> 
		</div>';} 
		if ($linha['UF'] != 'PR') {
			echo '
					<div class="mb-3">
						<label for="nome" class="form-label">Nome Completo <span style="color:red">*</span></label>
						<input type="text" class="form-control" name="nome" placeholder="João da Silva Silveira" required>
					</div>
					<div class="mb-3">
						<label for="CPF" class="form-label">CPF ou CNPJ <span style="color:red">*</span></label>
						<input type="number" oninput="maxLengthCheck(this) minxLengthCheck(this)" minlength=11 maxlength=14 class="form-control" name="CPF" placeholder="99999999999" required>
					</div>
					<div class="mb-3">
						<label for="email" class="form-label">Email</label>
						<input type="email" class="form-control" name="email" placeholder="email@dominio.com.br" required>
					</div>
					<div class="mb-3">
						<label for="idade" class="form-label">Sua idade</label>
						<input type="number" class="form-control" name="idade" placeholder="18" required>
					</div>
					<div class="mb-3">
						<label for="telefone" class="form-label">Digite um telefone para contato <span style="color:red">*</span></label>
						<input type="number" class="form-control" name="telefone" placeholder="5541988884444" required>
					</div>
					<div class="mb-3">
						<label for="RG" class="form-label">RG (Apenas no caso de pessoa física)</label>
						<input type="number" class="form-control" name="RG" placeholder="999999999">
						
					</div>
					<div class="mb-3">
						<label for="dt_nascimento" class="form-label">Data de nascimento (Apenas no caso de pessoa física)</label>
						<input type="date" class="form-control" name="dt_nascimento">
					</div>
					<div class="mb-3">
						<input type="hidden" name="empresa" value="'.$pesquisa.'">
						<input type="submit" class="btn btn-success">					
					</div>
					</form>
					<a href="index.php" class="btn btn-primary"> Voltar para o início</a>
				</div>
			</div> 
		</div>';}
	}
	?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

  </body>
</html>

<!--<div class="mb-3">
					<label for="endereco" class="form-label">Endereço</label>
					<input type="text" class="form-control" name="endereco" placeholder="Colo do capeta">
				  </div>
				  <div class="mb-3">
					<label for="telefone" class="form-label">Telefone</label>
					<input type="text" class="form-control" name="telefone" placeholder="222-eat-a-dick">
				  </div>
				  <div class="mb-3">
					<label for="email" class="form-label">Email</label>
					<input type="email" class="form-control" name="email" placeholder="evilness@yahoo.com.br">
					<div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
				  </div>
				  <div class="mb-3">
					<label for="dt_nascimento" class="form-label">Data de Nascimento</label>
					<input type="date" class="form-control" name="dt_nascimento" placeholder="06/06/2006">
				  </div>
				  <div class="mb-3">
					<label for="idade" class="form-label">Idade (*)</label>
					<input type="number" class="form-control" name="idade" placeholder="18" min="18" required>
				  </div>
				  -->