<?php 

  require("conecta.php");  
  $ok = conecta_bd() or die ("Não é possível conectar-se ao servidor.");
  $nome = $_POST['nome'];
  
  
  $query = "Select nome from campanha where nome = '$nome'";
  $select = mysqli_query($ok, $query);
  $array = mysqli_fetch_array($select);
  $logarray = $array['nome'];
  
  if($nome == "" || $nome == null){
    echo"<script language='javascript' type='text/javascript'>alert('O campo nome deve ser preenchido');window.location.href='criajogo.php';</script>";

    }else{
      if($logarray == $nome){

        echo"<script language='javascript' type='text/javascript'>alert('Esse nome de campanha já existe');window.location.href='criajogo.php';</script>";
        die();

      }else{
		
        $query = "INSERT INTO campanha (nome, dataCriacao) VALUES ('$nome',now())";
        $insert = mysqli_query($ok,$query);
        if($in	sert){
			mysqli_query("insert into grupo (idusuario, DM, idcampanha) VALUES (Select id from usuario where login = '$_COOKIE['login']') ,1 ,(select id from campanha where nome = '$nome')");
          echo"<script language='javascript' type='text/javascript'>alert('Campanha criada com sucesso!');window.location.href='index.php'</script>";
        }else{
          echo"<script language='javascript' type='text/javascript'>alert('Não foi possível criar esta campanha');window.location.href='Criajogo.php'</script>";
        }
      }
    }
?>