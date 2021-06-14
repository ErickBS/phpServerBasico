<?php
	$server = "localhost";
	$user = "root";
	$pass = "admin";
	$bd = "avaliacao";
	
	if ( $conn = mysqli_connect($server, $user, $pass, $bd) ) {
		// echo "Conectado";
	} else
		echo "Erro";
	
	$UFQuery = "SELECT * FROM UF";
	
	$listaUF = mysqli_query($conn, $UFQuery);
	
	$empresaQuery = "SELECT * FROM empresas";
	
	$listaEmpresas = mysqli_query($conn, $empresaQuery);
	
	function mensagem ($texto, $tipo) {
		echo "	<div class='alert alert-$tipo' role='alert'>
					$texto
				</div>";
	}
	
	function deleta_numero($numero){
		mysqli_query($conn, 'DELETE FROM telefones WHERE numero = $numero');
	}
	
	function  limpa_data($data) {
		$data = str_replace(' ', '/', $data);
		$data = str_replace(':', '/', $data);
		$data = str_replace('am', '', $data);
		$data = str_replace('pm', '', $data);
		$d = explode('/', $data);
		//$h = explode(':', $data);
		//06/14/2021/09/08/41/
		$escreve = $d[2]."-".$d[0]."-".$d[1]." ".$d[3].":".$d[4].":".$d[5];
		return $escreve;
	}
	
	function mostra_data($data){
		$data = str_replace(' ', '/', $data);
		$data = str_replace('-', '/', $data);
		$data = str_replace(':', '/', $data);
		$d=explode('/', $data);
		$escreve = $d[2]."/".$d[1]."/".$d[0].", às ".$d[3].":".$d[4].":".$d[5];
		return $escreve;
	}
	
	function limpa_url($data){
		$data = str_replace('%20',' ', $data);
		return $data;
	}
?>