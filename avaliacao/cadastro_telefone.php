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
		include "conexao.php";
		
		$id=$_GET['id'];
		
		$sql = "SELECT * FROM clientes WHERE CPF = '$id'";
		
		$buscaNome = mysqli_query($conn, $sql);
		
		$cliente = mysqli_fetch_assoc($buscaNome);
	?>
	<div class="container">
		<div class="row">
			<div  class="column">
				<h1>Cadastro de Telefone para <?php echo $cliente['nome']; ?>.</h1>
				<form action="cadastro_telefone_script.php" method="POST">
				  <div class="mb-3">
					<label for="Numero" class="form-label">Digite o número <span style="color:red">*</span></label>
						<input type="number" class="form-control" name="telefone" placeholder="5541988884444" required>
					</div>
					<div class="mb-3">
						<input type="hidden" name = "CPF" value="<?php echo $id ?>">
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