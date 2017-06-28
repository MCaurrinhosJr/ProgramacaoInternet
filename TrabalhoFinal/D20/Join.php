<?php 

  require("conecta.php");  
  $ok = conecta_bd() or die ("Não é possível conectar-se ao servidor.");
  $idcampanha = htmlspecialchars($_GET["id"]);
  $query = "Select idusuario from grupo where idusuario = (select id from usuario where login = '".$_COOKIE['login']."'";
  
  $select = mysqli_query($ok, $query);
  $array = mysqli_fetch_array($select);
  
  if($array['idusuario'] == '')
  {
	$query = "INSERT INTO grupo (idusuario, idcampanha) VALUES ((select id from usuario where login = '".$_COOKIE['login']."'),$idcampanha)";
	$insert = mysqli_query($ok,$query);
	if($insert){
	  echo"<script language='javascript' type='text/javascript'>alert('você teve sucesso ao se juntar!');window.location.href='index.php'</script>";
	}else{
	  echo"<script language='javascript' type='text/javascript'>alert('Não foi possível se juntar a campanha');window.location.href='index.php'</script>";
	}
  }
  else{
		echo"<script language='javascript' type='text/javascript'>alert('Você já esta nessa campanha');window.location.href='index.php'</script>";
  }
?>