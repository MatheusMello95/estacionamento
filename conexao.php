<?php 
	//Pagina de conexão com o banco de dados. Sempre que preciso fazer a conexão em alguma outra pagina basta dar um require ou include dessa pagina.
	$con = "mysql:dbname=estacionamento;host=localhost";
	$dbuser = "root";
	$dbpass = "";

	try {
		$pdo = new pdo($con, $dbuser, $dbpass);
	} catch (Exception $e) {
		echo "Falhou: ".$e->getMessage();
	}
 ?>
