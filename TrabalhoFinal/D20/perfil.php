<?php
	require("conecta.php");
	$ok = conecta_bd() or die ("Não é possível conectar-se ao servidor.");
	
	$id = htmlspecialchars($_GET["id"]);

	$query = sprintf("SELECT 	usuario.id as id,
								usuario.login as login,
								usuario.primeiroNome as primeiroNome, 
								usuario.sobreNome as sobreNome, 
								usuario.dataCriacao as dataCriacao,
								imagens.imagem as foto
									FROM usuario 
									left join imagens on imagens.id = usuario.avatar
								where usuario.id = $id ");

	$dados = mysqli_query($ok,$query) or die(mysqli_error($ok));
	while ($linha = mysqli_fetch_assoc($dados))
	{
		$Nome = $linha['login'];
		$FullNome = $linha['primeiroNome'] .' '. $linha['sobreNome'];
		$dataCriacao = $linha['dataCriacao'];
		$dataCriacao = date("d-m-Y" ,strtotime($dataCriacao));
		$image = $linha['foto'];
	}
	
	
?>

<html>
	
	<head>
		<meta charset="utf-8"/>
		<title> <?php echo "$Nome" ?> | D20: online virtual table </title>
	
		<link rel="stylesheet" href="css/stylesheet.css" type="text/css" />
		
	</head>
	
	<body>
		
		<?php
			echo "<div id='cabecalho'>";
			require("header.php");
			echo "</div>";
			echo "<div id='conta-esquerda'>";
			require("leftPanel-usuario.php");
			echo "</div>";
			echo"
				<div id='conta-conteudo'>
				<h1> $FullNome </h1>
				
				<p> Membro desde : $dataCriacao | Dungeon Master em qtd Jogos
				
				<hr>
				
				<p> 
				</div>
			";
			echo "<div id='rodape'>";
			require("footer.php");
			echo "</div>";
		?>
		
	</body>
	
</html>