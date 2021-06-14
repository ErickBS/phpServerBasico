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
				<!-- Aqui, eu atribuo as variáveis que recebi do POST para ter meus valores melhor organizados. Aqui estão os atributos de um cliente, e então, uma função para conectar ao DB e incluí-las.-->
			<?php 
				include "conexao.php";
				$empresa = $_POST['empresa'] ?? '';
				$nome = $_POST['nome'];
				$CPF = $_POST['CPF'];
				$dt_cadastro = date('m/d/Y h:i:s a', time());
				$dt_cadastro = limpa_data($dt_cadastro);
				$email = $_POST['email'];
				$idade = $_POST['idade'];
				$telefone = $_POST['telefone'];
				$RG = $_POST['RG'] ?? '';
				$dt_nascimento = $_POST['dt_nascimento'] ?? '';
		// Dada a diferença de como CPFs e CNPJs se comportam, eu usei um IF para condensar tudo na mesma função.
				
				if ($RG != NULL && $dt_nascimento != NULL) {
				$sql1 = "INSERT INTO clientes
				(empresa, nome, CPF, dt_cadastro, email, idade, RG, dt_nascimento) VALUES
				('$empresa','$nome','$CPF','$dt_cadastro','$email', '$idade', '$RG', '$dt_nascimento')";
				}
				else {
					$sql1 = "INSERT INTO clientes
				(empresa, nome, CPF, dt_cadastro, email, idade) VALUES
				('$empresa','$nome','$CPF','$dt_cadastro','$email', '$idade')";
				};
				
				$sql2 = "INSERT INTO telefones
				(CPF, numero) VALUES
				($CPF, $telefone);";
				
				if (mysqli_query($conn, $sql1)) {
					mensagem("$nome cadastrado com sucesso!", 'success');
					mysqli_query($conn, $sql2);
				} else {
					mensagem("$nome não cadastrado", 'danger');
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