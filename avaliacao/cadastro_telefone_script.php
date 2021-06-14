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
    
	<div class="container">
		<div class="row">
			<?php 
				include "conexao.php";
				$CPF = $_POST['CPF'] ?? '';
				$telefone = $_POST['telefone'];
			
				$sql = "INSERT INTO telefones
				(CPF, numero) VALUES
				($CPF, $telefone);";
				
				if (mysqli_query($conn, $sql)) {
					mensagem("$telefone cadastrado com sucesso!", 'success');
					
				} else {
					mensagem("$telefone não cadastrado", 'danger');
					echo $CPF, $telefone;
				}
				
			?>
			<a href="index.php" class="btn btn-primary">Voltar</a>
		</div> 
	</div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

  </body>
</html>