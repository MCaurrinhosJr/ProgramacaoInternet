<style>
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;

}

li {
    float: left;
}

li a, .dropbtn {
    display: inline-block;

    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover, .dropdown:hover .dropbtn {
    background-color: red;
}

li.dropdown {
	float: right;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;

    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {

    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
}



.dropdown:hover .dropdown-content {
    display: block;
}
</style>

<?php 
		
		echo'
		
		<a href="index.php"><img src="imgs\\d20.png" width="100" height="100"></a>

		<hr>';
		if(isset($_COOKIE['login']))	
		$login_cookie = $_COOKIE['login'];
			if(isset($login_cookie)){
				
				
				$ok = conecta_bd() or die ("Não é possível conectar-se ao servidor.");
				
				$query = sprintf("SELECT
										id
									FROM 
										usuario
									where
										login = '".$login_cookie."'
									");
			
				
				$dados = mysqli_query($ok,$query) or die(mysqli_error($ok));
				while ($linha = mysqli_fetch_assoc($dados))
				{
					$id = $linha['id'];
				}
				
				echo"
				
				
				<ul style='list-style-type: none; overflow: hidden; margin: 0; padding: 0;'>
					<li style='float:left;'><a href='index.php' class='menu'>Home</a></li>
					<li style='float:left;'><a href='encontreUmJogo.php' class='menu'>Junte-se a um jogo</a></li>
					<li style='float:right'>
					<li class='dropdown'>
						<a href='javascript:void(0)' class='menu'>$login_cookie</a>
						<div class='dropdown-content'>
							<a href='minhaConta.php' class='menu'>Minha Conta</a>
							<a href='perfil.php?id=$id' class='menu'>Meu Perfil</a>
							<a href='logout.php' class='menu'>Desconectar</a>
						</div>
					</li>
				</ul>	
				<hr>";

			}
			else{

				echo'
				<ul style="list-style-type: none; overflow: hidden; margin: 0; padding: 0;">
					<li style="float:left;"><a href="cadastro.php" class="menu">Jogue agora</a></li>
					<li style="float:left;"><a href="encontreUmJogo.php" class="menu">Junte-se a um jogo</a></li>
					<li style="float:right"><a href="Login.php" class="menu">Conecte</a></li>
				</ul>
				<hr>';
				
			}
		
?>