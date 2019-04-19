<?php
    require '../conexao.php'; 
    $sql = "SELECT * from lava_jato where finalizado is null";
    $dado ='';
        $sql = $pdo->query($sql);
        if($sql->rowCount() > 0) { 
            $dado = $sql->fetch();

			$data = explode(' ', $dado[4]);
			$data2 = $data[0];
			$hora = $data[1];
			$data2 = explode('-', $data2);
			$dia = $data2[2].'/'.$data2[1].'/'.$data2[0];


            $dado[1] = strtoupper($dado[1]);
			echo "
			Lava Jato do Wandinho<br>
			
			Rua Paracatu, 899 - Barro Preto
			<br>CEP: 30180-091  -  Belo Horizonte - Minas Gerais
			<br>CNPJ: 28.120.621/0001-28   <br>INSC. MUNICIPAL: 1.036.248/001-7<br>
			Celular: (031) 9 96762341<br>
			_______________________________________________<br>
			Placa do Veiculo: ".$dado[1]."<br>
			_______________________________________________<br>
			
			Hora da Lavagem: $dia - $hora<bR>
			Valor: R$".$dado[3].",00<br>
			Tipo de Lavagem: ".$dado[2]."<br>
            ";

            $sql2 = "UPDATE lava_jato set finalizado = 'S' where id = $dado[0]";
            $pdo->query($sql2);
            
            echo "<a href='index.php'>Volte Sempre!</a>";
        }
?>
