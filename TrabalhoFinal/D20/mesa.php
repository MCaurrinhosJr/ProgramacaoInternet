<?php
	require("conecta.php");
	$ok = conecta_bd() or die ("Não é possível conectar-se ao servidor.");
	
	$id = htmlspecialchars($_GET["id"]);

	$query = sprintf("SELECT campanha.Nome as campnome, grupo.DM as dungeonmaster, usuario.login FROM grupo 
					  INNER JOIN campanha on campanha.id = grupo.id 
					  INNER JOIN usuario on grupo.idUsuario = usuario.id
					  WHERE campanha.id = $id");

	$dados = mysqli_query($ok,$query) or die(mysqli_error($ok));
	while ($linha = mysqli_fetch_assoc($dados))
	{
		$nome = $linha['campnome'];
		$teste = $linha['dungeonmaster'];
		$log = $linha['login'];
	}
?>
<html>
	
	<head>
		<meta charset="utf-8"/>
		<title> <?php echo "$nome" ?> | D20: online virtual table </title>
	
		<link rel="stylesheet" href="css/stylesheet.css" type="text/css" />
		
	</head>
	
	<body>
		
		<?php
			echo"<div id='cabecalho'>";
			require("header.php");
			echo"</div>";
				if($log == $_COOKIE['login'])
				{
					echo"<button type='submit'><a href='livromestre.php' target='_BLANK' class='button'>Livro do Mestre</a></button>";
					echo"<button type='submit'><a href='livrojogador.php' target='_BLANK' class='button'>Livro do Jogador</a></button>";
					echo"<button type='submit'><a href='livromonstros.php' target='_BLANK' class='button'>Livro dos Monstros</a></button>";
					echo"<button type='submit'><a href='modeloficha.php' target='_BLANK' class='button'>Ficha de Personagem</a></button>";
				}
				else
				{
					echo"<button type='submit'><a href='livrojogador.php' target='_BLANK' class='button'>Livro do Jogador</a></button>";
					echo"<button type='submit'><a href='modeloficha.php' target='_BLANK' class='button'>Ficha de Personagem</a></button>";
				}
			echo"<div id='rodape'>";
			require("footer.php");
			echo"</div>";
		?>
		
	</body>
	
</html>