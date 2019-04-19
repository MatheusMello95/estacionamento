<?php 
	require 'conexao.php'; //Puxo a conexão com o banco de dados

	$id= 0;

	if(isset($_GET['id']) && empty($_GET['id']) == false){ //Verifico se esta passando o ID como referencia
		$id = addslashes($_GET['id']);	//Coloca uma proteção no id que veio como requisição

		$sql = "SELECT * from carro where id = '$id'"; //Faço a select no banco buscando pelo ID passado como parametro

		$sql = $pdo->query($sql); //Executo a Query
		
		if ($sql->rowCount() > 0) { //Verifico se o numero de linhas que veio da query é maior que 0
			$dado = $sql->fetch(); //coloco os resultados da query na variavel DADO
			
			$data = $dado['horaEntrada']; //Jogo o a data e hora de entrada do cliente na variavel data

			$data = explode(' ', $data); //Separo os valores recebidos por ' ', separando a hora da Data
			$dia = explode('-', $data[0]);//Separo a data pelo delimitador '-'

			$resp = $dia[2].'/'.$dia[1].'/'.$dia[0]; // Monto a data colocando os / nos lugares corretos
			$hora = $data[1]; //jogo a hora na variavel hora
			echo "
				Estacionamento do Wandinho
				<br>
				Rua Paracatu, 899 - Barro Preto
				<br>CEP: 30180-091  -  Belo Horizonte - Minas Gerais
				<br>CNPJ: 28.120.621/0001-28   <br>INSC. MUNICIPAL: 1.036.248/001-7<br>
				Celular: (031) 9 96762341<br>
				_______________________________________________<br>
				Placa do Veiculo: <font size='5'>".$dado['placa']."</font><br>
				_______________________________________________<br>

				Hora de Entrada: $hora<bR>
				Data: ".$resp."

			";
			//echo $texto;
			/*if ( $handle = printer_open( "Diebold" ) ){ // impressora configurada no 	windows
				printer_set_option($handle, PRINTER_MODE, "RAW");
				printer_write($handle, $texto );
				printer_close($handle);
			} else echo 'Não foi possível abrir a impressora';
			header("Location: index.php");
		}else{
			header("Location: index.php");
		}
	
	}else{
		header("Location: index.php");
	}
	
	
	
	//http://br.php.net/ma...ook.printer.php

*/
}
}
 ?>