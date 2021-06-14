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
    
	<div class="container">
		<div class="row">
			<?php 
				include "conexao.php";
				$nome = $_POST['nome'];
				$CPF = $_POST['CPF'];
				$email = $_POST['email'];
				$idade = $_POST['idade'];
				$RG = $_POST['RG'] ?? NULL; 
				$dt_nascimento = $_POST['dt_nascimento'] ?? NULL;
				
				
				if ($RG != NULL && $dt_nascimento != NULL) {
					$sql = "UPDATE clientes set
					nome = '$nome',
					email = '$email',
					idade = $idade,
					RG = '$RG',
					dt_nascimento = '$dt_nascimento'
					WHERE CPF = $CPF";
				}
				else {
					$sql = "UPDATE clientes set
					nome = '$nome',
					email = '$email',
					idade = $idade
					WHERE CPF = $CPF";
				}
				if (mysqli_query($conn, $sql)) {
					mensagem("$nome alterado com sucesso!", 'success');
				} else {
					mensagem("$nome não alterado", 'danger');
					echo $nome, $email, $idade, $RG, $dt_nascimento;
					echo $sql;
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