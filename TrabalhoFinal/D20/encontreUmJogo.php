<?php require("conecta.php"); ?>
<html>
	
	<head>
		<meta charset="utf-8"/>
		<title> Busca por jogo </title>
	
		<link rel="stylesheet" href="css/stylesheet.css" type="text/css" />
		
	</head>
	
	<body>
		
		<?php
			echo "<div id='cabecalho'>";
			require("header.php");
			echo "</div>";
				echo'
				<div>
				<h2> Encontre uma mesa </h2>
				
				<hr>
				
				<table>
					
					<tr>
						<td>
							<h4> Jogue qualquer um desses </h4>
							<p>	Sem livros p/ busca
						</td>
						
						<td>
							<h4>Organizar por:</h4>
							<p>	ainda n implementado
						</td>
						
						<td>
							
						</td>
					</tr>
					
					<tr>
						<td>
							<p><input type="checkbox" > Apenas jogos que <strong> Novos Jogadores São Bem Vindos </strong>
						</td>
						
						<td>
							
						</td>
						
						<td>
							<p><input type="checkbox" > Apenas jogos que são <strong> Gratuitos </strong>
						</td>
					</tr>
					
				</table>
				
				<input type="submit" value="Buscar" id="Buscar" name="Buscar">
				
				<hr>
				</div>';
				
				$ok = conecta_bd() or die ("Não é possível conectar-se ao servidor.");
				
				
				
				$query = sprintf("SELECT C.NOME as campnome, C.DESCRICAO as campdesc, U.login, U.dataCriacao, imgs.imagem as avatar, U.id as id, c.id as idcamp FROM campanha C
									INNER JOIN grupo G ON G.idcampanha = C.id
									INNER JOIN usuario U ON U.id = G.idUsuario
									left JOIN imagens imgs on imgs.id = U.avatar
									WHERE g.DM = 1
									");
			
				$dados = mysqli_query($ok,$query) or die(mysqli_error());
	
				
		echo'<div>';
		echo'<table>';
		echo'<tr>
				<td> Dungeon Master </td>
				<td> Nome & Descrição </td>
			</tr>';
		while ($linha = mysqli_fetch_assoc($dados))
		{
			$dmnome = $linha['login'];
			$dmdatacriacao = $linha['dataCriacao'];
			$campNome = $linha['campnome'];
			$campDesc = isset($linha['campdesc']) ? $linha['campDesc'] : 'SEM DESCRICAO' ;
			$avatar = $linha['avatar'];
			$id = $linha['id'];
			$idcamp = $linha['idcamp'];
			
			echo"<tr>
				<td> 
					<table>
						<tr>
							<td>";
								if(isset($avatar))
								{
									echo '<a href="perfil.php?id='.$id.'"><img src="data:image/jpeg;base64,'.base64_encode( $avatar ).'" width="50" height="50"/></a><br>';
								}
								else{
									echo '<a href="perfil.php?id='.$id.'"><img src="imgs\\d20_2.png" width="50" height="50"></a><br>';
								}
							echo"</td>
							<td>
								<label> $dmnome </label>
								<hr>
								<label>Membro desde: </label> $dmdatacriacao
							</td>
						</tr>
					</table>
				</td>
				<td> 
					<a href='detalhes-mesa.php?id=$idcamp' > $campNome </a>
					<p> $campDesc
				</td>
			</tr>";
			
			
		}
		echo'</table>';
		echo'</div>';
		echo "<div id='rodape'>";
			require("footer.php");
		echo "</div>";
		?>
		
	</body>
	
</html>