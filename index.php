<?php 

	require 'conexao.php';

	if(isset($_POST['placaCarro']) && empty($_POST['placaCarro'])){
			echo "
					<script>
						alert('Digite a placa!');
					</script>
			";
		}
	if(isset($_POST['placaCarro']) && !empty($_POST['placaCarro'])){

    		if(isset($_POST["cad"])){
				$placa = $_POST['placaCarro'];

	    	 	date_default_timezone_set('America/Sao_Paulo');
	        	$data = date('y/m/d H:i');

	        	$sql = "INSERT INTO carro SET placa='$placa', horaEntrada='$data'";

	        	if ($sql = $pdo->query($sql)) {
	            //echo "<p class='alert-success'>Cadastrado com Sucesso</p>";
	            echo "
	            	<script>
	            		alert('Cadastro realizado com sucesso');
	            		location.href = 'http://localhost/Estacionamento/index.php';
	            	</script>
				";

		        } else {
		            echo "Error: " . $sql. "<br>" . $e->getMessage();
		        }
		        
    	 	}
		}
?>
<!DOCTYPE html>
<html>
 <head>
 	<title>Estacionamento</title>
 	<link rel="stylesheet" type="text/css" href="style.css">
 	
	<link rel="stylesheet" href="css/bootstrap.min.css" >
	<link rel="stylesheet" href="css/bootstrap-theme.min.css" >
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.js"></script>		
	
<script>
		$(document).ready(function() {
			$('#placa').mask('AAA-9999');
		});

		$(document).ready(function() {
    		$("#placa").on("keyup", function(){
				this.value = this.value.toUpperCase();
				if($(this).val().trim() == "")
				{
					$("tbody tr").show();
				}
				else
				{
					$("tbody tr").hide();
					var encontrou = false;
				    $("tbody td:first-child").each(function() {
					    if($(this).text().toLowerCase().indexOf($("#placa").val().trim().toLowerCase()) >= 0)
					    {
					    	encontrou = true;
					    	$(this).parent().show();
						}
					});
					if(!encontrou && $("#placa").val().trim().length == 8)
				    {
				    	$("#cad").fadeIn("slow");
					}
					else if($("#placa").val().trim().length != 8)
					{
						$("#cad").fadeOut("slow");
					}
				}
			});
		});
	</script>

<style type="text/css">
	#cad {
  display: none;
}
</style>
 </head>
 <body>
 	<div id="headder">
 	<center><h1>Estacionamento do Wandinho</h1></center>
 	</div>
 	<form method="POST" action="index.php">
	 	<div id="principal" class="col-md-8 col-md-offset-2"><Br>
	 	<div class="container">
	 		<div class="row">
	 			<div class="col-md-8"></div>
	 			<div class="col-md-1">
	 				<a type="button" value="Relatorio" class="btn btn-info" href='relatorio.php' target='_blank'>
	 					Relatorio
	 				</a>
	 			</div>
	 		</div>
	 	</div>
    	<div id="conteudo">
        <label>Placa do Carro: </label>&nbsp;&nbsp;<input type="text" id="placa" name="placaCarro"  placeholder="ex: AAA9999">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       	<input type="submit" value="Cadastrar" name="cad" id="cad" class="btn btn-success">



<?php 
	$sql2= "SELECT id, placa, horaEntrada FROM carro WHERE horaSaida is null";

	echo "<table border='1' class='table table-responsive table-striped' id='tabela'>
 <thead>
 <tr style= 'background-color:#428bca; color: white'>
     <td>Placa</td>
	 <td>Horario de Entrada</td>
	 <td>Imprimir</td>
     <td>Finalizar</td></tr>
     </thead>
     <tbody>";

 $sql2 = $pdo->query($sql2);
 if($sql2->rowCount() > 0){

			foreach ($sql2-> fetchAll() as $carros) {
				echo "<tr>
				<td>".$carros['placa']."</td>
				<td>".$carros['horaEntrada']."</td>
				<td>
					<a type='button' class='btn btn-info' href='cadastro.php?id=".$carros['id']."' target='_blank'>
						<span class='glyphicon glyphicon-print'></span>
					</a>
				</td>
				<!--<td><a type='button' class='btn btn-info' href='cadastro.php?id=".$carros['id']."' onclick='window.location.href='cadastro.php'>
				<span class='glyphicon glyphicon-print'></span>
				</a></td>-->
		        <td>
		        	<center>
		        		<a type='button' name='Encerrar' href='finalizar.php?id=".$carros['id']."' class='btn btn-danger'> Encerrar </a>
		        	</center>
				</td>
				</tr>";
			}
		}
		echo "</tbody>
		</table>";
 ?>

	</form>
 </body>
</html>