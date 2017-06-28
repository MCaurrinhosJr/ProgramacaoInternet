<?php require("conecta.php"); ?>
<html>

	<head>
		<meta charset="utf-8"/>
		
		<title> Cadastro de Usuário </title>
		
		<link rel="stylesheet" href="css/stylesheet.css" type="text/css" />
		
	</head>
	
	<body>
		<div id='cabecalho'>
		<?php
		
			require("header.php");
		
		?>
		</div>
		<div id="conteudo">
		
			<h1>Cadastro de Usuario </h1>
			<p>Bem vindo ao D20! Basta preencher o formulário abaixo e sua conta será criada de graça.
			
			<form method="POST" action="newUser.php">
			<table>
				<tr>
					<td><label>Primeiro Nome: </label></td>
					<td><input type="text" name="pnome" id="pnome" required></td>
				</tr>
				<tr>
					<td><label>Sobrenome: </label></td>
					<td><input type="text" name="snome" id="snome" required></td>
				</tr>
				<tr>
					<td><label>Nome de usuario: </label></td>
					<td><input type="text" name="login" id="login" required></td>
				</tr>
				<tr>
					<td><label>Endereço de e-mail: </label></td>
					<td><input type="text" name="email" id="email" required></td>
				</tr>
				<tr>
					<td><label>Senha: </label></td>
					<td><input type="password" name="senha" id="senha"></td>
				</tr>
				<tr>
					<td><label>Confirmação de senha: </label></td>
					<td><input type="password" name="confirmação" id="login"></td>
				</td>
				<tr>
					<td></td><td style="float:right;"><input type="submit" value="Cadastrar" id="cadastrar" name="cadastrar"></td>
				</tr>
			</table>	
				
			</form>
		</div>
		<div id="rodape">
		<?php
		
			require("footer.php");
		?>
		</div>
	</body>
</html>