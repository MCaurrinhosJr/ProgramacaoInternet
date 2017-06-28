<?php require("conecta.php"); ?>
<html>
	
	<head>
		<meta charset="utf-8"/>
		<title> Minha Conta | D20: online virtual table </title>
	
		<link rel="stylesheet" href="css/stylesheet.css" type="text/css" />
		
	</head>
	
	<body>
		<?php
		$msg = '';
		if($_SERVER['REQUEST_METHOD']=='POST'){
			$image = $_FILES['image']['tmp_name'];
			$img = file_get_contents($image);
			$ok = conecta_bd() or die ("Não é possível conectar-se ao servidor.");
			$sql = "insert into imagens (imagem, lugar) values(?, 'a')";
		
			$stmt = mysqli_prepare($ok,$sql);
		
			mysqli_stmt_bind_param($stmt, "s",$img);
			mysqli_stmt_execute($stmt);
		
			$check = mysqli_stmt_affected_rows($stmt);
			if($check==1){
				$lid = mysqli_insert_id($ok);
				mysqli_query($ok,"update usuario set avatar = $lid where id = $id");
				$msg = 'Successfullly UPloaded';
			}else{
				$msg = 'Could not upload';
			}
			mysqli_close($ok);
			
			
		}
		?>


		<?php
			echo "<div id='cabecalho'>";
			require("header.php");
			echo "</div>";
			
		?>
			
		<?php
	
	$ok = conecta_bd() or die ("Não é possível conectar-se ao servidor.");
	
	$query = sprintf("SELECT id, primeiroNome, sobreNome, email FROM usuario
						where
							login = '".$_COOKIE['login']."'
						");

	$dados = mysqli_query($ok,$query) or die(mysqli_error($ok));
	while ($linha = mysqli_fetch_assoc($dados))
	{
		$id = $linha['id'];
		$FNome = $linha['primeiroNome'];
		$LNome = $linha['sobreNome'];
		$email = $linha['email'];
	}
	
	
?>
			
		
			<div>
			
				<h2> Perfil </h2>
				<form  method='POST' action='updates.php'>
				<input type='hidden' name='id' value='<?php echo"$id"; ?>'/>
				<table>
				<tr>
					<td><label>Primeiro Nome: </label></td>
					<td><input type='text' name='fname' value='<?php echo"$FNome"; ?>'></td>
				</tr>
				<tr>
					<td><label>SobreNome: </label></td>
					<td><input type='text' name='lname' value='<?php echo"$LNome"; ?>'></td>
				</tr>
				<tr>
					<td><label>E-mail: </label></td>
					<td><input type='email' name='email' value='<?php echo"$email"; ?>'></td>
				</tr>
				</table>
				<input type='hidden' name='insert' value='info'/>
				<input type='submit' name='Submit' value='Submit'>
				</form>
				<hr>
				
				<h2> Avatar </h2>
				<form  method='POST' action='minhaConta.php' enctype='multipart/form-data'>
				<input type='hidden' name='id' value='<?php echo"$id"; ?>'/>
				<input type='file' name='image' /></br>
				<label><?php echo" $msg "; ?></label>
				<button>Upload</button>
				</form>
				<hr>
				
				<h2> Senha </h2>
				<form  method='POST' action='updates.php'>
				<input type='hidden' name='id' value='<?php echo"$id"; ?>'/>
				<table>
					<tr>
						<td><label>Nova Senha: </label></td>
						<td><input type='password' name='password'></td>
					</tr>
					<tr>
						<td>Conformação da senha: </td>
						<td><input type='password' name='cpassword'></td>
					</tr>
				</table>
				<input type='hidden' name='insert' value='pass'/>
				<input type='submit' name='submit' value='Submit'>
				</form>
			
			</div>
		
		
		
		
		<?php
		echo "<div id='rodape'>";
			require("footer.php");
		echo "</div>";
		?>
		
	</body>
	
</html>