<!doctype html>
<!-- INFORMAÇÕES GERAIS PARA A AVALIAÇÂO;
	Vou listar algumas informações aqui que são relevantes para o processo.
	
	Eu criei uma DB no /phpmyadmin chamado avaliacao, para este projeto. A primeira coisa que fiz foi criar uma tabela contendo os 27 UFs do Brasil, numa única coluna UF VARCHAR (2);
	Eu criei uma tabela chamada empresas, contendo três colunas: UF VARCHAR (2), razaoSocial VARCHAR (200), CNPJ BIGINT PRIMARY
	Eu criei uma tabela chamada clientes, contendo 8 colunas: empresa VARCHAR (200), nome VARCHAR (200), CPF BIGINT PRIMARY, dt_cadastro datetime, email VARCHAR (200), idade int, RG bigint, dt_nascimento date;
	Eu criei uma tabela chamada  telefones, contendo duas colunas: CPF BIGINT, numero bigint
-->
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Empresa</title>
  </head>
  <body>
    
	<div class="container">
		<div class="row">
			<div class ="column">
				<div class="bg-light p-5 rounded-lg m-3">
					<h1 class="display-4">Cadastro Web</h1>
					<p class="lead">Este é um sistema simplificado de cadastros. Base de estudos para criação de sistemas web com PHP e MySQL.</p>
					<p> Em sua maioria, está usando tecnologias básicas de PHP. Não sou familiar com a utilização de frameworks, por enquanto, e  esta é a melhor exibição do meu controle sobre programação neste dado momento.</p>
					<p> Fiz o melhor que pude para comentar o código, em todas suas páginas e funções. No começo do index.php, há algumas informações sobre o banco de dados.</p>
					<p> Aqui, estou utilizando uma versão adaptada do Jumbotron para Bootstrap 5, porque foi a versão utilizada no projeto. </p>
					<hr class="my-4">
					<p>Acesse às funções.</p>
					<a class="btn btn-primary btn-lg" href="cadastro_empresa.php" role="button">Cadastro de empresas</a>
					<br />
					<br />
					<a class="btn btn-primary btn-lg" href="cadastro_cliente.php" role="button">Cadastro de clientes</a>
					<br />
					<br />
					<a class="btn btn-primary btn-lg" href="pesquisa_empresa.php" role="button">Pesquisa de empresas</a>
					<br />
					<br />
					<a class="btn btn-primary btn-lg" href="pesquisa_cliente.php" role="button">Pesquisa de clientes</a>
				</div>
			</div>
		</div> 
	</div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

  </body>
</html>