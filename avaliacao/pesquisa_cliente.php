<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	
<!-- Esse link será utilizado para importar os ícones de flechas usadas na tabela para indicar a função de sort.-->
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    
	<title>Pesquisa</title>
  </head>
  <body>
<!-- Uma mini biblioteca de funções & um conector automático ao banco de dados para cada página.-->
	<?php
		$pesquisa= $_POST['busca'] ?? '';
		
		include "conexao.php";
		// Estas instruções servem quase como um "listen", para executar a busca da barra de navegação.
		$sql = "SELECT * FROM clientes WHERE nome LIKE '%$pesquisa%'";
		
		$dados = mysqli_query($conn, $sql);
		
	?>
							
	<div class="container">
		<div class="row">
			<div  class="column">
				<h1>Pesquisa</h1>
				<!-- Um sistema de busca para ajudar com a coleta de informação -->
				<nav class="navbar navbar-light bg-light">
				  <div class="container-fluid">
					<form class="d-flex" action="pesquisa_cliente.php" method="POST">
						<input class="form-control me-2" type="search" placeholder="Nome" aria-label="Search" name="busca" autofocus>
						<button class="btn btn-outline-success" type="submit">Pesquisar</button>
						<button class="btn btn-primary" type="reset">Limpar</button>
					</form>
				  </div>
				</nav>
				<!-- Uma tabela agradável para mostrar os dados, com algumas funcionalidades-->
				<table class="table table-hover" id="myTable">
					
					 <thead>
						<tr>
						<!-- Aqui, a tabela está executando a função sortTable, que está no fim do documento, e também inclui o ícone de sort para indicar que existe a função.-->
						  <th scope="col" onclick="sortTable(0)">Nome <i style="text-align:right" class="fa fa-fw fa-sort"></i></th>
						  <th scope="col" onclick="sortTable(1)">CPF/CPNJ <i style="text-align:right" class="fa fa-fw fa-sort"></i></th>
						  <th scope="col" onclick="sortTable(2)">Data de Cadastro <i style="text-align:right" class="fa fa-fw fa-sort"></i></th>
						  <th scope="col">Funções</th>
						</tr>
					  </thead>
					  <tbody>
					  <!-- Aqui estou recursivamente preenchendo a tabela com os dados-->
						<?php
							while ($linha = mysqli_fetch_assoc($dados) ) {
								$nome = $linha['nome'];
								$CPF = $linha['CPF'];
								$email = $linha['email'];
								$empresa=$linha['empresa'];
								$dt_cadastro = $linha['dt_cadastro'];
								$dt_cadastro_mostra = mostra_data($dt_cadastro);
								//E toda última célula contém uma série de ações que posso usar para alterar a tabela.

								echo "<tr>
									  <td>$nome</td>
									  <td>$CPF</td>
									  <td>$dt_cadastro_mostra</td>
									  <td width=220px>
										<a href='cadastro_cliente_edit.php?id=$CPF&empresa=$empresa' class='btn btn-success btn-sm'>Editar</a>
										<a href='#' class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#confirma' onClick=".'"'."pegar_dados($CPF, '$nome')".'"'.">Excluir</a>
										<a href='lista_telefone_edit.php?id=$CPF' class='btn btn-primary btn-sm'>Telefones</a>
									</tr>";
							}
						?>							
						
					  </tbody>
					
				</table>
				
				<a href="index.php" class="btn btn-primary"> Voltar para o início</a>
			</div>
		</div> 
	</div>

	<!-- Modal, com definições de parâmetros para passar para a tela de exclusão e para dar maior contexto e tato para a ação que o usuário está para realizar. -->
	<div class="modal fade" id="confirma" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Confirmação de Exclusão</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <div class="modal-body">
			<form action="cliente_excluir_script.php" method="POST">
			<p>Deseja realmente excluir <b id="nome_pessoa">Nome da pessoa</b>? </p>
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
			<input type ="hidden" name="id" id="CPF" value="">
			<input type ="hidden" name="nome" id="nome_pessoa_1" value="">
			<input type="submit" class="btn btn-danger" value="Sim">
			</form>
		  </div>
		</div>
	  </div>
	</div>
<!-- Uma função apenas para acertar os dados enviados de uma página para outra..-->
	<script type="text/javascript">
		function pegar_dados(id, nome){
			document.getElementById('nome_pessoa').innerHTML = nome;
			document.getElementById('nome_pessoa_1').value = nome;
			document.getElementById('CPF').value = id;
		}
	</script>
<!-- A função de sort.-->
	<script>
	function sortTable(n) {
	  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
	  table = document.getElementById("myTable");
	  switching = true;
	  // Set the sorting direction to ascending:
	  dir = "asc";
	  /* Make a loop that will continue until
	  no switching has been done: */
	  while (switching) {
		// Start by saying: no switching is done:
		switching = false;
		rows = table.rows;
		/* Loop through all table rows (except the
		first, which contains table headers): */
		for (i = 1; i < (rows.length - 1); i++) {
		  // Start by saying there should be no switching:
		  shouldSwitch = false;
		  /* Get the two elements you want to compare,
		  one from current row and one from the next: */
		  x = rows[i].getElementsByTagName("TD")[n];
		  y = rows[i + 1].getElementsByTagName("TD")[n];
		  /* Check if the two rows should switch place,
		  based on the direction, asc or desc: */
		  if (dir == "asc") {
			if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
			  // If so, mark as a switch and break the loop:
			  shouldSwitch = true;
			  break;
			}
		  } else if (dir == "desc") {
			if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
			  // If so, mark as a switch and break the loop:
			  shouldSwitch = true;
			  break;
			}
		  }
		}
		if (shouldSwitch) {
		  /* If a switch has been marked, make the switch
		  and mark that a switch has been done: */
		  rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
		  switching = true;
		  // Each time a switch is done, increase this count by 1:
		  switchcount ++;
		} else {
		  /* If no switching has been done AND the direction is "asc",
		  set the direction to "desc" and run the while loop again. */
		  if (switchcount == 0 && dir == "asc") {
			dir = "desc";
			switching = true;
		  }
		}
	  }
	}
	</script>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

  </body>
</html>