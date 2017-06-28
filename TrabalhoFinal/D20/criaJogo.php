<?php require("conecta.php"); ?>
<html>
	
	<head>
		<meta charset="utf-8"/>
		<title> Criar novo jogo </title>
	
		<link rel="stylesheet" href="css/stylesheet.css" type="text/css" />
		
	</head>
	
	<body>
		<div id='cabecalho'>
		<?php

			require("header.php");
		
		?>		
		</div>
		<div>
			<h2>Crie uma nova campanha </h2>
			
			<p>Para criar um novo jogo, escolha um nome, para organização coloque algumas tags (fase de desenvolvimento).
			<p>Então clique no botão "Criar Jogo".
			<form method="POST" action="criaCampanhaGrupo.php">
			<h2> Nome & Tags </h2>
			
			<input type="text" name="nome" id="nome">
			
			<label>Tags</label><input type="text" name="tags" id="tags">
			
			<h3> Fase de desenvolvimento </h3>
			<h5> Sem Informações extras / sem opções de sistema de jogo </h5>
			
			<input type="submit" value="Criar Jogo" id="criaJogo" name="criaJogo">
			</form>
		</div>
		
		<div id='rodape'>
		<?php
		
			require("footer.php");
		
		?>
		</div>
	</body>
	
</html>