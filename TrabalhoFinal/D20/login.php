<?php require("conecta.php"); ?>

<html>

	<head>
		<meta charset="utf-8"/>
		
		<title> Login de Usuário </title>
		
		<link rel="stylesheet" href="css/stylesheet.css" type="text/css" />
		
	</head>
	
	<body>
		
		<?php
		echo "<div id='cabecalho'>";
			require("header.php");
		echo "</div>";
		?>
		
		<div id="conteudo-esquerda">
		
			<h1>Login </h1>
			
			<form method="POST" action="log_in.php">
				<table>
					<tr>
						<td><label style='width: 120px; text-align: right;'>login:</label></td>
						<td><input autocapitalize='off' autocorrect='off' name="login" id="login" type='text' value=''></td>
					</tr>
					<tr>
						<td><label style='width: 120px; text-align: right;'>Senha:</label></td>
						<td><input autocapitalize='off' autocorrect='off' name="senha" id="senha" type='password'></td>
					</tr>
					<tr>
						<td></td>
						<td style='float:right;'><input type="submit" value="entrar" id="entrar" name="entrar"> <button type="submit"><a href="cadastro.php" class="button">Cadastre-se</a></button></td>
					</tr>
				</table>
			</form>
			
		</div>
		
		<?php
		echo "<div id='lateral-direita'>";
			require("rightPanel-Login.php");
		echo "</div>";
		?>
		 
		<?php
		echo "<div id='rodape'>";
			require("footer.php");
		echo "</div>";
		?>
		
	</body>
</html>