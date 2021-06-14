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
		
		$id = $_GET['id'];
		// Estas instruções servem quase como um "listen", para executar a busca da barra de navegação.
		$sql = "SELECT * FROM empresas WHERE CNPJ = $id";
		
		$dados = mysqli_query( $conn, $sql );
		
		$linha = mysqli_fetch_assoc($dados);
	?>
	
	<div class="container">
		<div class="row">
			<div  class="column">
				<h1>Alteração de Cadastro</h1>
				<div id="emailHelp" class="form-text">Entradas incluindo um <span style="color:red">*</span></div>
				<!-- Aqui eu estou repetindo a tela de cadastro, porém, trazendo dados preenchidos e completando as barras de texto para o usuário. -->   
				<form action="empresa_edit_script.php" method="POST">
				  <div class="mb-3">
					<label for="razaoSocial" class="form-label">Razão Social <span style="color:red">*</span></label>
					<input type="text" class="form-control" name="razaoSocial" placeholder="Razão Social da empresa em questão" required value="<?php echo $linha['razaoSocial']; ?>">
				  </div>
				  <div class="mb-3">
					<label for="UF" class="form-label">UF <span style="color:red">*</span></label>
					<select class="form-select" name="UF" >PR
						<?php while ($row = mysqli_fetch_array($listaUF)){ 
							if ($row['UF'] == $linha['UF']) {
								echo "<option selected=\"selected\">". $row['UF']."</option>"; 
							} else { 
								echo "<option>". $row['UF']."</option>";
							};
						}; ?>
					</select>
				  </div>
				  <div class="mb-3">
					<label for="CNPJ" class="form-label">CNPJ <span style="color:red">*</span></label>
					<!-- A linha que não pode mais ser alterada (por exemplo, uma empresa não podendo mais mudar de CNPJ) é preparada assim. Possui o atributo disabled e precisa forçar o valor a passar por um hidden input.-->   

					<input type="text" class="form-control" name="CNPJ" value="<?php echo $linha['CNPJ']; ?>" placeholder="<?php echo $linha['CNPJ']; ?>" disabled>
					<div id="emailHelp" class="form-text">O CNPJ inclui 14 digitos.</div>
				  </div>
				  <div class="mb-3">
					<input type="hidden" name ="CNPJ" value="<?php echo $linha['CNPJ']; ?>">
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