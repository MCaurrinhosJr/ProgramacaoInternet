<?php
	
	$ok = conecta_bd() or die ("Não é possível conectar-se ao servidor.");
	

	$query = sprintf("SELECT
							u.id as id,
							u.login as login,
							u.datacriacao as dataCriacao,
							imgs.imagem as avatar
						FROM 
							usuario u
						left JOIN IMAGENS imgs on imgs.id = u.avatar
						where
							login = '".$_COOKIE['login']."'
						");

	$dados = mysqli_query($ok,$query) or die(mysqli_error());
	while ($linha = mysqli_fetch_assoc($dados))
	{
		$id = $linha['id'];
		$Nome = $linha['login'];
		$dataCriacao = $linha['dataCriacao'];
		$dataCriacao = date("d-m-y",strtotime($linha['dataCriacao']));
		$image = $linha['avatar'];
	}
	
	
?>
<table>
	<tr>
		<td><?php 
				if(isset($image))
				{
					echo '<a href="minhaConta.php"><img src="data:image/jpeg;base64,'.base64_encode( $image ).'" width="50" height="50"/></a>';
				}
				else
				{
					echo"<a href='minhaConta.php'><img src='imgs\\d20_2.png' width='50' height='50'></a>"; 
				}
			?></td>
		<td>
			<label><?php echo"<a href='minhaConta.php'> $Nome </a>" ?></label>
			<hr>
			<label>Membro desde: </label> <?php echo"$dataCriacao" ?>
		</td>
	</tr>
</table>