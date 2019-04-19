<?php require '../conexao.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Lava Jato</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css" >
	<link rel="stylesheet" href="../css/bootstrap-theme.min.css" >
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/jquery.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.js"></script>
	<script>
		$(document).ready(function() {
			$('#placa').mask('AAA-9999');
		});
	</script>
	<style>
input[type=text], select {
  width: 20%;
  padding: 8px 15px;
  margin: 10px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
#drop{
	padding: 9px;
	margin: 10px;
}
</style>
</head>
<body>
	<div id="headder">

 	<center><h1>Lava Jato do Wandinho</h1></center>
 	</div>
	<form method="POST" action="index.php">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<label>Placa do Carro</label>&nbsp;&nbsp;
					<input type="text" id="placa" name="placaCarro"  placeholder="ex: AAA9999" >
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       	
        <select class="btn btn-default dropdown-toggle" id="drop" name="tipoLavagem">
  			<option value="Lavagem geral">Lavagem geral</option>
 			<option value="Lavagem fora">Lavagem fora</option>
  			<option value="Limpeza interna">Limpeza interna</option>
  			<option value="Geral com cera">Geral com cera</option>
		</select>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       	<input type="submit" value="Imprimir" name="cad" id="cad" class="btn btn-success">
				</div>
			</div>
		</div>


<?php 
	$valor = 0;
	$tipo = $_POST['tipoLavagem'];

	if (isset($_POST['cad'])) {
		$placa = strtoupper($_POST['placaCarro']);
		date_default_timezone_set('America/Sao_Paulo');
	    $data = date('y/m/d H:i');

	    if ($tipo == 'Lavagem geral') {
	    	$valor = 35;
	    }else if ($tipo == 'Lavagem fora') {
	    	$valor = 20;
	    }else if($tipo == 'Limpeza interna'){
	    	$valor = 20;
	    }else if ($tipo == 'Geral com cera') {
	    	$valor = 70;
	    }

	    $sql = "INSERT INTO lava_jato SET placa='$placa', tipoLavagem = '$tipo', valor = $valor, horaLavagem='$data'";
	    
	    if ($sql = $pdo->query($sql)) {
	    	echo "
	            	<script>
	            		alert('Cadastro realizado com sucesso');
	            	</script>
				";
				header('Location:imprime.php');
		} else {
		    echo "Error: " . $sql. "<br>" . $e->getMessage();
		}
	}

 ?>
	</form>
</body>
</html>