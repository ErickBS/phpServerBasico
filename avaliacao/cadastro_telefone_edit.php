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
		$id = $_GET['id'];
		
		$sql = "SELECT * FROM telefones WHERE numero = $id";
		
		$dados = mysqli_query( $conn, $sql );
		
		$linha = mysqli_fetch_assoc($dados);
	?>
	
	<div class="container">
		<div class="row">
			<div  class="column">
				<h1>Alteração de Cadastro</h1>
				<!-- Aqui eu estou repetindo a tela de cadastro, porém, trazendo dados preenchidos e completando as barras de texto para o usuário. -->   				
				<form action="telefone_edit_script.php" method="POST">
				  <div class="mb-3">
					<label for="numero" class="form-label">Digite o número <span style="color:red">*</span></label>
					<input type="number" class="form-control" name="telefone" placeholder="5541988884444" required value="<?php echo $linha['numero']; ?>">
					</div>
				  <div class="mb-3">
					<label for="CPF" class="form-label">Este número pertence a este CPF/CNPJ: <span style="color:red">*</span></label>
					<input type="number" class="form-control" name="CPF" value="<?php echo $linha['CPF']; ?>">
					</div>
				  <div class="mb-3">
					<input type="submit" class="btn btn-success">					
				  </div>
				</form>
				<a href="index.php" class="btn btn-primary"> Voltar para o início</a>
			</div>
		</div> 
	</div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

  </body>
</html>