<?php
	require("conecta.php");
	$ok = conecta_bd() or die ("Não é possível conectar-se ao servidor.");
	
	$id = htmlspecialchars($_GET["id"]);
	
	$query = sprintf("SELECT nome as campname,
							 descricao as campdesc,
							 imgs.imagem as imagem FROM campanha camp
							 left JOIN imagens imgs on imgs.id = camp.imagem
							 WHERE camp.id = $id");
	
	$dados = mysqli_query($ok,$query) or die(mysqli_error($ok));

	$linha = mysqli_fetch_array($dados);

	$campnome = $linha['campname'];
	$imagem = $linha['imagem'];
	$campdescricao = isset($linha['campdesc']) ? $linha['campdesc'] : 'SEM DESCRIÇÃO';
	
?>
<html>
	
	<head>
		<meta charset="utf-8"/>
		<title> <?php echo"$campnome"; ?> | D20: online virtual table </title>
	
		<link rel="stylesheet" href="css/stylesheet.css" type="text/css" />
		
	</head>
	
	<body>
		<?php
		$msg = '';
		if($_SERVER['REQUEST_METHOD']=='POST'){
			$image = $_FILES['image']['tmp_name'];
			$img = file_get_contents($image);
			$ok = conecta_bd() or die ("Não é possível conectar-se ao servidor.");
			$sql = "insert into imagens (imagem, lugar) values(?, 'c')";
		
			$stmt = mysqli_prepare($ok,$sql);
			mysqli_stmt_bind_param($stmt, "s",$img);
			mysqli_stmt_execute($stmt);
		
			$check = mysqli_stmt_affected_rows($stmt);
			if($check==1){
				$lid = mysqli_insert_id($ok);
				mysqli_query($ok,"update campanha set imagem = $lid where id = $id");
				$msg = 'Successfullly UPloaded';
			}else{
				$msg = 'Could not upload';
			}
			mysqli_close($ok);
			
		}
		?>
		<div id='cabecalho'>
			<?php
				require("header.php");
			?>	
		</div>		
			
		<div id='index-conteudo-esquerda'>
		<?php		
			if(isset($imagem))
			{
				echo '<img src="data:image/jpeg;base64,'.base64_encode( $imagem ).'" width="120" height="120"/>';
			}
			else{
				echo '<img src="imgs\\d20_2.png" width="120" height="120">';
			}
		?>
			<?php
			
			$query = sprintf("SELECT DM FROM grupo WHERE idUsuario = (SELECT id FROM usuario WHERE login = '$login_cookie')");
	
			$dados = mysqli_query($ok,$query) or die(mysqli_error($ok));
		
			$linha = mysqli_fetch_array($dados);
						
			$dm = $linha['DM'];

			if($dm == '1')
			{
			echo"
			<form  method='POST' action='detalhes-mesa.php?id=$id' enctype='multipart/form-data'>
					<input type='hidden' name='id' value='$id'/>
					<input type='file' name='image' /><br>
					<label> $msg </label>
					<button>Upload</button>
			</form>";
			}			?>
			<h2> <?php echo" $campnome "; ?> </h2>
			<p> <?php echo"$campdescricao"; ?>
			<hr>
			<?php
				$idcamp = htmlspecialchars($_GET["id"]);
				echo"<button type='submit'><a href='mesa.php?id=$idcamp' class='button'> Entra no Jogo </a></button>"; ?>
			<button type='submit'><a href='#' class='button'> Sair do jogo </a></button>
			<?php
			
			$query = sprintf("SELECT idUsuario FROM grupo WHERE idUsuario = (SELECT id FROM usuario WHERE login = '$login_cookie')");
	
			$dados = mysqli_query($ok,$query) or die(mysqli_error($ok));
		
			$linha = mysqli_fetch_array($dados);
			
			
			if($linha['idUsuario'] == ''){
				$idcamp = htmlspecialchars($_GET["id"]);
				echo"<button type='submit'><a href='join.php?id=$idcamp' class='button'> Juntar-se a campanha </a></button>";
			}
			?>
		</div>	
					
		<div id='index-lateral-direita'>
			<?php	
				require("rightPanel-mesa.php");
			?>	
		</div>
		<div id='rodape'>
			<?php	
				require("footer.php");
			?>
		</div>
	</body>
	
</html>