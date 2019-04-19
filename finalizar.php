<?php 
	require 'conexao.php'; //Conexão com o banco de dados

	$id=0;

	if(isset($_GET['id']) && empty($_GET['id']) == false){ //Verifico se o ID passado como parametro esta preenchido ou não
		$id = addslashes($_GET['id']);	//Proteção para o parametro ID que foi passado

		$sql3 = "UPDATE carro SET horaSaida= now() WHERE id= $id "; //Query a ser executada no banco de dados
		$sql3 = $pdo->query($sql3);	//Execução da query

		$sql4 = "SELECT placa, horaEntrada, horaSaida, TIMEDIFF(horaSaida, horaEntrada) as 'Permanencia' FROM carro WHERE id = $id"; //Query a ser executada no banco de dados

		$sql4 = $pdo->query($sql4);//Execução da query

		if ($sql4->rowCount()>0) {//Verifico se o numero de linhas que veio da query é maior que 0
			$resp = $sql4->fetch();//coloco os resultados da query na variavel DADO

			$data = $resp['horaEntrada'];//Jogo o a data e hora de entrada do cliente na variavel data
			$data = explode(' ', $data);//Separo os valores recebidos por ' ', separando a hora da Data
			$data2 = $resp['horaSaida'];//Jogo o a data e hora de entrada do cliente na variavel data2
			$data2= explode(' ', $data2);//Separo os valores recebidos por ' ', separando a hora da Data
			$dia = explode('-', $data[0]);//Separo a data pelo delimitador '-'

			$resp2 = $dia[2].'/'.$dia[1].'/'.$dia[0];// Monto a data colocando os / nos lugares corretos 
			$dia2 = explode('-', $data2[0]);//Separo a data pelo delimitador '-'

			$resp3 = $dia2[2].'/'.$dia2[1].'/'.$dia2[0];// Monto a data colocando os / nos lugares corretos
			$horaEnt = $data[1];//jogo a hora na variavel hora
			$horaSad = $data2[1];//jogo a hora na variavel hora

			$valor = 3;
			//execução dos calculos para saber quanto o cliente deve pagar referente ao tempo de permanencia no estabelecimento
			$hora = $resp['Permanencia'];
		if($hora <= '00:15:00'){
				$valor= $valor;
			}else if($hora >= '00:16:00' && $hora <= '00:30:00'){
				$valor = $valor*2;
			}else if($hora >= '00:31:00' && $hora <= '00:45:00'){
				$valor = $valor*3;
			}else if($hora >= '00:46:00' && $hora <= '01:00:00'){
				$valor = $valor*4;
			}else if($hora >= '01:01:00' && $hora <= '01:15:00'){
				$valor = $valor*5;
			}else if($hora >= '01:16:00' && $hora <= '01:30:00'){
				$valor = $valor*6;
			}else if($hora >= '01:31:00' && $hora <= '01:45:00'){
				$valor = $valor*7;
			}else if($hora >= '01:46:00' && $hora <= '02:00:00'){
				$valor = $valor*8;
			}else if($hora >= '02:01:00' && $hora <= '02:15:00'){
				$valor = $valor*9;
			}else if($hora >= '02:16:00' && $hora <= '02:30:00'){
				$valor = $valor*10;
			}else if($hora >= '02:31:00' && $hora <= '02:45:00'){
				$valor = $valor*11;
			}else if($hora >= '02:46:00' && $hora <= '03:00:00'){
				$valor = $valor*12;
			}else{
				$valor= 40;
			}

			$texto2 ="
				<div class='container'>
					<div class='row justify-content-md-center'>
						<div col-md-4>
							Estacionamento do Wandinho
							<br>
							Rua Paracatu, 899 - Barro Preto
							<br>CEP: 30180-091  -  Belo Horizonte - Minas Gerais
							<br>CNPJ: 28.120.621/0001-28   <br>INSC. MUNICIPAL: 1.036.248/001-7<br>
							Celular: (031) 9 96762341<br>
							
							_______________________________________________<br>
							Placa do Veiculo:<b>".$resp['placa']."</b></br>
							_______________________________________________<br>

							Hora de Entrada: <b>".$resp2." - $horaEnt</b><br><br>
							Hora de Saida: <b>".$resp3." - $horaSad</b><br><br>
							Tempo de Permanencia:<b>". $resp['Permanencia']."</b><br><br>
							Valor a Pagar:<b> R$ $valor,00</b><br>
							<a href='index.php'>Volte Sempre</a>
						</div>
					</div>
				</div>";
			echo $texto2;
		}
	}
 ?>