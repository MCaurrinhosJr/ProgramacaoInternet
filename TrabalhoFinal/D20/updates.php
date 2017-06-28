<?php
	
	require("conecta.php");
	
	$id = $_POST['id'];
	$fname = isset($_POST['fname']) ? $_POST['fname'] : '';
	$lname = isset($_POST['lname']) ? $_POST['lname'] : '';
	$email = isset($_POST['email']) ? $_POST['email'] : '';
	$pass =  isset($_POST['password'])  ? $_POST['password'] : '';
	$cpass = isset($_POST['cpassword']) ? $_POST['cpassword'] : '';
	
	$insert = $_POST['insert'];

	$ok = conecta_bd() or die ("Não é possível conectar-se ao servidor.");
	

	if (isset($_POST["submit"])) {

		if($insert == "info")
		{	
			
			if($fname != "" && $lname != "" && $email != "")
			{
				$update = mysqli_query($ok,"UPDATE usuario SET primeiroNome = '$fname', sobreNome = '$lname', email= '$email' where id = $id");
			}
			if($update){
			echo"<script language='javascript' type='text/javascript'>alert('Informações alteradas com sucesso!');window.location.href='minhaConta.php'</script>";
			}else{
			echo"<script language='javascript' type='text/javascript'>alert('Não foi possível alterar as informações');window.location.href='minhaConta.php'</script>";
			}
			
		}
		if($insert == "pass")
		{
			
			if($pass == $cpass && $pass != '')
			{
				$update = mysqli_query($ok,"UPDATE usuario SET senha = $pass where id = $id");
			}
			if($update){
			echo"<script language='javascript' type='text/javascript'>alert('Senha alterada com sucesso!');window.location.href='minhaConta.php'</script>";
			}else{
			echo"<script language='javascript' type='text/javascript'>alert('Não foi possível alterar sua senha');window.location.href='minhaConta.php'</script>";
			}
		}
	}
	
?>