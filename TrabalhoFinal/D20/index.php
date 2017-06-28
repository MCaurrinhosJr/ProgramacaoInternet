<?php require("conecta.php"); ?>
<html>
	
	<head>
		<meta charset="utf-8"/>
		<title> D20 : Online virtual Tabletop for pen and paper RPGs and board games </title>
	
		<link rel="stylesheet" href="css/stylesheet.css" type="text/css" />
		
	</head>
	
	<body>
		
		<?php
			echo "<div id='cabecalho'>";
				require("header.php");
			echo "</div>";
			
				if(isset($login_cookie)){

					echo"<div id='index-conteudo-esquerda'>";
						
						
						echo"<button type='submit'><a href='criaJogo.php' class='button'>Criar novo jogo</a></button>";
						echo"<button type='submit'><a href='encontreUmJogo.php' class='button'>Juntar-se a um jogo</a></button>";
						
						
						
						$ok = conecta_bd() or die ("Não é possível conectar-se ao servidor.");
						
						$query = sprintf("SELECT camp.ID as campid, camp.nome as nome, imagens.imagem as imagem FROM campanha camp
											INNER JOIN grupo g on g.idcampanha = camp.id
											left join imagens on camp.imagem = imagens.id
											where camp.id = g.idcampanha AND g.idUsuario = (SELECT id FROM usuario where login = '$login_cookie')
										");

						$dados = mysqli_query($ok,$query) or die(mysqli_error());

						$linha = mysqli_fetch_assoc($dados);

						$total = mysqli_num_rows($dados);
						
						
						echo"<h2> Jogos Recentes</h2>";
						if($total > 0) {
							do{
								$nome = $linha['nome'];
								$id = $linha['campid'];
								$image = $linha['imagem'];
								echo'<div>';
									echo'<div>';
										echo"
											<a href='detalhes-mesa.php?id=$id'>";
												if(isset($image))
												{
													echo '<img src="data:image/jpeg;base64,'.base64_encode( $image ).'" width="120" height="120"/>';
												}
												else{
													echo '<img src="imgs\\d20_2.png" width="120" height="120"';
												}
												
											echo"</a>";
									echo'</div>';
									echo'<div>';
										echo"
											<a href='detalhes-mesa.php?id=$id' style='text-decoration: none; color: purple;'><h2> $nome </h2></a>
											<a href='mesa.php?id=$id' style='text-decoration: none; color: blue;'> Entrar no jogo </a>
										";
									echo'</div>';
								echo'</div>';
							}
							while($linha == mysqli_fetch_assoc($dados));
						}
						echo"</br><button type='submit'><a href='meusJogos.php' class='button'>Ver todos os jogos</a></button>
					</div>
					";
					echo "<div id='index-lateral-direita'>";
					require("rightPanel-Index.php");
					echo "</div>";
				}
				else{
					
					echo'
					<div id="informacoes">
						
						<h1> Este é o D20</h1>
						
						<p> Sistema de gerenciamento de mesas de RPG, facil de utilizar.
						
					</div>
					
					<hr>
					
					<div>
						<table width="75%">
							
							<tr>
								<td><h3>Sobre o site</h3></td>
								<td><h3>Fique por dentro das atualizações</h3></td>
								<td><h3>Receba noticias por e-mail</h3></td>
							</tr>
							<tr>
								<td>Site para gerenciamento de mesas de RPG</td>
								<td>EM DESENVOLVIMENTO</td>
								<td><input type="text" name="email" id="email"><input type="submit" value="Juntar-se" id="juntarse" name="juntarse"></td>
							</tr>
						</table>
					</div>
					';
				}
			echo "<div id='rodape'>";
			require("footer.php");
			echo "</div>";
		?>
		
	</body>
	
</html>
