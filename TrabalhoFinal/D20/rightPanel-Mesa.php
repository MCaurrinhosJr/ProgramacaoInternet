<?php
	
	$ok = conecta_bd() or die ("Não é possível conectar-se ao servidor.");
	
	$login = $_COOKIE['login'];
	$id = htmlspecialchars($_GET["id"]);
	
	$query2 = sprintf("SELECT
							u.login as nomeuser,
							u.dataCriacao as datauser,
							imgs.imagem as avatar
						FROM 
							grupo g
						inner join
							usuario u on g.idusuario = u.id
						left join
							imagens imgs on imgs.id = u.avatar
						WHERE
							DM = 1 and idcampanha = $id
							");

	$dados2 = mysqli_query($ok,$query2) or die(mysqli_error($ok));

	$linha2 = mysqli_fetch_array($dados2);

		$nome2 = $linha2['nomeuser'];
		$dataCriacao = $linha2['datauser'];
		$dataCriacao = date("d-m-y",strtotime($linha2['datauser']));
		$avatar = $linha2['avatar'];
	
	
?>
<div>
	
	<table>
		<tr>
			<td><h3> Criado por: </h3></td>
			<td></td>
		</tr>
		<tr>
			<td><?php 
			if(isset($avatar))
				{
					echo '<img src="data:image/jpeg;base64,'.base64_encode( $avatar ).'" width="50" height="50"/>';
				}
				else
				{
					echo"<a href='minhaConta.php'><img src='imgs\\d20_2.png' width='50' height='50'></a>"; 
				} ?>
			<td>
				<label><?php echo" $nome2 "; ?></label>
				<hr>
				<label><?php echo" Membro desde: $dataCriacao";?></label> 
			</td>
		</tr>
	</table>
	
</div>

<div>
	<?php
	
	$ok = conecta_bd() or die ("Não é possível conectar-se ao servidor.");
	
	$login = $_COOKIE['login'];
	
	$id = htmlspecialchars($_GET["id"]);
	
	$query2 = sprintf("SELECT COUNT(idusuario) as qtd FROM Grupo
						where idcampanha = $id and grupo.dm = 0
							");

	$dados2 = mysqli_query($ok,$query2) or die(mysqli_error($ok));

	$linha2 = mysqli_fetch_array($dados2);

	$qtd = $linha2['qtd'];
	
	echo'<div>';
		echo"<h2> $qtd Jogadores </h2>";
		echo'<div> </div>';
		
		$ok = conecta_bd() or die ("Não é possível conectar-se ao servidor.");
	
	$query2 = sprintf("SELECT usuario.id as id, usuario.login as nomes, imagens.imagem as avatar from grupo
						INNER JOIN campanha on grupo.idcampanha = campanha.id
						INNER JOIN usuario on grupo.idUsuario = usuario.id
						INNER JOIN imagens on imagens.id = usuario.avatar
						where idcampanha = $id and grupo.dm = 0
							");

	$dados2 = mysqli_query($ok,$query2) or die(mysqli_error($ok));

	$linha2 = mysqli_fetch_assoc($dados2);
	
		do
		{
			$id = $linha2['id'];
			$nomeusuario = $linha2['nomes'];
			$avatar = $linha2['fotos'];
		if($qtd != 0)
		{
		echo"<div>";
		if(isset($avatar))
			{
				echo '<img src="data:image/jpeg;base64,'.base64_encode( $avatar ).'" width="50" height="50"/>';
			}
			else
			{
				echo"<a href='perfil.php?id=$id'><img src='imgs\\d20_2.png' width='50' height='50'></a>"; 
			}
		echo"<a href='perfil.php?id=$id'> $nomeusuario </a>";
		echo"</div>";
		}
		}
		while($linha2 = mysqli_fetch_assoc($dados2));
	echo'</div>';
?>
	
</div>