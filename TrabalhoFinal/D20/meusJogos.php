<?php require("conecta.php"); ?>
<html>
	
	<head>
		<meta charset="utf-8"/>
		<title> Meus jogos </title>
	
		<link rel="stylesheet" href="css/stylesheet.css" type="text/css" />
		
	</head>
	
	<body>
		
		<?php
			echo"<div id='cabecalho'>";
			require("header.php");
			echo"</div>";
			echo"<div id='index-lateral-direita'>";
			require("rightPanel-MeusJogos.php");
			echo"</div>";
			
			
			$ok = conecta_bd() or die ("Não é possível conectar-se ao servidor.");
			

			$query = sprintf("SELECT campanha.id as campid, campanha.Nome as campnome, campanha.imagem as imagem FROM grupo 
								INNER JOIN campanha on campanha.id = grupo.id 
								INNER JOIN usuario on grupo.idUsuario = usuario.id
								left join imagens on campanha.imagem = imagens.id
								where usuario.login = '".$_COOKIE['login']."'
						");

			$dados = mysqli_query($ok,$query) or die(mysql_error());

			$linha = mysqli_fetch_assoc($dados);

			$total = mysqli_num_rows($dados);
				
			
			
			echo"<div id='index-conteudo-esquerda'>";
			if($total > 0) {
						do{
							$id = $linha['campid'];
							$nome = $linha['campnome'];
							$image = $linha['imagem'];
							echo"<div>";

							if(isset($image))
								{
									echo '<a href="detalhes-mesa.php?id='.$id.'"><img src="data:image/jpeg;base64,'.base64_encode( $image ).'" width="120" height="120"/></a><br>';
								}
								else{
									echo '<a href="detalhes-mesa.php?id='.$id.'"><img src="imgs\\d20_2.png" width="120" height="120"></a><br>';
								}
							echo"<h3><a href='detalhes-mesa.php?id=$id' style='text-decoration: none; color: purple;'> $nome </a></h3>";
							
							echo"<h3><a href='' style='text-decoration: none; color: purple;'> Entrar no jogo </a></h3>";
							
							$query2 = sprintf("SELECT usuario.id as ids, usuario.login as nomes, imagens.imagem as fotos from grupo
												INNER JOIN campanha on grupo.idcampanha = campanha.id
												INNER JOIN usuario on grupo.idusuario = usuario.id
												left JOIN imagens on usuario.avatar = imagens.id
												where idcampanha = $id
													");
						
							$dados2 = mysqli_query($ok,$query2) or die(mysqli_error($ok));
						
							$linha2 = mysqli_fetch_assoc($dados2);
						
							$total2 = mysqli_num_rows($dados2);
							
								do
								{
									$id = $linha2['ids'];
									$nomeusuario = $linha2['nomes'];
									$avatar = $linha2['fotos'];
									
								echo"<div>";
							
								if(isset($avatar))
								{
									echo '<a href="minhaConta.php?id='.$id.'"><img src="data:image/jpeg;base64,'.base64_encode( $avatar ).'" width="50" height="50"/></a><br>';
								}
								else{
									echo '<a href="minhaConta.php?id='.$id.'"><img src="imgs\\d20_2.png" width="50" height="50"></a><br>';
								}
							
								echo"<a href='minhaConta.php?id=$id' class='button'> $nomeusuario </a>";
								echo"</div>";
								}
								while($linha2 = mysqli_fetch_assoc($dados2));
							echo'</div>';
						}
						while($linha == mysqli_fetch_assoc($dados));
					}
			else
			{
				echo"<p> Você ainda não faz parte de um grupo";
			}
			mysqli_free_result($dados);
			echo"</div>";
			echo"<div id='rodape'>";
			require("footer.php");
			echo"</div>";
		?>
		
	</body>
	
</html>
