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
    <?php include "conexao.php"; ?>
	
	<div class="container">
		<div class="row">
			<div  class="column">
				<h1>Cadastro</h1>
				<div id="emailHelp" class="form-text">Entradas incluindo um <span style="color:red">*</span> são necessárias.</div>
				<form action="cadastro_empresa_script.php" method="POST">
				  <div class="mb-3">
					<label for="razaoSocial" class="form-label">Razão Social <span style="color:red">*</span></label>
					<input type="text" class="form-control" name="razaoSocial" placeholder="Razão Social da empresa em questão" required>
					<!-- Aqui descobri que há algum problema com a presença de apóstrofes (') nesta entrada, não sei a razão -->
				  </div>
				  <div class="mb-3">
					<label for="UF" class="form-label">UF <span style="color:red">*</span></label>
					<!-- Uma busca recursiva das UF's baseados na tabela presente no DB.-->
					<select class="form-select" name="UF">
						<?php while ($row = mysqli_fetch_array($listaUF)){ 
						echo "<option>". $row['UF']."</option>";
						}; ?>
					</select>
				  </div>
				  <div class="mb-3">
					<label for="CNPJ" class="form-label">CNPJ <span style="color:red">*</span></label>
					<input type="text" class="form-control" name="CNPJ">
					<div id="emailHelp" class="form-text">O CNPJ inclui 14 digitos.</div>
					<!-- Aqui, tendo mais tempo, eu poderia ter criado validações para impedir que o usuário colocasse qualquer quantia de digitos diferente de 14 e para validar o número inserido.-->
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