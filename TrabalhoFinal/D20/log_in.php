<?php 
	require("conecta.php");
	
	$ok = conecta_bd() or die ("Não é possível conectar-se ao servidor.");
	$login = $_POST['login'];
	$entrar = $_POST['entrar'];
	$senha = $_POST['senha'];
	
    
	if (isset($entrar)) {
            
      $verifica = mysqli_query($ok,"SELECT * FROM usuario WHERE login = '$login' AND senha = '$senha'") or die("erro ao selecionar");
        if (mysqli_num_rows($verifica)<=0){
          echo"<script language='javascript' type='text/javascript'>alert('Login e/ou senha incorretos');window.location.href='login.php';</script>";
          die();
        }else{
          setcookie("login",$login);
          header("Location:index.php");
        }
    }
?>