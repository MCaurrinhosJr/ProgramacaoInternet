<?php 

  require("conecta.php");
  $ok = conecta_bd() or die ("Não é possível conectar-se ao servidor.");
  $login = $_POST['login'];
  $senha = $_POST['senha'];
  $email = $_POST['email'];
  $pnome = $_POST['pnome'];
  $snome = $_POST['snome'];
  $query = "Select login from usuario where = '$login'";
  $select = mysqli_query($ok, $query);
  $array = mysqli_fetch_array($select);
  $logarray = $array['login'];
  
  if($login == "" || $login == null){
    echo"<script language='javascript' type='text/javascript'>alert('O campo login deve ser preenchido');window.location.href='cadastro.php';</script>";

    }else{
      if($logarray == $login){

        echo"<script language='javascript' type='text/javascript'>alert('Esse login já existe');window.location.href='cadastro.php';</script>";
        die();

      }else{
        $query = "INSERT INTO usuario (login,senha,email,primeironome,sobrenome,datacriacao) VALUES ('$login','$senha','$email','$pnome','$snome',now())";
        $insert = mysqli_query($ok,$query);
        
        if($insert){
          echo"<script language='javascript' type='text/javascript'>alert('Usuário cadastrado com sucesso!');window.location.href='login.php'</script>";
        }else{
          echo"<script language='javascript' type='text/javascript'>alert('Não foi possível cadastrar esse usuário');window.location.href='cadastro.php'</script>";
        }
      }
    }
?>