<?php 
	require 'conexao.php';


	

	echo "<table border='1' class='table table-responsive table-striped' id='tabela'>
			<tr style= 'background-color:#428bca; color: white'>
		 		<td><center>Placa</center></td>
		 		<td><center>Hora Entrada</center></td>
		 		<td><center>Hora saida</center></td>
		 		<td><center>Tempo de Permanencia</center></td>
		 		<td><center>Valor Pago</center></td>
		 	</tr>";
	date_default_timezone_set('America/Sao_Paulo');
	$data2 = date('Y/m/d');
	
	$color = 'DDFFFC';
	$tot=0;
	$cont=0;

	$sql5 = "SELECT placa, horaEntrada, horaSaida, TIMEDIFF(horaSaida, horaEntrada) as 'Permanencia' FROM carro WHERE date(horaSaida) = '$data2'";

	$sql5 = $pdo->query($sql5);
	if($sql5->rowCount() > 0){
		foreach ($sql5-> fetchAll() as $result) {
			$ent = explode(' ', $result['horaEntrada']);
			$sad = explode(' ', $result['horaSaida']);

	$hora = $result['Permanencia'];
	$valor = 3;

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

		$tot += $valor;
		$cont++;
		

			echo"<tr style= 'background-color:$color'>
			<td><center>".$result['placa']."</center></td>
			<td><center>".$ent[1]."</center></td>
			<td><center>".$sad[1]."</center></td>
			<td><center>".$result['Permanencia']."</center></td>
			<td><center>R$ $valor,00</center></td>";
		if($color == 'CBD2D1'){
			$color = 'DDFFFC';
		}else {
			$color ='CBD2D1';
		}
	}
	}
	echo "<tr style= 'background-color:95C2E3'>
		<td colspan='4'><b>Total a Receber</b></td>
		<td><center><b>R$ $tot,00</b></center></td>
	</tr>";
	
 ?>

 <!DOCTYPE html>
<html>
 <head>
 	<link rel="stylesheet" type="text/css" href="style.css">
 	<script src="js/jquery.min.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css" >
	<link rel="stylesheet" href="css/bootstrap-theme.min.css" >
	<script src="js/bootstrap.min.js"></script>
 </head>
 <body>
 	<center><h1>Relatorio Diario</h1></center>
 	
 	<?php
 		echo "<div class='row'>
	<div class='col-md-10'></div>
	<div class='col-md-2'>Quantidade de Carros: <b>$cont</b></div> 		
 	</div>";
 	 ?>
 </body>
 </html>