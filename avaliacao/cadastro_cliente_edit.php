<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Alteração de Cadastro</title>
  </head>
  <body>
<!-- Uma mini biblioteca de funções & um conector automático ao banco de dados para cada página.-->   
	<?php
		include "conexao.php";
		// Estas instruções servem para buscar a informação que será prepenchida no form.
		$id = $_GET['id'] ?? '';
		$empresa = $_GET['empresa'] ?? '';
		$empresa = limpa_url($empresa);
		
		$sql = "SELECT * FROM clientes WHERE CPF = $id";
		
		$dados = mysqli_query( $conn, $sql );
		
		$linha = mysqli_fetch_assoc($dados);
		// Estas instruções servem para pegar informação relevante que não está presente em uma tabela.
		$sql = "SELECT * FROM empresas WHERE razaoSocial = '$empresa'";
		
		$dados = mysqli_query($conn, $sql);
		
		$check = mysqli_fetch_assoc($dados);
	?>
	
	<div class="container">
		<div class="row">
			<div  class="column">
				<h1>Alteração de Cadastro</h1>
				<!-- Aqui eu estou repetindo a tela de cadastro, porém, trazendo dados preenchidos e completando as barras de texto para o usuário. -->   
				<div id="emailHelp" class="form-text">Entradas incluindo um <span style="color:red">*</span></div>
				<form action="cliente_edit_script.php" method="POST">
					<div class="mb-3">
						<label for="Empresa" class="form-label">Empresa para a qual trabalha <span style="color:red">*</span></label>
					<!-- A linha que não pode mais ser alterada (por exemplo, uma empresa não podendo mais mudar de CNPJ) é preparada assim. Possui o atributo disabled e precisa forçar o valor a passar por um hidden input.-->   
						<input class="form-control" name="empresa" type="text" placeholder="<?php echo $linha['empresa']; ?>" value="<?php echo $linha['empresa']; ?>" disabled> 
						<input type="hidden" name="empresa" value="<?php echo $linha['empresa']; ?>">
						<input type="hidden" name="CPF" value="<?php echo $linha['CPF']; ?>">
					</div>
				<!-- Novamente, estou criando versões da mesma tela baseadas na informação que chega para o formulário. Aqui, eu tenho noção de que podia ter sido melhor otimizado; Existem algumas informações que são idêncidas de ambos os lados, mas, esta é a ideia de repetir o form e alterar as informações dependendo do tipo de usuário.. -->   
					
					<?php
						if ($check['UF'] == 'PR') {
							echo '
					<div class="mb-3">
						<label for="nome" class="form-label">Nome Completo <span style="color:red">*</span></label>
						<input type="text" class="form-control" name="nome" placeholder="João da Silva Silveira" value="'.$linha['nome'].'" required>
					</div>
					<div class="mb-3">
						<label for="CPF" class="form-label">CPF ou CNPJ <span style="color:red">*</span></label>
						<input class="form-control" type="number" name="CPF" placeholder="99999999999" value="'.$linha['CPF'].'" required disabled>
					</div>
					<div class="mb-3">
						<label for="email" class="form-label">Email</label>
						<input type="email" class="form-control" name="email" placeholder="email@dominio.com.br" value="'.$linha['email'].'" required>
					</div>
					<div class="mb-3">
						<label for="idade" class="form-label">Sua idade <span style="color:red">*</span></label>
						<input type="number" class="form-control" min="18" name="idade" placeholder="18" value="'.$linha['idade'].'" required>
						<div id="emailHelp" class="form-text">Empresas no PR não podem registrar clientes menores de idade.</div>
					</div>
					<div class="mb-3">
						<label for="RG" class="form-label">RG (Apenas no caso de pessoa física)</label>
						<input type="number" class="form-control" name="RG" placeholder="999999999" value="'.$linha['RG'].'">
					</div>
					<div class="mb-3">
						<label for="dt_nascimento" class="form-label">Data de nascimento (Apenas no caso de pessoa física)</label>
						<input type="date" class="form-control" name="dt_nascimento" value="'.$linha['dt_nascimento'].'">
					</div>						
					<div class="mb-3">
						<input type="submit" class="btn btn-success">					
					</div>
					</form>
					<a href="index.php" class="btn btn-primary"> Voltar para o início</a>
				</div>
			</div> 
		</div>';} 
		if ($check['UF'] != 'PR') {
			echo '
					<div class="mb-3">
						<label for="nome" class="form-label">Nome Completo <span style="color:red">*</span></label>
						<input type="text" class="form-control" name="nome" placeholder="João da Silva Silveira" value="'.$linha['nome'].'" required>
					</div>
					<div class="mb-3">
						<label for="CPF" class="form-label">CPF ou CNPJ <span style="color:red">*</span></label>
						<input type="number" oninput="maxLengthCheck(this) minxLengthCheck(this)" minlength=11 maxlength=14 class="form-control" name="CPF" placeholder="99999999999" value="'.$linha['CPF'].'" required>
					</div>
					<div class="mb-3">
						<label for="email" class="form-label">Email</label>
						<input type="email" class="form-control" name="email" placeholder="email@dominio.com.br" value="'.$linha['email'].'" required>
					</div>
					<div class="mb-3">
						<label for="idade" class="form-label">Sua idade <span style="color:red">*</span></label>
						<input type="number" class="form-control" name="idade" placeholder="18" value="'.$linha['email'].'">
					<div class="mb-3">
						<label for="RG" class="form-label">RG (Apenas no caso de pessoa física)</label>
						<input type="number" class="form-control" name="RG" placeholder="999999999" value="'.$linha['RG'].'">
					</div>
					<div class="mb-3">
						<label for="dt_nascimento" class="form-label">Data de nascimento (Apenas no caso de pessoa física)</label>
						<input type="date" class="form-control" name="dt_nascimento" value="'.$linha['RG'].'">
					</div>	
						<input type="submit" class="btn btn-success">					
					</div>
					</form>
					<a href="index.php" class="btn btn-primary"> Voltar para o início</a>
				</div>
			</div> 
		</div>';}
					?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

  </body>
</html>